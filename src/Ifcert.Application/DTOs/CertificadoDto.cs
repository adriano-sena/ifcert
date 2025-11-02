namespace Ifcert.Application.DTOs;

public record CertificadoDto(
    Guid Id,
    string Codigo,
    Guid EventoId,
    Guid AtividadeId,
    Guid ParticipanteId,
    int CargaHorariaHoras,
    DateTime EmitidoEmUtc,
    string? PdfUrl
);

