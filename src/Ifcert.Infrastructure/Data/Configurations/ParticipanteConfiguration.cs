using Ifcert.Domain.Entities;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata.Builders;

namespace Ifcert.Infrastructure.Data.Configurations;

public class ParticipanteConfiguration : IEntityTypeConfiguration<Participante>
{
    public void Configure(EntityTypeBuilder<Participante> builder)
    {
        builder.ToTable("participantes");

        builder.HasKey(p => p.Id);

        builder.Property(p => p.Id).HasColumnName("id");
        builder.Property(p => p.DataCriacao).HasColumnName("data_criacao");
        builder.Property(p => p.DataAlteracao).HasColumnName("data_modificacao");
        builder.Property(p => p.Nome).HasColumnName("nome").IsRequired();

        // Owned: Email -> coluna "email" com índice único
        builder.OwnsOne(p => p.Email, nb =>
        {
            nb.Property(e => e.Valor)
              .HasColumnName("email")
              .IsRequired();

            nb.HasIndex(e => e.Valor).IsUnique();
        });
    }
}

