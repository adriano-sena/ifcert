using Ifcert.Domain.Entities;

namespace Ifcert.Domain.Interfaces;

public interface ICertificadoTemplatesRepository : IRepository<CertificadoTemplate>
{
    Task<IReadOnlyList<CertificadoTemplate>> ListarPorEventoAsync(Guid? eventoId, CancellationToken ct = default);
    Task<CertificadoTemplate?> ObterAtivoPorEventoAsync(Guid? eventoId, CancellationToken ct = default);
}