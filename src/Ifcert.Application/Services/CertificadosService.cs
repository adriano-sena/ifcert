using Ifcert.Application.Abstractions;
using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;

namespace Ifcert.Application.Services;

public class CertificadosService : ICertificadosService
{
    private readonly ICertificadosRepository _certificadosRepository;
    private readonly IAtividadesRepository _atividadesRepository;
    private readonly IEventosRepository _eventosRepository;
    private readonly IParticipantesRepository _participantesRepository;
    private readonly IPdfGenerator _pdfGenerator;
    private readonly IUnitOfWork _unitOfWork;

    public CertificadosService(
        ICertificadosRepository certificadosRepository,
        IAtividadesRepository atividadesRepository,
        IEventosRepository eventosRepository,
        IParticipantesRepository participantesRepository,
        IPdfGenerator pdfGenerator,
        IUnitOfWork unitOfWork)
    {
        _certificadosRepository = certificadosRepository;
        _atividadesRepository = atividadesRepository;
        _eventosRepository = eventosRepository;
        _participantesRepository = participantesRepository;
        _pdfGenerator = pdfGenerator;
        _unitOfWork = unitOfWork;
    }

   public async Task<CertificadoDto> EmitirPorInscricaoAsync(Guid inscricaoId, CancellationToken ct = default)
    {
        if (inscricaoId == Guid.Empty)
            throw new ArgumentException("Inscrição inválida.", nameof(inscricaoId));

        var existente = await _certificadosRepository.ObterPorInscricaoAsync(inscricaoId, ct);
        if (existente is not null)
            return MapToDto(existente);

        // Atividade com suas inscrições
        var atividade = await _atividadesRepository.ObterDetalhadaAsyncPorInscricaoId(inscricaoId, ct)
            ?? throw new InvalidOperationException("Inscrição/Atividade não encontrada.");

        var inscricao = atividade.Inscricoes.First(i => i.Id == inscricaoId);

        // Carregar Evento e Participante p/ compor o PDF
        var evento = await _eventosRepository.ObterPorIdAsync(atividade.EventoId, ct)
            ?? throw new InvalidOperationException("Evento não encontrado.");
        var participante = await _participantesRepository.ObterPorIdAsync(inscricao.ParticipanteId, ct)
            ?? throw new InvalidOperationException("Participante não encontrado.");

        var horas = (int)Math.Max(1, Math.Round((atividade.Agenda.FimUtc - atividade.Agenda.InicioUtc).TotalHours));

        var novo = Certificado.Emitir(inscricaoId, atividade.Id, evento.Id, participante.Id, horas);

        // Gera o PDF e define a URL
        var pdfUrl = await _pdfGenerator.GerarAsync(novo, evento, atividade, participante, ct);
        novo.DefinirPdfUrl(pdfUrl); // garanta que existe este método na entidade

        _certificadosRepository.CriarAsync(novo, ct);
        await _unitOfWork.SalvarAlteracoesAsync(ct);

        return MapToDto(novo);
    }

    public async Task<CertificadoDto?> ObterPorCodigoAsync(string codigo, CancellationToken ct = default)
    {
        if (string.IsNullOrWhiteSpace(codigo)) return null;
        var cert = await _certificadosRepository.ObterPorCodigoAsync(codigo, ct);
        return cert is null ? null : MapToDto(cert);
    }

    private static CertificadoDto MapToDto(Certificado c) =>
        new(
            c.Id,
            c.Codigo.Valor,
            c.EventoId,
            c.AtividadeId,
            c.ParticipanteId,
            c.CargaHorariaHoras,
            c.EmitidoEmUtc,
            c.PdfUrl
        );
}
