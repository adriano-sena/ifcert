using Ifcert.Domain.Entities.Commom;

namespace Ifcert.Domain.Interfaces;

public interface IInscricoesRepository : IRepository<Inscricao>
{
    Task<IReadOnlyList<Inscricao>> ListarPorAtividadeAsync(Guid atividadeId, CancellationToken ct = default);
    Task<IReadOnlyList<Inscricao>> ListarPorParticipanteAsync(Guid participanteId, CancellationToken ct = default);
}
