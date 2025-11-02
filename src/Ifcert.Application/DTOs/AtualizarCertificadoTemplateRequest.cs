using System.ComponentModel.DataAnnotations;

namespace Ifcert.Application.DTOs;

public class AtualizarCertificadoTemplateRequest
{
    [Required, StringLength(200)]
    public string Nome { get; set; } = default!;

    [Required]
    public string CorpoHtml { get; set; } = default!;

    [StringLength(1024)]
    public string? BackgroundImageUrl { get; set; }

    public bool Ativo { get; set; }
}