namespace Ifcert.Application.DTOs;

public class RegisterRequest
{
    public string Nome { get; set; } = default!;
    public string Email { get; set; } = default!;
    public string Senha { get; set; } = default!;
    public string ConfirmarSenha { get; set; } = default!;
}

