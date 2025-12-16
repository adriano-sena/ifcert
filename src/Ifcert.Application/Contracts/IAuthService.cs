using Ifcert.Application.DTOs;

namespace Ifcert.Application.Contracts;

public interface IAuthService
{
    Task<AuthResultDto> RegistrarAsync(RegisterRequest request, CancellationToken cancellationToken = default);
    Task<AuthResultDto> AutenticarAsync(LoginRequest request, CancellationToken cancellationToken = default);
    Task<AuthResultDto> GerarJwtAsync(Guid usuarioId, string email, IEnumerable<string> perfis, CancellationToken cancellationToken = default);
    Task<bool> ValidarCredenciaisAsync(LoginRequest request, CancellationToken cancellationToken = default);
}

