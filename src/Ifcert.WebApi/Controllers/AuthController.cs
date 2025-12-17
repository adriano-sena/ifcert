using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api/auth")]
[Tags("Autenticação")]
public class AuthController : ControllerBase
{
    private readonly IAuthService _authService;

    public AuthController(IAuthService authService)
    {
        _authService = authService;
    }

    /// <summary>
    /// Registra um novo usuário.
    /// </summary>
    [HttpPost("register")]
    [AllowAnonymous]
    [ProducesResponseType(typeof(AuthResultDto), StatusCodes.Status200OK)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> RegistrarAsync([FromBody] RegisterRequest request, CancellationToken cancellationToken)
    {
        var result = await _authService.RegistrarAsync(request, cancellationToken);
        return result.Sucesso ? Ok(result) : BadRequest(new { erros = result.Erros });
    }

    /// <summary>
    /// Autentica um usuário e gera JWT.
    /// </summary>
    [HttpPost("login")]
    [AllowAnonymous]
    [ProducesResponseType(typeof(AuthResultDto), StatusCodes.Status200OK)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> LoginAsync([FromBody] LoginRequest request, CancellationToken cancellationToken)
    {
        var result = await _authService.AutenticarAsync(request, cancellationToken);
        return result.Sucesso ? Ok(result) : BadRequest(new { erros = result.Erros });
    }
}
