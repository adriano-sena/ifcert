using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using IfcERT.Domain.ValueObjects;

namespace Ifcert.Application.Services;

public class ParticipantesService : IParticipantesService
{
    private readonly IParticipantesRepository _repo;
    private readonly IUnitOfWork _uow;

    public ParticipantesService(
        IParticipantesRepository repo,
        IUnitOfWork uow)
    {
        _repo = repo;
        _uow = uow;
    }

    public async Task<ParticipanteDto> CriarAsync(CriarParticipanteRequest request, CancellationToken ct = default)
    {
        if (string.IsNullOrWhiteSpace(request.Nome))
            throw new ArgumentException("Nome é obrigatório.", nameof(request.Nome));
        if (string.IsNullOrWhiteSpace(request.Email))
            throw new ArgumentException("E-mail é obrigatório.", nameof(request.Email));

        var email = Email.From(request.Email);
        var participante = new Participante(request.Nome.Trim(), email);
        _repo.CriarAsync(participante, ct);
        await _uow.SalvarAlteracoesAsync(ct);
        return Map(participante);
    }

    public async Task AtualizarAsync(Guid id, AtualizarParticipanteRequest request, CancellationToken ct = default)
    {
        var participante = await _repo.ObterPorIdAsync(id, ct) ?? throw new KeyNotFoundException("Participante não encontrado.");

        if (!string.IsNullOrWhiteSpace(request.Nome))
            participante.AlterarNome(request.Nome);
        if (!string.IsNullOrWhiteSpace(request.Email))
            participante.AlterarEmail(Email.From(request.Email));

        _repo.Atualizar(participante);
        await _uow.SalvarAlteracoesAsync(ct);
    }

    public async Task RemoverAsync(Guid id, CancellationToken ct = default)
    {
        var participante = await _repo.ObterPorIdAsync(id, ct);
        if (participante is null) return;
        _repo.Deletar(participante);
        await _uow.SalvarAlteracoesAsync(ct);
    }

    public async Task<ParticipanteDto?> ObterPorIdAsync(Guid id, CancellationToken ct = default)
    {
        var p = await _repo.ObterPorIdAsync(id, ct);
        return p is null ? null : Map(p);
    }

    public async Task<IReadOnlyList<ParticipanteDto>> ListarAsync(CancellationToken ct = default)
    {
        var itens = await _repo.ListarAsync(ct);
        return itens.Select(Map).ToList();
    }

    private static ParticipanteDto Map(Participante p)
        => new(
            p.Id,
            p.Nome,
            p.Email.Valor,
            p.DataCriacao,
            p.DataAlteracao == default ? (DateTime?)null : p.DataAlteracao
        );
}

