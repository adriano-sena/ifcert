namespace Ifcert.Application.DTOs;

public record InscricaoDto(
    Guid Id,
    Guid AtividadeId,
    Guid ParticipanteId,
    DateTime DataCriacao,
    DateTime? DataAlteracao
);

