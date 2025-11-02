using Ifcert.Domain.Entities.Commom;
using Ifcert.Domain.ValueObjects;

namespace Ifcert.Domain.Entities;

public class Certificado : EntidadeBase
{
    public Guid InscricaoId { get; private set; }
    public CodigoCertificado Codigo { get; private set; } = default!;
    public Guid? TemplateId { get; private set; }
    public DateTime EmitidoEmUtc { get; private set; }

    protected Certificado() { }

    private Certificado(Guid inscricaoId, CodigoCertificado codigo, Guid? templateId)
    {
        if (inscricaoId == Guid.Empty) throw new ArgumentException("Inscrição inválida.", nameof(inscricaoId));
        InscricaoId = inscricaoId;
        Codigo = codigo ?? throw new ArgumentNullException(nameof(codigo));
        TemplateId = templateId;
        EmitidoEmUtc = DateTime.UtcNow;
    }

    public static Certificado Emitir(Guid inscricaoId, CodigoCertificado? codigo = null, Guid? templateId = null)
    {
        var cod = codigo ?? CodigoCertificado.Generate();
        return new Certificado(inscricaoId, cod, templateId);
    }
}

