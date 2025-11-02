using Ifcert.Domain.Entities.Commom;

namespace Ifcert.Domain.Entities;

public class CertificadoTemplate : EntidadeBase
{
    public string Nome { get; private set; } = default!;
    public string ConteudoHtml { get; private set; } = default!;
    public bool Ativo { get; private set; }

    protected CertificadoTemplate() { }

    public CertificadoTemplate(string nome, string conteudoHtml, bool ativo = true)
    {
        if (string.IsNullOrWhiteSpace(nome)) throw new ArgumentException("Nome é obrigatório.", nameof(nome));
        if (string.IsNullOrWhiteSpace(conteudoHtml)) throw new ArgumentException("Conteúdo do template é obrigatório.", nameof(conteudoHtml));

        Nome = nome.Trim();
        ConteudoHtml = conteudoHtml;
        Ativo = ativo;
    }

    public void AtualizarConteudo(string conteudoHtml)
    {
        if (string.IsNullOrWhiteSpace(conteudoHtml)) throw new ArgumentException("Conteúdo do template é obrigatório.", nameof(conteudoHtml));
        ConteudoHtml = conteudoHtml;
        MarcarModificacao();
    }

    public void DefinirAtivo(bool ativo)
    {
        Ativo = ativo;
        MarcarModificacao();
    }
}

