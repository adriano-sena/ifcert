using Ifcert.Domain.Entities.Commom;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata.Builders;

namespace Ifcert.Infrastructure.Data.Configurations;

public class InscricaoConfiguration : IEntityTypeConfiguration<Inscricao>
{
    public void Configure(EntityTypeBuilder<Inscricao> builder)
    {
        builder.ToTable("inscricoes");

        builder.HasKey(i => i.Id);

        builder.Property(i => i.Id).HasColumnName("id");
        builder.Property(i => i.DataCriacao).HasColumnName("data_criacao");
        builder.Property(i => i.DataAlteracao).HasColumnName("data_modificacao");
        builder.Property(i => i.AtividadeId).HasColumnName("atividade_id");
        builder.Property(i => i.ParticipanteId).HasColumnName("participante_id");
        builder.Property(i => i.DataInscricaoUtc).HasColumnName("data_inscricao_utc");

        // Índice único nomeado: (AtividadeId, ParticipanteId)
        builder.HasIndex(i => new { i.AtividadeId, i.ParticipanteId })
               .IsUnique()
               .HasDatabaseName("ux_inscricao_atividade_participante");
    }
}

