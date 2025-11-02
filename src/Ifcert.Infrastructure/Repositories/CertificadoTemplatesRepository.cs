using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;
using Microsoft.EntityFrameworkCore;

namespace Ifcert.Infrastructure.Repositories;

public class CertificadoTemplatesRepository : RepositorioBase<CertificadoTemplate>, ICertificadoTemplatesRepository
{
    public CertificadoTemplatesRepository(ApplicationDbContext _contexto) : base(_contexto) { }

    public async Task<IReadOnlyList<CertificadoTemplate>> ListarPorEventoAsync(Guid? eventoId, CancellationToken ct = default)
        => await Contexto.Set<CertificadoTemplate>()
            .Where(t => t.EventoId == eventoId)
            .OrderByDescending(t => t.Ativo)
            .ThenBy(t => t.Nome)
            .ToListAsync(ct);

    public async Task<CertificadoTemplate?> ObterAtivoPorEventoAsync(Guid? eventoId, CancellationToken ct = default)
        => await Contexto.Set<CertificadoTemplate>()
            .FirstOrDefaultAsync(t => t.EventoId == eventoId && t.Ativo, ct);
}