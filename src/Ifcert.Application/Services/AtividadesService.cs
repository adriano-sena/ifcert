using Ifcert.Application.Contracts;
using Ifcert.Application.DTOs;
using Ifcert.Domain.Entities;
using Ifcert.Domain.Entities.Commom;
using Ifcert.Domain.Interfaces;

namespace Ifcert.Application.Services;

public class AtividadesService : IAtividadesService
{
    private readonly IEventosRepository _eventosRepository;
    private readonly IAtividadesRepository _atividadesRepository;
    private readonly IParticipantesRepository _participantesRepository;
    private readonly IUnitOfWork _unitOfWork;

    public AtividadesService(
        IEventosRepository eventosRepository,
        IAtividadesRepository atividadesRepository,
        IParticipantesRepository participantesRepository,
        IUnitOfWork unitOfWork)
    {
        _eventosRepository = eventosRepository;
        _atividadesRepository = atividadesRepository;
        _participantesRepository = participantesRepository;
        _unitOfWork = unitOfWork;
    }

    public async Task<Guid> AdicionarAoEventoAsync(CriarAtividadeRequest request, CancellationToken cancellationToken = default)
    {
        var evento = await _eventosRepository.ObterPorIdAsync(request.EventoId, cancellationToken);
        if (evento is null)
            throw new InvalidOperationException("Evento não encontrado.");

        var atividade = evento.AdicionarAtividade(
            request.Titulo,
            request.Descricao,
            request.InicioUtc,
            request.FimUtc,
            request.Capacidade);

        // Persistir pelo repositório da Atividade 
        _atividadesRepository.CriarAsync(atividade, cancellationToken);
        await _unitOfWork.SalvarAlteracoesAsync(cancellationToken);
        return atividade.Id;
    }

    public async Task<Guid> InscreverAsync(Guid atividadeId, Guid participanteId, CancellationToken cancellationToken = default)
    {
        var atividade = await _atividadesRepository.ObterPorIdAsync(atividadeId, cancellationToken);
        if (atividade is null)
            throw new InvalidOperationException("Atividade não encontrada.");

        var participante = await _participantesRepository.ObterPorIdAsync(participanteId, cancellationToken);
        if (participante is null)
            throw new InvalidOperationException("Participante não encontrado.");

        var inscricao = atividade.Inscrever(participante);

        // Garantir persistência das alterações via repositório e UoW
        _atividadesRepository.Atualizar(atividade);
        await _unitOfWork.SalvarAlteracoesAsync(cancellationToken);

        return inscricao.Id;
    }
}

