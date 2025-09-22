namespace Ifcert.Domain.Abstracoes;

public interface IUnitOfWork
{
    Task<int> SalvarAlteracoesAsync(CancellationToken cancellationToken = default);
}

