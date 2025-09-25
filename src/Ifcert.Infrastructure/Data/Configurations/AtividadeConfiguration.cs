using Ifcert.Domain.Entities;
using Ifcert.Domain.Entities.Commom;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata.Builders;

namespace Ifcert.Infrastructure.Data.Configurations;

public class AtividadeConfiguration : IEntityTypeConfiguration<Atividade>
{
    public void Configure(EntityTypeBuilder<Atividade> builder)
    {
        builder.ToTable("atividades");

        builder.HasKey(a => a.Id);

        builder.Property(a => a.Id).HasColumnName("id");
        builder.Property(a => a.DataCriacao).HasColumnName("data_criacao");
        builder.Property(a => a.DataAlteracao).HasColumnName("data_modificacao");
        builder.Property(a => a.EventoId).HasColumnName("evento_id");
        builder.Property(a => a.Titulo).HasColumnName("titulo").IsRequired();
        builder.Property(a => a.Descricao).HasColumnName("descricao");
        builder.Property(a => a.Capacidade).HasColumnName("capacidade").IsRequired();

        // Owned: Agenda (IntervaloDatas)
        builder.OwnsOne(a => a.Agenda, nb =>
        {
            nb.Property(x => x.InicioUtc).HasColumnName("inicio_utc").IsRequired();
            nb.Property(x => x.FimUtc).HasColumnName("fim_utc").IsRequired();
        });

        // Relacionamento 1:N com Inscricoes usando backing field _inscricoes
        builder.HasMany(a => a.Inscricoes)
               .WithOne()
               .HasForeignKey((Inscricao i) => i.AtividadeId)
               .IsRequired()
               .OnDelete(DeleteBehavior.Cascade);

        var inscricoesNav = builder.Metadata.FindNavigation(nameof(Atividade.Inscricoes));
        inscricoesNav?.SetField("_inscricoes");
        inscricoesNav?.SetPropertyAccessMode(PropertyAccessMode.Field);
    }
}

