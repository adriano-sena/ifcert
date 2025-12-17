using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api/eventos")]
[Tags("Eventos")]
[Authorize(Policy = "JwtAuthPolicy")]
public class EventosController : ControllerBase
{
    private readonly IEventosService _eventosService;

    public EventosController(IEventosService eventosService)
    {
        _eventosService = eventosService;
    }

    /// <summary>
    /// Cria um novo evento.
    /// </summary>
    [HttpPost]
    [Authorize(Roles = "Admin")]
    [ProducesResponseType(typeof(EventoDto), StatusCodes.Status201Created)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> CriarAsync([FromBody] CriarEventoRequest request, CancellationToken cancellationToken)
    {
        try
        {
            var dto = await _eventosService.CriarAsync(request, cancellationToken);
            return CreatedAtRoute("ObterPorId", new { id = dto.Id }, dto);        
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
    /// Obtém um evento pelo Id.
    /// </summary>
    [HttpGet("{id:guid}", Name = "ObterPorId")]
    [ProducesResponseType(typeof(EventoDto), StatusCodes.Status200OK)]
    [ProducesResponseType(StatusCodes.Status404NotFound)]
    public async Task<IActionResult> ObterPorIdAsync([FromRoute] Guid id, CancellationToken cancellationToken)
    {
        var dto = await _eventosService.ObterPorIdAsync(id, cancellationToken);
        if (dto is null)
            return NotFound(new { mensagem = "Evento não encontrado." });

        return Ok(dto);
    }

    /// <summary>
    /// Lista todos os eventos.
    /// </summary>
    [HttpGet]
    [ProducesResponseType(typeof(IReadOnlyList<EventoDto>), StatusCodes.Status200OK)]
    public async Task<IActionResult> ListarAsync(CancellationToken cancellationToken)
    {
        var lista = await _eventosService.ListarAsync(cancellationToken);
        return Ok(lista);
    }

    /// <summary>
    /// Atualiza dados de um evento (Admin).
    /// </summary>
    [HttpPut("{id:guid}")]
    [Authorize(Roles = "Admin")]
    [ProducesResponseType(StatusCodes.Status204NoContent)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    [ProducesResponseType(StatusCodes.Status404NotFound)]
    public async Task<IActionResult> AtualizarAsync([FromRoute] Guid id, [FromBody] CriarEventoRequest request, CancellationToken cancellationToken)
    {
        try
        {
            // Reutilizando contrato para simplicidade; service deve lidar com atualização.
            await _eventosService.AtualizarAsync(id, request, cancellationToken);
            return NoContent();
        }
        catch (KeyNotFoundException)
        {
            return NotFound(new { mensagem = "Evento não encontrado." });
        }
        catch (ArgumentException ex)
        {
            return BadRequest(new { mensagem = ex.Message });
        }
    }

    /// <summary>
    /// Remove um evento (Admin).
    /// </summary>
    [HttpDelete("{id:guid}")]
    [Authorize(Roles = "Admin")]
    [ProducesResponseType(StatusCodes.Status204NoContent)]
    public async Task<IActionResult> RemoverAsync([FromRoute] Guid id, CancellationToken cancellationToken)
    {
        await _eventosService.RemoverAsync(id, cancellationToken);
        return NoContent();
    }
}
