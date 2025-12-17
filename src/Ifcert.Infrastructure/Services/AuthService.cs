using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Text;
using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Ifcert.Infrastructure.Options;
using Microsoft.AspNetCore.Identity;
using Microsoft.Extensions.Options;
using Microsoft.IdentityModel.Tokens;

namespace Ifcert.Infrastructure.Services;

public class AuthService : IAuthService
{
    private readonly UserManager<IdentityUser> _userManager;
    private readonly IOptions<JwtSettings> _jwtSettings;

    public AuthService(UserManager<IdentityUser> userManager, IOptions<JwtSettings> jwtSettings)
    {
        _userManager = userManager;
        _jwtSettings = jwtSettings;
    }

    public async Task<AuthResultDto> RegistrarAsync(RegisterRequest request, CancellationToken cancellationToken = default)
    {
        if (!string.Equals(request.Senha, request.ConfirmarSenha, StringComparison.Ordinal))
        {
            return new AuthResultDto
            {
                Sucesso = false,
                Erros = new[] { "Senha e confirmação não conferem." }
            };
        }

        var existingUser = await _userManager.FindByEmailAsync(request.Email);
        if (existingUser is not null)
        {
            return new AuthResultDto
            {
                Sucesso = false,
                Erros = new[] { "E-mail já cadastrado." }
            };
        }

        var user = new IdentityUser
        {
            UserName = request.Email,
            Email = request.Email,
            EmailConfirmed = true
        };

        var createResult = await _userManager.CreateAsync(user, request.Senha);
        if (!createResult.Succeeded)
        {
            return new AuthResultDto
            {
                Sucesso = false,
                Erros = createResult.Errors.Select(e => e.Description)
            };
        }

        var roles = await _userManager.GetRolesAsync(user);
        return await GerarJwtAsync(Guid.Parse(user.Id), user.Email!, roles, cancellationToken);
    }

    public async Task<AuthResultDto> AutenticarAsync(LoginRequest request, CancellationToken cancellationToken = default)
    {
        if (!await ValidarCredenciaisAsync(request, cancellationToken))
        {
            return new AuthResultDto
            {
                Sucesso = false,
                Erros = new[] { "Credenciais inválidas." }
            };
        }

        var user = await _userManager.FindByEmailAsync(request.Email)
                   ?? throw new InvalidOperationException("Usuário não encontrado após validação.");

        var roles = await _userManager.GetRolesAsync(user);
        return await GerarJwtAsync(Guid.Parse(user.Id), user.Email!, roles, cancellationToken);
    }

    public Task<AuthResultDto> GerarJwtAsync(Guid usuarioId, string email, IEnumerable<string> perfis, CancellationToken cancellationToken = default)
    {
        var settings = _jwtSettings.Value;
        var expires = DateTime.UtcNow.AddMinutes(settings.ExpirationMinutes);

        var claims = new List<Claim>
        {
            new(JwtRegisteredClaimNames.Sub, usuarioId.ToString()),
            new(JwtRegisteredClaimNames.Email, email),
            new(JwtRegisteredClaimNames.Jti, Guid.NewGuid().ToString())
        };

        claims.AddRange(perfis.Select(role => new Claim(ClaimTypes.Role, role)));

        var signingKey = new SymmetricSecurityKey(Encoding.UTF8.GetBytes(settings.Secret));
        var credentials = new SigningCredentials(signingKey, SecurityAlgorithms.HmacSha256);

        var token = new JwtSecurityToken(
            issuer: settings.Issuer,
            audience: settings.Audience,
            claims: claims,
            expires: expires,
            signingCredentials: credentials);

        var tokenString = new JwtSecurityTokenHandler().WriteToken(token);

        return Task.FromResult(new AuthResultDto
        {
            UsuarioId = usuarioId,
            Email = email,
            TokenJwt = tokenString,
            ExpiraEmUtc = expires,
            Sucesso = true,
            Perfis = perfis.ToArray(),
            Erros = Array.Empty<string>()
        });
    }

    public async Task<bool> ValidarCredenciaisAsync(LoginRequest request, CancellationToken cancellationToken = default)
    {
        var user = await _userManager.FindByEmailAsync(request.Email);
        if (user is null)
            return false;

        return await _userManager.CheckPasswordAsync(user, request.Senha);
    }
}

