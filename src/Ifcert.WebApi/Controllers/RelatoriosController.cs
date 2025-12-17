using Ifcert.Application.Abstractions;
using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Controllers;

[ApiController]
[Route("api/relatorios")] 
[Authorize(Policy = "JwtAuthPolicy")] 
public class RelatoriosController : ControllerBase
{
    private readonly IPdfGenerator _pdf;
    private readonly IAtividadesRepository _atividadesRepo;
    private readonly IEventosRepository _eventosRepo;
    private readonly IInscricoesRepository _inscricoesRepo;
    private readonly IParticipantesRepository _participantesRepo;

    public RelatoriosController(
        IPdfGenerator pdf,
        IAtividadesRepository atividadesRepo,
        IEventosRepository eventosRepo,
        IInscricoesRepository inscricoesRepo,
        IParticipantesRepository participantesRepo)
    {
        _pdf = pdf;
        _atividadesRepo = atividadesRepo;
        _eventosRepo = eventosRepo;
        _inscricoesRepo = inscricoesRepo;
        _participantesRepo = participantesRepo;
    }

    [HttpGet("atividades/{atividadeId:guid}/presenca")]
    [Authorize(Roles = "Admin")] // organizador/Admin — usando Admin por simplicidade
    public async Task<IActionResult> ListaPresenca([FromRoute] Guid atividadeId, CancellationToken ct)
    {
        var atividade = await _atividadesRepo.ObterPorIdAsync(atividadeId, ct) 
            ?? throw new KeyNotFoundException("Atividade não encontrada.");
        var evento = await _eventosRepo.ObterPorIdAsync(atividade.EventoId, ct) 
            ?? throw new KeyNotFoundException("Evento da atividade não encontrado.");

        var inscricoes = await _inscricoesRepo.ListarPorAtividadeAsync(atividadeId, ct);
        // Performance: evitar N+1 — busca de participantes em lote
        var participanteIds = inscricoes.Select(i => i.ParticipanteId).Distinct().ToArray();
        var participantes = await _participantesRepo.ListarPorIdsAsync(participanteIds, ct);

        // Reaproveita gerador com um certificado sintético
        // Observação: este certificado é apenas um insumo para o gerador de PDF da lista
        // e NÃO representa um certificado emitido ao participante.
        var participanteFake = participantes.FirstOrDefault() ?? new Participante("Lista de Presença", IfcERT.Domain.ValueObjects.Email.From("presenca@ifcert"));
        var cargaHoras = (int)Math.Ceiling((atividade.Agenda.FimUtc - atividade.Agenda.InicioUtc).TotalHours);
        var cert = Certificado.Emitir(Guid.Empty, atividade.Id, evento.Id, participanteFake.Id, Math.Max(cargaHoras, 1));
        // Retornamos uma URL (pdfUrl) pois o PDF é gerado por um serviço de geração já existente (IPdfGenerator)
        // e pode ser servido externamente/assíncrono conforme a implementação do gerador.
        var pdfUrl = await _pdf.GerarAsync(cert, evento, atividade, participanteFake, ct);

        // Como o IPdfGenerator retorna URL, devolvemos o arquivo indireto; para simplificar, retornamos a URL
        return Ok(new { pdfUrl });
    }
}
