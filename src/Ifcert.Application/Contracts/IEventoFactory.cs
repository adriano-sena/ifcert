using Ifcert.Domain.Entities;

namespace Ifcert.Application.Contracts;

public interface IEventoFactory
{
    Evento Criar(string titulo, string? descricao, DateTime inicioUtc, DateTime fimUtc);
}

