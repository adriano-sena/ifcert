namespace Ifcert.Application.DTOs;

public record ParticipanteDto(
    Guid Id,
    string Nome,
    string Email,
    DateTime DataCriacao,
    DateTime? DataAlteracao
);

