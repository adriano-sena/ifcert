using Ifcert.Domain.Entities;
using Ifcert.Domain.Entities.Commom;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;

namespace Ifcert.Infrastructure.Data;

public class ApplicationDbContext : IdentityDbContext<IdentityUser, IdentityRole, string>
{
    public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options) : base(options) { }

    public DbSet<Participante> Participantes { get; set; }
    public DbSet<Evento> Eventos { get; set; }
    public DbSet<Atividade> Atividades { get; set; }
    public DbSet<Inscricao> Inscricoes { get; set; }
    public DbSet<Certificado> Certificados { get; set; }
    public DbSet<CertificadoTemplate> CertificadoTemplates { get; set; }

    protected override void OnModelCreating(ModelBuilder modelBuilder)
    {
        modelBuilder.ApplyConfigurationsFromAssembly(typeof(ApplicationDbContext).Assembly);
        base.OnModelCreating(modelBuilder);
    }
}
