namespace Ifcert.Application.DTOs;

public record EventoDto
(
    Guid Id,
    string Titulo,
    string? Descricao,
    DateTime InicioUtc,
    DateTime FimUtc
);

