namespace Ifcert.Application.DTOs;

public record CertificadoTemplateDto(
    Guid Id,
    Guid? EventoId,
    string Nome,
    string CorpoHtml,
    string? BackgroundImageUrl,
    bool Ativo,
    DateTime DataCriacao,
    DateTime? DataModificacao
);