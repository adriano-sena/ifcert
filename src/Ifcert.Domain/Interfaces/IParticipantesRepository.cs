using Ifcert.Domain.Entities;

namespace Ifcert.Domain.Interfaces;

public interface IParticipantesRepository : IRepository<Participante>
{
    Task<IReadOnlyList<Participante>> ListarPorIdsAsync(IEnumerable<Guid> ids, CancellationToken ct = default);
}
