using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api/users")]
[Authorize(Policy = "JwtAuthPolicy", Roles = "Admin")]
public class UsersController : ControllerBase
{
    private readonly UserManager<IdentityUser> _userManager;

    public UsersController(UserManager<IdentityUser> userManager)
    {
        _userManager = userManager;
    }

    [HttpGet]
    public IActionResult Listar()
    {
        var users = _userManager.Users
            .Select(u => new { u.Id, u.UserName, u.Email })
            .ToList();
        return Ok(users);
    }

    [HttpGet("{id}")]
    public async Task<IActionResult> ObterPorId([FromRoute] string id)
    {
        var user = await _userManager.FindByIdAsync(id);
        if (user is null) return NotFound(new { mensagem = "Usuário não encontrado." });
        return Ok(new { user.Id, user.UserName, user.Email });
    }

    public record UpdateUserRequest(string? Email, string? UserName, string? Password);

    [HttpPut("{id}")]
    public async Task<IActionResult> Atualizar([FromRoute] string id, [FromBody] UpdateUserRequest request)
    {
        var user = await _userManager.FindByIdAsync(id);
        if (user is null) return NotFound(new { mensagem = "Usuário não encontrado." });

        // 1) Atualizar Email/UserName usando métodos do UserManager (consistência com Identity)
        if (!string.IsNullOrWhiteSpace(request.Email))
        {
            var emailResult = await _userManager.SetEmailAsync(user, request.Email);
            if (!emailResult.Succeeded) return BadRequest(new { erros = emailResult.Errors.Select(e => e.Description) });
        }
        if (!string.IsNullOrWhiteSpace(request.UserName))
        {
            var userResult = await _userManager.SetUserNameAsync(user, request.UserName);
            if (!userResult.Succeeded) return BadRequest(new { erros = userResult.Errors.Select(e => e.Description) });
        }

        // 2) Resetar senha, se informado, usando o fluxo oficial de token + reset
        if (!string.IsNullOrWhiteSpace(request.Password))
        {
            var token = await _userManager.GeneratePasswordResetTokenAsync(user);
            var passResult = await _userManager.ResetPasswordAsync(user, token, request.Password);
            if (!passResult.Succeeded) return BadRequest(new { erros = passResult.Errors.Select(e => e.Description) });
        }

        // 3) Persistir alterações ao final para evitar estados parciais
        var update = await _userManager.UpdateAsync(user);
        if (!update.Succeeded) return BadRequest(new { erros = update.Errors.Select(e => e.Description) });

        return NoContent();
    }
}
