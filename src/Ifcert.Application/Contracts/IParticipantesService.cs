using Ifcert.Application.DTOs;

namespace Ifcert.Application.Contracts;

public interface IParticipantesService
{
    Task<ParticipanteDto> CriarAsync(CriarParticipanteRequest request, CancellationToken ct = default);
    Task AtualizarAsync(Guid id, AtualizarParticipanteRequest request, CancellationToken ct = default);
    Task RemoverAsync(Guid id, CancellationToken ct = default);
    Task<ParticipanteDto?> ObterPorIdAsync(Guid id, CancellationToken ct = default);
    Task<IReadOnlyList<ParticipanteDto>> ListarAsync(CancellationToken ct = default);
}

