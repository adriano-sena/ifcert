using Ifcert.Application.DTOs;

namespace Ifcert.Application.Contracts;

public interface IEventosService
{
    Task<EventoDto> CriarAsync(CriarEventoRequest request, CancellationToken cancellationToken = default);
    Task<IReadOnlyList<EventoDto>> ListarAsync(CancellationToken cancellationToken = default);
    Task<EventoDto?> ObterPorIdAsync(Guid id, CancellationToken cancellationToken = default);
}

