using Ifcert.Application.DTOs;
using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Ifcert.Application.Contracts;

namespace Ifcert.Application.Services;

public class EventosService : IEventosService
{
    private readonly IEventosRepository _eventosRepository;
    private readonly IUnitOfWork _unitOfWork;

    public EventosService(
        IEventosRepository eventosRepository,
        IUnitOfWork unitOfWork)
    {
        _eventosRepository = eventosRepository;
        _unitOfWork = unitOfWork;
    }

    public async Task<EventoDto> CriarAsync(CriarEventoRequest request, CancellationToken cancellationToken = default)
    {
        if (string.IsNullOrWhiteSpace(request.Titulo))
            throw new ArgumentException("Título é obrigatório.", nameof(request.Titulo));

        // Unicidade por título
        var existentes = await _eventosRepository.ListarAsync(cancellationToken);
        if (existentes.Any(e => string.Equals(e.Titulo, request.Titulo.Trim(), StringComparison.OrdinalIgnoreCase)))
            throw new InvalidOperationException("Já existe um evento com este título.");

        var evento = Evento.Criar(request.Titulo, request.Descricao, request.InicioUtc, request.FimUtc);

        _eventosRepository.CriarAsync(evento, cancellationToken);
        await _unitOfWork.SalvarAlteracoesAsync(cancellationToken);

        return MapToDto(evento);
    }

    public async Task<IReadOnlyList<EventoDto>> ListarAsync(CancellationToken cancellationToken = default)
    {
        var eventos = await _eventosRepository.ListarAsync(cancellationToken);
        return eventos.Select(MapToDto).ToList();
    }

    public async Task<EventoDto?> ObterPorIdAsync(Guid id, CancellationToken cancellationToken = default)
    {
        var evento = await _eventosRepository.ObterPorIdAsync(id, cancellationToken);
        return evento is null ? null : MapToDto(evento);
    }

    public async Task AtualizarAsync(Guid id, CriarEventoRequest request, CancellationToken cancellationToken = default)
    {
        var evento = await _eventosRepository.ObterPorIdAsync(id, cancellationToken)
            ?? throw new KeyNotFoundException("Evento não encontrado.");

        if (string.IsNullOrWhiteSpace(request.Titulo))
            throw new ArgumentException("Título é obrigatório.", nameof(request.Titulo));

        // Verifica duplicidade de título em outros eventos
        var existentes = await _eventosRepository.ListarAsync(cancellationToken);
        if (existentes.Any(e => e.Id != id && string.Equals(e.Titulo, request.Titulo.Trim(), StringComparison.OrdinalIgnoreCase)))
            throw new InvalidOperationException("Já existe um evento com este título.");

        evento.AtualizarDadosBasicos(request.Titulo, request.Descricao, request.InicioUtc, request.FimUtc);
        _eventosRepository.Atualizar(evento);
        await _unitOfWork.SalvarAlteracoesAsync(cancellationToken);
    }

    public async Task RemoverAsync(Guid id, CancellationToken cancellationToken = default)
    {
        var evento = await _eventosRepository.ObterPorIdAsync(id, cancellationToken)
            ?? throw new KeyNotFoundException("Evento não encontrado.");
        _eventosRepository.Deletar(evento);
        await _unitOfWork.SalvarAlteracoesAsync(cancellationToken);
    }

    private static EventoDto MapToDto(Evento e)
        => new(e.Id, e.Titulo, e.Descricao, e.Agenda.InicioUtc, e.Agenda.FimUtc);
}
