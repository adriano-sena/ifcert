using Ifcert.Domain.Entities.Commom;

namespace Ifcert.Domain.Entities;

public class CertificadoTemplate : EntidadeBase
{
    // Opcional: template por evento (pode ser null para template global)
    public Guid? EventoId { get; private set; }

    public string Nome { get; private set; } = default!;
    public string ConteudoHtml { get; private set; } = default!; // suporta placeholders como {{Evento}}, {{Atividade}}, {{Participante}}, {{CargaHoraria}}
    public string? BackgroundImageUrl { get; private set; }
    public bool Ativo { get; private set; }

    private CertificadoTemplate() { }

    public CertificadoTemplate(Guid? eventoId, string nome, string corpoHtml, string? backgroundImageUrl, bool ativo = true)
    {
        EventoId = eventoId;
        Nome = string.IsNullOrWhiteSpace(nome) ? throw new ArgumentException("Nome é obrigatório.") : nome.Trim();
        ConteudoHtml = string.IsNullOrWhiteSpace(corpoHtml) ? throw new ArgumentException("Corpo é obrigatório.") : corpoHtml.Trim();
        BackgroundImageUrl = string.IsNullOrWhiteSpace(backgroundImageUrl) ? null : backgroundImageUrl.Trim();
        Ativo = ativo;
    }

    public void Atualizar(string nome, string corpoHtml, string? backgroundImageUrl, bool ativo)
    {
        Nome = string.IsNullOrWhiteSpace(nome) ? throw new ArgumentException("Nome é obrigatório.") : nome.Trim();
        ConteudoHtml = string.IsNullOrWhiteSpace(corpoHtml) ? throw new ArgumentException("Corpo é obrigatório.") : corpoHtml.Trim();
        BackgroundImageUrl = string.IsNullOrWhiteSpace(backgroundImageUrl) ? null : backgroundImageUrl.Trim();
        Ativo = ativo;
        //MarcarModificado();
    }
}