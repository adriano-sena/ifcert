using Ifcert.Application.Abstractions;
using Ifcert.Domain.Entities;
using QuestPDF.Fluent;
using QuestPDF.Helpers;

namespace Ifcert.Infrastructure.Pdf;

public class QuestPdfGenerator : IPdfGenerator
{
    public async Task<string> GerarAsync(Certificado cert, Evento evento, Atividade atividade, Participante participante, CancellationToken ct)
    {
        // Salva dentro do wwwroot para servir estático
        var webRoot = Path.Combine(Directory.GetCurrentDirectory(), "wwwroot");
        var dir = Path.Combine(webRoot, "certificados");
        Directory.CreateDirectory(dir);

        var safeCode = cert.Codigo.Valor; // ou cert.Codigo se for string
        var fileName = $"certificado_{safeCode}.pdf";
        var path = Path.Combine(dir, fileName);

        var doc = Document.Create(container =>
        {
            container.Page(page =>
            {
                page.Size(PageSizes.A4);
                page.Margin(40);
                page.Content().Column(col =>
                {
                    col.Item().Text("Certificado de Participação").FontSize(22).Bold().AlignCenter();
                    col.Item().Text($"Código: {cert.Codigo}").AlignCenter();
                    col.Item().Text($"Participante: {participante.Nome}");
                    col.Item().Text($"Evento: {evento.Titulo}");
                    col.Item().Text($"Atividade: {atividade.Titulo}");
                    col.Item().Text($"Carga horária: {cert.CargaHorariaHoras}h");
                    col.Item().Text($"Emitido em: {cert.EmitidoEmUtc:dd/MM/yyyy HH:mm} UTC");
                });
            });
        });

        await Task.Run(() => doc.GeneratePdf(path), ct);

        // Retorna a URL pública relativa (servida pelo StaticFiles)
        return $"/certificados/{fileName}";
    }
}

