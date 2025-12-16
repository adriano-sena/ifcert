using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api/certificados/templates")]
public class CertificadoTemplatesController : ControllerBase
{
    private readonly ICertificadoTemplatesService _service;

    public CertificadoTemplatesController(ICertificadoTemplatesService service)
        => _service = service;

    /// <summary>
    /// Cria um template de certificado.
    /// </summary>
    [HttpPost]
    [ProducesResponseType(typeof(object), StatusCodes.Status201Created)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> Criar([FromBody] CriarCertificadoTemplateRequest request, CancellationToken ct)
    {
        try
        {
            var id = await _service.CriarAsync(request, ct);
            return CreatedAtAction(nameof(ObterPorId), new { id }, new { id });
        }
        catch (ArgumentException ex)
        {
            return BadRequest(new { mensagem = ex.Message });
        }
    }

    /// <summary>
    /// Atualiza um template de certificado.
    /// </summary>
    [HttpPut("{id:guid}")]
    [ProducesResponseType(StatusCodes.Status204NoContent)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    [ProducesResponseType(StatusCodes.Status404NotFound)]
    public async Task<IActionResult> Atualizar([FromRoute] Guid id, [FromBody] AtualizarCertificadoTemplateRequest request, CancellationToken ct)
    {
        try
        {
            await _service.AtualizarAsync(id, request, ct);
            return NoContent();
        }
        catch (KeyNotFoundException)
        {
            return NotFound(new { mensagem = "Template não encontrado." });
        }
        catch (ArgumentException ex)
        {
            return BadRequest(new { mensagem = ex.Message });
        }
    }

    /// <summary>
    /// Remove um template de certificado.
    /// </summary>
    [HttpDelete("{id:guid}")]
    [ProducesResponseType(StatusCodes.Status204NoContent)]
    public async Task<IActionResult> Remover([FromRoute] Guid id, CancellationToken ct)
    {
        await _service.RemoverAsync(id, ct);
        return NoContent();
    }

    /// <summary>
    /// Obtém um template por Id.
    /// </summary>
    [HttpGet("{id:guid}")]
    [ProducesResponseType(typeof(CertificadoTemplateDto), StatusCodes.Status200OK)]
    [ProducesResponseType(StatusCodes.Status404NotFound)]
    public async Task<IActionResult> ObterPorId([FromRoute] Guid id, CancellationToken ct)
    {
        var dto = await _service.ObterPorIdAsync(id, ct);
        return dto is null ? NotFound(new { mensagem = "Template não encontrado." }) : Ok(dto);
    }

    /// <summary>
    /// Lista templates por Evento (ou todos se eventoId ausente).
    /// </summary>
    [HttpGet]
    [ProducesResponseType(typeof(IReadOnlyList<CertificadoTemplateDto>), StatusCodes.Status200OK)]
    public async Task<IActionResult> Listar([FromQuery] Guid? eventoId, CancellationToken ct)
    {
        var lista = await _service.ListarPorEventoAsync(eventoId, ct);
        return Ok(lista);
    }
}

