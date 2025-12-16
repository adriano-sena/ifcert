using Ifcert.Domain.Entities;

namespace Ifcert.Domain.Interfaces;

public interface IAtividadesRepository : IRepository<Atividade>
{
    Task<Atividade?> ObterDetalhadaAsyncPorInscricaoId(Guid inscricaoId, CancellationToken ct = default);
}
