using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Ifcert.Domain.Entities;
using Ifcert.Domain.Entities.Commom;
using Ifcert.Domain.Interfaces;

namespace Ifcert.Application.Services;

public class InscricoesService : IInscricoesService
{
    private readonly IInscricoesRepository _inscricoesRepository;
    private readonly IAtividadesRepository _atividadesRepository;
    private readonly IParticipantesRepository _participantesRepository;
    private readonly IUnitOfWork _unitOfWork;

    public InscricoesService(
        IInscricoesRepository inscricoesRepository,
        IAtividadesRepository atividadesRepository,
        IParticipantesRepository participantesRepository,
        IUnitOfWork unitOfWork)
    {
        _inscricoesRepository = inscricoesRepository;
        _atividadesRepository = atividadesRepository;
        _participantesRepository = participantesRepository;
        _unitOfWork = unitOfWork;
    }

    public async Task<Guid> CriarAsync(Guid atividadeId, CriarInscricaoRequest request, CancellationToken ct = default)
    {
        if (atividadeId == Guid.Empty)
            throw new ArgumentException("Atividade inválida.", nameof(atividadeId));
        if (request is null)
            throw new ArgumentNullException(nameof(request));
        if (request.ParticipanteId == Guid.Empty)
            throw new ArgumentException("Participante inválido.", nameof(request.ParticipanteId));

        var atividade = await _atividadesRepository.ObterPorIdAsync(atividadeId, ct)
            ?? throw new InvalidOperationException("Atividade não encontrada.");

        var participante = await _participantesRepository.ObterPorIdAsync(request.ParticipanteId, ct)
            ?? throw new InvalidOperationException("Participante não encontrado.");

        var inscricao = atividade.Inscrever(participante);

        _atividadesRepository.Atualizar(atividade);
        await _unitOfWork.SalvarAlteracoesAsync(ct);

        return inscricao.Id;
    }

    public async Task RemoverAsync(Guid inscricaoId, CancellationToken ct = default)
    {
        if (inscricaoId == Guid.Empty)
            throw new ArgumentException("Inscrição inválida.", nameof(inscricaoId));

        var insc = await _inscricoesRepository.ObterPorIdAsync(inscricaoId, ct);
        if (insc is null) return;
        _inscricoesRepository.Deletar(insc);
        await _unitOfWork.SalvarAlteracoesAsync(ct);
    }

    public async Task<InscricaoDto?> ObterPorIdAsync(Guid inscricaoId, CancellationToken ct = default)
    {
        if (inscricaoId == Guid.Empty)
            throw new ArgumentException("Inscrição inválida.", nameof(inscricaoId));

        var i = await _inscricoesRepository.ObterPorIdAsync(inscricaoId, ct);
        return i is null ? null : Map(i);
    }

    public async Task<IReadOnlyList<InscricaoDto>> ListarPorAtividadeAsync(Guid atividadeId, CancellationToken ct = default)
    {
        if (atividadeId == Guid.Empty)
            throw new ArgumentException("Atividade inválida.", nameof(atividadeId));

        var list = await _inscricoesRepository.ListarPorAtividadeAsync(atividadeId, ct);
        return list.Select(Map).ToList();
    }

    public async Task<IReadOnlyList<InscricaoDto>> ListarPorParticipanteAsync(Guid participanteId, CancellationToken ct = default)
    {
        if (participanteId == Guid.Empty)
            throw new ArgumentException("Participante inválido.", nameof(participanteId));

        var list = await _inscricoesRepository.ListarPorParticipanteAsync(participanteId, ct);
        return list.Select(Map).ToList();
    }

    private static InscricaoDto Map(Inscricao i)
        => new(i.Id, i.AtividadeId, i.ParticipanteId, i.DataCriacao, i.DataAlteracao == default ? (DateTime?)null : i.DataAlteracao);
}

