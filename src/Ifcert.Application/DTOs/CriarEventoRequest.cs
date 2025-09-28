namespace Ifcert.Application.DTOs;

public class CriarEventoRequest
{
    public string Titulo { get; set; } = default!;
    public string? Descricao { get; set; }
    public DateTime InicioUtc { get; set; }
    public DateTime FimUtc { get; set; }
}

