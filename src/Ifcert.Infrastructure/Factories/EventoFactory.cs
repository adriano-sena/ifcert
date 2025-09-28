using Ifcert.Application.Contracts;
using Ifcert.Domain.Entities;
using IfcERT.Domain.ValueObjects;

namespace Ifcert.Infrastructure.Factories;

/// <summary>
/// Factory para criação de agregados Evento aplicando regras de VO IntervaloDatas.
/// </summary>
public class EventoFactory : IEventoFactory
{
    public Evento Criar(string titulo, string? descricao, DateTime inicioUtc, DateTime fimUtc)
    {
        var intervalo = IntervaloDatas.From(inicioUtc, fimUtc);
        return new Evento(titulo, descricao, intervalo);
    }
}
