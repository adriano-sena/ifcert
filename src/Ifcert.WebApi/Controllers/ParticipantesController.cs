using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api/participantes")]
public class ParticipantesController : ControllerBase
{
    private readonly IParticipantesService _service;

    public ParticipantesController(IParticipantesService service)
        => _service = service;

    /// <summary>
    /// Cria um novo participante.
    /// </summary>
    [HttpPost]
    [ProducesResponseType(typeof(ParticipanteDto), StatusCodes.Status201Created)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> Criar([FromBody] CriarParticipanteRequest request, CancellationToken ct)
    {
        try
        {
            var dto = await _service.CriarAsync(request, ct);
            return CreatedAtAction(nameof(ObterPorId), new { id = dto.Id }, dto);
        }
        catch (ArgumentException ex)
        {
            return BadRequest(new { mensagem = ex.Message });
        }
    }

    /// <summary>
    /// Atualiza dados de um participante.
    /// </summary>
    [HttpPut("{id:guid}")]
    [ProducesResponseType(StatusCodes.Status204NoContent)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    [ProducesResponseType(StatusCodes.Status404NotFound)]
    public async Task<IActionResult> Atualizar([FromRoute] Guid id, [FromBody] AtualizarParticipanteRequest request, CancellationToken ct)
    {
        try
        {
            await _service.AtualizarAsync(id, request, ct);
            return NoContent();
        }
        catch (KeyNotFoundException)
        {
            return NotFound(new { mensagem = "Participante não encontrado." });
        }
        catch (ArgumentException ex)
        {
            return BadRequest(new { mensagem = ex.Message });
        }
    }

    /// <summary>
    /// Remove um participante.
    /// </summary>
    [HttpDelete("{id:guid}")]
    [ProducesResponseType(StatusCodes.Status204NoContent)]
    public async Task<IActionResult> Remover([FromRoute] Guid id, CancellationToken ct)
    {
        await _service.RemoverAsync(id, ct);
        return NoContent();
    }

    /// <summary>
    /// Obtém um participante por Id.
    /// </summary>
    [HttpGet("{id:guid}")]
    [ProducesResponseType(typeof(ParticipanteDto), StatusCodes.Status200OK)]
    [ProducesResponseType(StatusCodes.Status404NotFound)]
    public async Task<IActionResult> ObterPorId([FromRoute] Guid id, CancellationToken ct)
    {
        var dto = await _service.ObterPorIdAsync(id, ct);
        return dto is null ? NotFound(new { mensagem = "Participante não encontrado." }) : Ok(dto);
    }

    /// <summary>
    /// Lista participantes.
    /// </summary>
    [HttpGet]
    [ProducesResponseType(typeof(IReadOnlyList<ParticipanteDto>), StatusCodes.Status200OK)]
    public async Task<IActionResult> Listar(CancellationToken ct)
    {
        var lista = await _service.ListarAsync(ct);
        return Ok(lista);
    }
}

