using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api/eventos")]
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
    [ProducesResponseType(typeof(EventoDto), StatusCodes.Status201Created)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> CriarAsync([FromBody] CriarEventoRequest request, CancellationToken cancellationToken)
    {
        try
        {
            var dto = await _eventosService.CriarAsync(request, cancellationToken);
            return CreatedAtAction(nameof(ObterPorIdAsync), new { id = dto.Id }, dto);
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
}

