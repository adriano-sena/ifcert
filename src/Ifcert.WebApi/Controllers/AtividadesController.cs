using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api")]
[Tags("Atividades")] 
[Authorize(Policy = "JwtAuthPolicy")]
public class AtividadesController : ControllerBase
{
    private readonly IAtividadesService _atividadesService;

    public AtividadesController(IAtividadesService atividadesService)
    {
        _atividadesService = atividadesService;
    }

    /// <summary>
    /// Adiciona uma atividade a um evento.
    /// </summary>
    [HttpPost("eventos/{eventoId:guid}/atividades")]
    [ProducesResponseType(typeof(object), StatusCodes.Status201Created)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> AdicionarAoEventoAsync(
        [FromRoute] Guid eventoId,
        [FromBody] CriarAtividadeRequest request,
        CancellationToken cancellationToken)
    {
        try
        {
            // Garante que o eventoId da rota prevalece
            request.EventoId = eventoId;
            var atividadeId = await _atividadesService.AdicionarAoEventoAsync(request, cancellationToken);
            return Created($"/api/atividades/{atividadeId}", new { id = atividadeId });
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
    /// Inscreve um participante em uma atividade.
    /// </summary>
    public record InscreverParticipanteRequest(Guid ParticipanteId);

    [HttpPost("atividades/{atividadeId:guid}/inscricoes")]
    [ProducesResponseType(typeof(object), StatusCodes.Status201Created)]
    [ProducesResponseType(StatusCodes.Status400BadRequest)]
    public async Task<IActionResult> InscreverAsync(
        [FromRoute] Guid atividadeId,
        [FromBody] InscreverParticipanteRequest request,
        CancellationToken cancellationToken)
    {
        try
        {
            var inscricaoId = await _atividadesService.InscreverAsync(atividadeId, request.ParticipanteId, cancellationToken);
            return Created($"/api/atividades/{atividadeId}/inscricoes/{inscricaoId}", new { id = inscricaoId });
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
}
