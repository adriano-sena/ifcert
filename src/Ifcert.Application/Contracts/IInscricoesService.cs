using Ifcert.Application.DTOs;

namespace Ifcert.Application.Contracts;

public interface IInscricoesService
{
    Task<Guid> CriarAsync(Guid atividadeId, CriarInscricaoRequest request, CancellationToken ct = default);
    Task RemoverAsync(Guid inscricaoId, CancellationToken ct = default);
    Task<InscricaoDto?> ObterPorIdAsync(Guid inscricaoId, CancellationToken ct = default);
    Task<IReadOnlyList<InscricaoDto>> ListarPorAtividadeAsync(Guid atividadeId, CancellationToken ct = default);
    Task<IReadOnlyList<InscricaoDto>> ListarPorParticipanteAsync(Guid participanteId, CancellationToken ct = default);
}

