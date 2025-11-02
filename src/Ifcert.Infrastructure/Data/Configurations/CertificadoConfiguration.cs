using Ifcert.Domain.Entities;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata.Builders;

namespace Ifcert.Infrastructure.Data.Configurations;

public class CertificadoConfiguration : IEntityTypeConfiguration<Certificado>
{
    public void Configure(EntityTypeBuilder<Certificado> cfg)
    {
        cfg.ToTable("certificados");

        cfg.HasKey(x => x.Id);
        cfg.Property(x => x.Id).HasColumnName("id");
        cfg.Property(x => x.DataCriacao).HasColumnName("data_criacao");
        cfg.Property(x => x.DataAlteracao).HasColumnName("data_modificacao");

        cfg.Property(x => x.InscricaoId).HasColumnName("inscricao_id");
        cfg.Property(x => x.AtividadeId).HasColumnName("atividade_id");
        cfg.Property(x => x.EventoId).HasColumnName("evento_id");
        cfg.Property(x => x.ParticipanteId).HasColumnName("participante_id");

        cfg.OwnsOne(x => x.Codigo, c =>
        {
            c.Property(p => p.Valor).HasColumnName("codigo").IsRequired();
            c.HasIndex(p => p.Valor).IsUnique();
        });

        cfg.Property(x => x.EmitidoEmUtc).HasColumnName("emitido_em_utc");
        cfg.Property(x => x.CargaHorariaHoras).HasColumnName("carga_horaria_h");
        cfg.Property(x => x.PdfUrl).HasColumnName("pdf_url").HasMaxLength(1024);

        cfg.HasIndex(x => x.InscricaoId).IsUnique().HasDatabaseName("ux_certificado_inscricao");
    }
}