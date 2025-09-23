using Ifcert.Domain.Interfaces;
using Ifcert.Domain.Entities.Commom;
using Ifcert.Infrastructure.Data;
using Microsoft.EntityFrameworkCore;

namespace Ifcert.Infrastructure.Repositories;

public class RepositorioBase<T> : IRepository<T> where T : EntidadeBase
{
    
    protected readonly ApplicationDbContext Contexto;

    public RepositorioBase(ApplicationDbContext contexto)
    {
        this.Contexto = contexto;
    }
    public Task<T?> ObterPorIdAsync(Guid id, CancellationToken cancellationToken = default)
    {
        return Contexto.Set<T>().FirstOrDefaultAsync(x => x.Id == id, cancellationToken);
    }

    public async Task<IReadOnlyList<T>> ListarAsync(CancellationToken cancellationToken = default)
    {
        return await Contexto.Set<T>().ToListAsync(cancellationToken);
    }

    public void CriarAsync(T entidade, CancellationToken cancellationToken = default)
    {
         Contexto.Add(entidade);
    }

    public void Atualizar(T entidade)
    {
        Contexto.Update(entidade);
    }

    public void Deletar(T entidade)
    {
        Contexto.Remove(entidade);
    }

    public Task<bool> ExisteAsync(Guid id, CancellationToken cancellationToken = default)
    {
        return Contexto.Set<T>().AnyAsync(x => x.Id == id, cancellationToken);
    }
}