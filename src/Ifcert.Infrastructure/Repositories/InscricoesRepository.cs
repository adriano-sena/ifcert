using Ifcert.Domain.Entities.Commom;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;
using Microsoft.EntityFrameworkCore;

namespace Ifcert.Infrastructure.Repositories;

public class InscricoesRepository : RepositorioBase<Inscricao>, IInscricoesRepository
{
    public InscricoesRepository(ApplicationDbContext contexto) : base(contexto)
    { }

    public async Task<IReadOnlyList<Inscricao>> ListarPorAtividadeAsync(Guid atividadeId, CancellationToken ct = default)
    {
        return await Contexto.Set<Inscricao>()
            .Where(i => i.AtividadeId == atividadeId)
            .ToListAsync(ct);
    }

    public async Task<IReadOnlyList<Inscricao>> ListarPorParticipanteAsync(Guid participanteId, CancellationToken ct = default)
    {
        return await Contexto.Set<Inscricao>()
            .Where(i => i.ParticipanteId == participanteId)
            .ToListAsync(ct);
    }
}
