using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;

namespace Ifcert.Infrastructure.Repositories;

public class UnitOfWork : IUnitOfWork
{

    private readonly ApplicationDbContext _contexto;

    public UnitOfWork(ApplicationDbContext contexto)
    {
        _contexto = contexto;
    }

    public Task SalvarAlteracoesAsync(CancellationToken cancellationToken = default)
    {
        return _contexto.SaveChangesAsync(cancellationToken);
    }
}