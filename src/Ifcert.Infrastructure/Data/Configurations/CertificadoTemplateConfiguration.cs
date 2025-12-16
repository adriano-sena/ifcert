using Ifcert.Domain.Entities;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata.Builders;

namespace Ifcert.Infrastructure.Data.Configurations;

public class CertificadoTemplateConfiguration : IEntityTypeConfiguration<CertificadoTemplate>
{
    public void Configure(EntityTypeBuilder<CertificadoTemplate> cfg)
    {
        cfg.ToTable("certificado_templates");

        cfg.HasKey(x => x.Id);
        cfg.Property(x => x.Id).HasColumnName("id");
        cfg.Property(x => x.DataCriacao).HasColumnName("data_criacao");
        cfg.Property(x => x.DataAlteracao).HasColumnName("data_modificacao");

        cfg.Property(x => x.EventoId).HasColumnName("evento_id");
        cfg.Property(x => x.Nome).HasColumnName("nome").IsRequired();
        cfg.Property(x => x.ConteudoHtml).HasColumnName("conteudo_html").IsRequired();
        cfg.Property(x => x.BackgroundImageUrl).HasColumnName("background_image_url");
        cfg.Property(x => x.Ativo).HasColumnName("ativo").IsRequired();

        cfg.HasIndex(x => x.Nome);
    }
}
