using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;

namespace Ifcert.Application.Services;

public class CertificadoTemplatesService : ICertificadoTemplatesService
{
    private readonly ICertificadoTemplatesRepository _repo;
    private readonly IUnitOfWork _uow;

    public CertificadoTemplatesService(ICertificadoTemplatesRepository repo, IUnitOfWork uow)
    {
        _repo = repo;
        _uow = uow;
    }

    public async Task<Guid> CriarAsync(CriarCertificadoTemplateRequest request, CancellationToken ct = default)
    {
        var modelo = new CertificadoTemplate(request.EventoId, request.Nome, request.CorpoHtml, request.BackgroundImageUrl, true);
        _repo.CriarAsync(modelo, ct);
        await _uow.SalvarAlteracoesAsync(ct);
        return modelo.Id;
    }

    public async Task AtualizarAsync(Guid id, AtualizarCertificadoTemplateRequest request, CancellationToken ct = default)
    {
        var model = await _repo.ObterPorIdAsync(id, ct) ?? throw new KeyNotFoundException("Modelo não encontrado.");
        model.Atualizar(request.Nome, request.CorpoHtml, request.BackgroundImageUrl, request.Ativo);
        _repo.Atualizar(model);
        await _uow.SalvarAlteracoesAsync(ct);
    }

    public async Task RemoverAsync(Guid id, CancellationToken ct = default)
    {
        var model = await _repo.ObterPorIdAsync(id, ct);
        if (model is null) return;
        _repo.Deletar(model);
        await _uow.SalvarAlteracoesAsync(ct);
    }

    public async Task<CertificadoTemplateDto?> ObterPorIdAsync(Guid id, CancellationToken ct = default)
    {
        var model = await _repo.ObterPorIdAsync(id, ct);
        return model is null ? null :
            new CertificadoTemplateDto(model.Id, model.EventoId, model.Nome, model.ConteudoHtml, model.BackgroundImageUrl, model.Ativo, model.DataCriacao, model.DataAlteracao);
    }

    public async Task<IReadOnlyList<CertificadoTemplateDto>> ListarPorEventoAsync(Guid? eventoId, CancellationToken ct = default)
    {
        var list = await _repo.ListarPorEventoAsync(eventoId, ct);
        return list.Select(m => new CertificadoTemplateDto(m.Id, m.EventoId, m.Nome, m.ConteudoHtml, m.BackgroundImageUrl, m.Ativo, m.DataCriacao, m.DataAlteracao)).ToList();
    }
}
