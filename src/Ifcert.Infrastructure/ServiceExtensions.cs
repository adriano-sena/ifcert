using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;
using Ifcert.Infrastructure.Factories;
using Ifcert.Infrastructure.Repositories;
using Ifcert.Application.Contracts;
using Ifcert.Application.Services;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;

namespace Ifcert.Infrastructure;

public static class ServiceExtensions
{
    public static void ConfigurePersistence(this IServiceCollection services,
        IConfiguration configuration)
    {
        var connectionString = configuration.GetConnectionString("DefaultConnection");

        services.AddDbContext<ApplicationDbContext>(options =>
            options.UseNpgsql(connectionString));

        // UnitOfWork
        services.AddScoped<IUnitOfWork, UnitOfWork>();

        // Repositories
        services.AddScoped<IEventosRepository, EventosRepository>();
        services.AddScoped<IAtividadesRepository, AtividadesRepository>();
        services.AddScoped<IParticipantesRepository, ParticipantesRepository>();
        services.AddScoped<ICertificadosRepository, CertificadosRepository>();
        services.AddScoped<ICertificadoTemplatesRepository, CertificadoTemplatesRepository>();

        // Application Services
        services.AddScoped<IEventosService, EventosService>();
        services.AddScoped<IAtividadesService, AtividadesService>();

        // Factories
        services.AddSingleton<IEventoFactory, EventoFactory>();
    }
}
