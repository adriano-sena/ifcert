using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;
using Microsoft.EntityFrameworkCore;

namespace Ifcert.Infrastructure.Repositories;

public class CertificadosRepository : RepositorioBase<Certificado>, ICertificadosRepository
{
    public CertificadosRepository(ApplicationDbContext ctx) : base(ctx) { }

    public async Task<bool> CodigoExisteAsync(string codigo, CancellationToken ct = default)
        => await Contexto.Set<Certificado>().AnyAsync(c => c.Codigo.Valor == codigo, ct);

    public async Task<Certificado?> ObterPorCodigoAsync(string codigo, CancellationToken ct = default)
        => await Contexto.Set<Certificado>().FirstOrDefaultAsync(c => c.Codigo.Valor == codigo, ct);

    public async Task<Certificado?> ObterPorInscricaoAsync(Guid inscricaoId, CancellationToken ct = default)
        => await Contexto.Set<Certificado>().FirstOrDefaultAsync(c => c.InscricaoId == inscricaoId, ct);
}