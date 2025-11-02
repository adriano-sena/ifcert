using Ifcert.Domain.Entities;

namespace Ifcert.Domain.Interfaces;

public interface ICertificadosRepository : IRepository<Certificado>
{
    Task<bool> CodigoExisteAsync(string codigo, CancellationToken ct = default);
    Task<Certificado?> ObterPorCodigoAsync(string codigo, CancellationToken ct = default);
    Task<Certificado?> ObterPorInscricaoAsync(Guid inscricaoId, CancellationToken ct = default);
}

