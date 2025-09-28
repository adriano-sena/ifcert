using Ifcert.Application.DTOs;

namespace Ifcert.Application.Contracts;

public interface IAtividadesService
{
    Task<Guid> AdicionarAoEventoAsync(CriarAtividadeRequest request, CancellationToken cancellationToken = default);
    Task<Guid> InscreverAsync(Guid atividadeId, Guid participanteId, CancellationToken cancellationToken = default);
}

