using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;
using Microsoft.EntityFrameworkCore;

namespace Ifcert.Infrastructure.Repositories;

public class ParticipantesRepository : RepositorioBase<Participante>, IParticipantesRepository
{
    public ParticipantesRepository(ApplicationDbContext contexto) : base(contexto)
    { }

    public async Task<IReadOnlyList<Participante>> ListarPorIdsAsync(IEnumerable<Guid> ids, CancellationToken ct = default)
    {
        return await Contexto.Set<Participante>()
            .Where(p => ids.Contains(p.Id))
            .ToListAsync(ct);
    }
}
