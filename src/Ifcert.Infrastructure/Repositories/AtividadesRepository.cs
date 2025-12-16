using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;
using Microsoft.EntityFrameworkCore;

namespace Ifcert.Infrastructure.Repositories;

public class AtividadesRepository : RepositorioBase<Atividade>, IAtividadesRepository
{
    public AtividadesRepository(ApplicationDbContext contexto) : base(contexto)
    { }

    public async Task<Atividade?> ObterDetalhadaAsyncPorInscricaoId(Guid inscricaoId, CancellationToken ct = default)
    {
        return await Contexto.Set<Atividade>()
            .Include(a => a.Inscricoes)
            .FirstOrDefaultAsync(a => a.Inscricoes.Any(i => i.Id == inscricaoId), ct);
    }
}
