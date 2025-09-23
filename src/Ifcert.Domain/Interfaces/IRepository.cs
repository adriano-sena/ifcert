namespace Ifcert.Domain.Interfaces;

public interface IRepository<T> where T : class
{
    Task<T?> ObterPorIdAsync(Guid id, CancellationToken cancellationToken = default);
    Task<IReadOnlyList<T>> ListarAsync(CancellationToken cancellationToken = default);
    void CriarAsync(T entidade, CancellationToken cancellationToken = default);
    void Atualizar(T entidade);
    void Deletar(T entidade);
    Task<bool> ExisteAsync(Guid id, CancellationToken cancellationToken = default);
}

