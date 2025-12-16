using Ifcert.Application.DTOs;

namespace Ifcert.Application.Contracts;

public interface ICertificadosService
{
    Task<CertificadoDto> EmitirPorInscricaoAsync(Guid inscricaoId, CancellationToken ct = default);
    Task<CertificadoDto?> ObterPorCodigoAsync(string codigo, CancellationToken ct = default);
}

