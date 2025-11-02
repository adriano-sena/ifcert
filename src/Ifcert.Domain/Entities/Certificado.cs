using Ifcert.Domain.Entities.Commom;
using Ifcert.Domain.ValueObjects;

namespace Ifcert.Domain.Entities;

public class Certificado : EntidadeBase
{
    public Guid InscricaoId { get; private set; }
    public Guid AtividadeId { get; private set; }
    public Guid EventoId { get; private set; }
    public Guid ParticipanteId { get; private set; }

    public CodigoCertificado Codigo { get; private set; } = default!;
    public DateTime EmitidoEmUtc { get; private set; }
    public int CargaHorariaHoras { get; private set; }
    public string? PdfUrl { get; private set; }

    private Certificado() { }

    private Certificado(Guid inscricaoId, Guid atividadeId, Guid eventoId, Guid participanteId,
        CodigoCertificado codigo, DateTime emitidoEmUtc, int cargaHoras, string? pdfUrl)
    {
        InscricaoId = inscricaoId;
        AtividadeId = atividadeId;
        EventoId = eventoId;
        ParticipanteId = participanteId;
        Codigo = codigo;
        EmitidoEmUtc = DateTime.SpecifyKind(emitidoEmUtc, DateTimeKind.Utc);
        CargaHorariaHoras = cargaHoras > 0 ? cargaHoras : throw new ArgumentException("Carga horária inválida.");
        PdfUrl = string.IsNullOrWhiteSpace(pdfUrl) ? null : pdfUrl.Trim();
    }

    public static Certificado Emitir(Guid inscricaoId, Guid atividadeId, Guid eventoId, Guid participanteId,
        int cargaHoras, string? pdfUrl = null)
        => new Certificado(inscricaoId, atividadeId, eventoId, participanteId,
            CodigoCertificado.Generate(), DateTime.UtcNow, cargaHoras, pdfUrl);

    public void DefinirPdfUrl(string url) => PdfUrl = string.IsNullOrWhiteSpace(url) ? null : url.Trim();
}