using Ifcert.Domain.Entities;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata.Builders;

namespace Ifcert.Infrastructure.Data.Configurations;

public class EventoConfiguration : IEntityTypeConfiguration<Evento>
{
    public void Configure(EntityTypeBuilder<Evento> builder)
    {
        builder.ToTable("eventos");

        builder.HasKey(e => e.Id);

        builder.Property(e => e.Id).HasColumnName("id");
        builder.Property(e => e.DataCriacao).HasColumnName("data_criacao");
        builder.Property(e => e.DataAlteracao).HasColumnName("data_modificacao");
        builder.Property(e => e.Titulo).HasColumnName("titulo").IsRequired();
        builder.Property(e => e.Descricao).HasColumnName("descricao");

        builder.OwnsOne(e => e.Agenda, nb =>
        {
            nb.Property(a => a.InicioUtc).HasColumnName("inicio_utc").IsRequired();
            nb.Property(a => a.FimUtc).HasColumnName("fim_utc").IsRequired();
        });

        builder.HasMany(e => e.Atividades)
               .WithOne()
               .HasForeignKey(a => a.EventoId)
               .IsRequired()
               .OnDelete(DeleteBehavior.Cascade);

        var atividadesNav = builder.Metadata.FindNavigation(nameof(Evento.Atividades));
        atividadesNav?.SetField("_atividades");
        atividadesNav?.SetPropertyAccessMode(PropertyAccessMode.Field);
    }
}

