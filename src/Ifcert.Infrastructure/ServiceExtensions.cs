using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;
using Ifcert.Infrastructure.Repositories;
using Ifcert.Application.Contracts;
using Ifcert.Application.Abstractions;
using Ifcert.Infrastructure.Pdf;
using Ifcert.Application.Services;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;
using QuestPDF.Infrastructure;

namespace Ifcert.Infrastructure;

public static class ServiceExtensions
{
    public static void ConfigurePersistence(this IServiceCollection services,
        IConfiguration configuration)
    {
        // Configuração de licença do QuestPDF (Community)
        QuestPDF.Settings.License = LicenseType.Community;

        var connectionString = configuration.GetConnectionString("DefaultConnection");

        services.AddDbContext<ApplicationDbContext>(options =>
            options.UseNpgsql(connectionString));

        // UnitOfWork
        services.AddScoped<IUnitOfWork, UnitOfWork>();

        // Repositories
        services.AddScoped<IEventosRepository, EventosRepository>();
        services.AddScoped<IAtividadesRepository, AtividadesRepository>();
        services.AddScoped<IParticipantesRepository, ParticipantesRepository>();
        services.AddScoped<IInscricoesRepository, InscricoesRepository>();
        services.AddScoped<ICertificadosRepository, CertificadosRepository>();
        services.AddScoped<ICertificadoTemplatesRepository, CertificadoTemplatesRepository>();

        // Application Services
        services.AddScoped<IEventosService, EventosService>();
        services.AddScoped<IAtividadesService, AtividadesService>();
        services.AddScoped<IInscricoesService, InscricoesService>();
        services.AddScoped<ICertificadosService, CertificadosService>();
        services.AddScoped<ICertificadoTemplatesService, CertificadoTemplatesService>();
        services.AddScoped<IParticipantesService, ParticipantesService>();

        // PDF
        services.AddSingleton<IPdfGenerator, QuestPdfGenerator>();

        // Factories removidas: Evento agora usa Factory Method estático.
        
        services.AddScoped<ICertificadosRepository, CertificadosRepository>();
        services.AddScoped<ICertificadoTemplatesRepository, CertificadoTemplatesRepository>();
        services.AddScoped<ICertificadosService, CertificadosService>();
        services.AddScoped<ICertificadoTemplatesService, CertificadoTemplatesService>();
        services.AddScoped<IPdfGenerator, QuestPdfGenerator>();
    }
}
