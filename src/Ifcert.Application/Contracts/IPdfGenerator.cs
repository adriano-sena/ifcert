using Ifcert.Domain.Entities;

namespace Ifcert.Application.Abstractions;

public interface IPdfGenerator
{
    Task<string> GerarAsync(Certificado cert, Evento evento, Atividade atividade, Participante participante, CancellationToken ct);
}