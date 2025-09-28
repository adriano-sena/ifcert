namespace Ifcert.Application.DTOs;

public class CriarAtividadeRequest
{
    public Guid EventoId { get; set; }
    public string Titulo { get; set; } = default!;
    public string? Descricao { get; set; }
    public DateTime InicioUtc { get; set; }
    public DateTime FimUtc { get; set; }
    public int Capacidade { get; set; }
}

