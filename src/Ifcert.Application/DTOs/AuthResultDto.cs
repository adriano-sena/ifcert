namespace Ifcert.Application.DTOs;

public class AuthResultDto
{
    public Guid UsuarioId { get; set; }
    public string Email { get; set; } = default!;
    public string TokenJwt { get; set; } = default!;
    public DateTime ExpiraEmUtc { get; set; }
    public bool Sucesso { get; set; }
    public IEnumerable<string> Perfis { get; set; } = new List<string>();
    public IEnumerable<string> Erros { get; set; } = new List<string>();
}

