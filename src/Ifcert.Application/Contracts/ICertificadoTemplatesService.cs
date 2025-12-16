using Ifcert.Application.DTOs;

namespace Ifcert.Application.Contracts;

public interface ICertificadoTemplatesService
{
    Task<Guid> CriarAsync(CriarCertificadoTemplateRequest request, CancellationToken ct = default);
    Task AtualizarAsync(Guid id, AtualizarCertificadoTemplateRequest request, CancellationToken ct = default);
    Task RemoverAsync(Guid id, CancellationToken ct = default);
    Task<CertificadoTemplateDto?> ObterPorIdAsync(Guid id, CancellationToken ct = default);
    Task<IReadOnlyList<CertificadoTemplateDto>> ListarPorEventoAsync(Guid? eventoId, CancellationToken ct = default);
}