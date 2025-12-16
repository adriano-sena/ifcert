using Ifcert.Domain.Entities.Commom;
using IfcERT.Domain.ValueObjects;

namespace Ifcert.Domain.Entities;

public class Participante : EntidadeBase
{
    public string Nome { get; private set; }
    public Email Email { get; private set; }

    protected Participante() { }

    public Participante(string nome, Email email)
    {
        if (string.IsNullOrWhiteSpace(nome))
            throw new ArgumentException("Nome não pode ser vazio.", nameof(nome));

        Nome = nome ?? throw new ArgumentNullException(nameof(nome));
        Email = email ?? throw new ArgumentNullException(nameof(email));
    }

    public void AlterarNome(string nome)
    {
        if (string.IsNullOrWhiteSpace(nome))
            throw new ArgumentException("Nome não pode ser vazio.", nameof(nome));
        Nome = nome.Trim();
        MarcarModificacao();
    }

    public void AlterarEmail(Email email)
    {
        Email = email ?? throw new ArgumentNullException(nameof(email));
        MarcarModificacao();
    }
}
