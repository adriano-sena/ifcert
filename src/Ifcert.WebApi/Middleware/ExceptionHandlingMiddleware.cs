using System.Net;
using Microsoft.AspNetCore.Mvc;

namespace Ifcert.WebApi.Middleware;

public class ExceptionHandlingMiddleware
{
    private readonly RequestDelegate _next;

    public ExceptionHandlingMiddleware(RequestDelegate next)
    {
        _next = next;
    }

    public async Task Invoke(HttpContext context)
    {
        try
        {
            await _next(context);
        }
        catch (KeyNotFoundException ex)
        {
            await WriteProblem(context, ex.Message, (int)HttpStatusCode.NotFound, "recurso_nao_encontrado");
        }
        catch (ArgumentException ex)
        {
            await WriteProblem(context, ex.Message, (int)HttpStatusCode.BadRequest, "argumento_invalido");
        }
        catch (InvalidOperationException ex)
        {
            await WriteProblem(context, ex.Message, (int)HttpStatusCode.BadRequest, "operacao_invalida");
        }
        catch (UnauthorizedAccessException ex)
        {
            await WriteProblem(context, ex.Message, (int)HttpStatusCode.Unauthorized, "nao_autorizado");
        }
        catch (Exception ex)
        {
            await WriteProblem(context, "Erro interno do servidor.", (int)HttpStatusCode.InternalServerError, "erro_interno", ex);
        }
    }

    private static async Task WriteProblem(HttpContext context, string message, int status, string type, Exception? ex = null)
    {
        var problem = new ProblemDetails
        {
            Title = message,
            Status = status,
            Type = type,
            Detail = ex == null ? null : ex.Message,
            Instance = context.Request.Path
        };
        context.Response.ContentType = "application/problem+json";
        context.Response.StatusCode = status;
        await context.Response.WriteAsJsonAsync(problem);
    }
}

public static class ExceptionHandlingExtensions
{
    public static IApplicationBuilder UseExceptionHandling(this IApplicationBuilder app)
        => app.UseMiddleware<ExceptionHandlingMiddleware>();
}

