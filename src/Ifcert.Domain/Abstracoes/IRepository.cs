namespace Ifcert.Domain.Abstracoes;

public interface IRepository<T> where T : class
{
    Task<T?> ObterPorIdAsync(Guid id, CancellationToken cancellationToken = default);
    Task<IReadOnlyList<T>> ListarAsync(CancellationToken cancellationToken = default);
    Task AdicionarAsync(T entidade, CancellationToken cancellationToken = default);
    void Atualizar(T entidade);
    void Remover(T entidade);
    Task<bool> ExisteAsync(Guid id, CancellationToken cancellationToken = default);
}

