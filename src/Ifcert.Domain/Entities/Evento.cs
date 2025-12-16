using Ifcert.Domain.Entities.Commom;
using IfcERT.Domain.ValueObjects;

namespace Ifcert.Domain.Entities;

/// <summary>
/// Aggregate Root que representa um Evento acadêmico.
/// Contém as Atividades e gerencia suas regras.
/// </summary>
public class Evento : EntidadeBase
{
    public string Titulo { get; private set; } = default!;
    public string? Descricao { get; private set; }
    public IntervaloDatas Agenda { get; private set; } = default!;

    private readonly List<Atividade> _atividades = new();
    public IReadOnlyCollection<Atividade> Atividades => _atividades.AsReadOnly();

    private Evento() { }
    private Evento(string titulo, string? descricao, IntervaloDatas agenda)
    {
        if (string.IsNullOrWhiteSpace(titulo)) throw new ArgumentException("Título é obrigatório.");
        Titulo = titulo.Trim();
        Descricao = descricao;
        Agenda = agenda;
    }

    public static Evento Criar(string titulo, string? descricao, DateTime inicioUtc, DateTime fimUtc)
    {
        var intervalo = IntervaloDatas.From(inicioUtc, fimUtc);
        return new Evento(titulo, descricao, intervalo);
    }

    public Atividade AdicionarAtividade(string titulo, string? descricao, DateTime inicioUtc, DateTime fimUtc, int capacidade)
    {
        var intervalo = IntervaloDatas.From(inicioUtc, fimUtc);
        if (intervalo.InicioUtc < Agenda.InicioUtc || intervalo.FimUtc > Agenda.FimUtc)
            throw new InvalidOperationException("A atividade deve ocorrer dentro do período do evento.");

        var atividade = new Atividade(this.Id, titulo, descricao, intervalo, capacidade);
        _atividades.Add(atividade);
        return atividade;
    }
}
