using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api")]
[Tags("Certificados")] 
[Authorize(Policy = "JwtAuthPolicy")]
public class CertificadosController : ControllerBase
{
    private readonly ICertificadosService _service;

    public CertificadosController(ICertificadosService service) => _service = service;

    /// <summary>
    /// Emite certificado para a inscrição informada.
    /// </summary>
    [HttpPost("inscricoes/{inscricaoId:guid}/certificados")]
    [ProducesResponseType(typeof(CertificadoDto), StatusCodes.Status201Created)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<ActionResult<CertificadoDto>> Emitir([FromRoute] Guid inscricaoId, CancellationToken ct)
    {
        try
        {
            var dto = await _service.EmitirPorInscricaoAsync(inscricaoId, ct);
            return CreatedAtRoute("ValidarCertificado", new { codigo = dto.Codigo }, dto);
        }
        catch (ArgumentException ex)
        {
            return BadRequest(new { mensagem = ex.Message });
        }
        catch (InvalidOperationException ex)
        {
            return BadRequest(new { mensagem = ex.Message });
        }
    }

    /// <summary>
    /// Valida/obtém metadados de um certificado pelo código.
    /// </summary>
    [HttpGet("certificados/validacao/{codigo}", Name = "ValidarCertificado")]
    [ProducesResponseType(typeof(CertificadoDto), StatusCodes.Status200OK)]
    [ProducesResponseType(StatusCodes.Status404NotFound)]
    public async Task<ActionResult<CertificadoDto>> Validar([FromRoute] string codigo, CancellationToken ct)
    {
        var dto = await _service.ObterPorCodigoAsync(codigo, ct);
        return dto is null ? NotFound("Certificado não encontrado.") : Ok(dto);
    }
}
