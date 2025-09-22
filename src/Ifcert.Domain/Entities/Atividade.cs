using Ifcert.Domain.Entities.Commom;
using IfcERT.Domain.ValueObjects;

namespace Ifcert.Domain.Entities;

public class Atividade : EntidadeBase
{
    public Guid EventoId { get; private set; }
    public string Titulo { get; private set; } = default!;
    public string? Descricao { get; private set; }
    public IntervaloDatas Agenda { get; private set; } = default!;
    public int Capacidade { get; private set; }

    private readonly List<Inscricao> _inscricoes = new();
    public IReadOnlyCollection<Inscricao> Inscricoes => _inscricoes.AsReadOnly();

    private Atividade() { }
    public Atividade(Guid eventoId, string titulo, string? descricao, IntervaloDatas agenda, int capacidade)
    {
        EventoId = eventoId;
        if (string.IsNullOrWhiteSpace(titulo)) throw new ArgumentException("Título é obrigatório.");
        Titulo = titulo.Trim();
        Descricao = descricao;
        Agenda = agenda;
        Capacidade = capacidade > 0 ? capacidade : throw new ArgumentException("Capacidade deve ser maior que zero.");
    }

    public Inscricao Inscrever(Participante participante)
    {
        if (_inscricoes.Count >= Capacidade)
            throw new InvalidOperationException("Capacidade esgotada para esta atividade.");
        if (_inscricoes.Any(r => r.ParticipanteId == participante.Id))
            throw new InvalidOperationException("Participante já inscrito nesta atividade.");

        var ins = Inscricao.Criar(this.Id, participante.Id);
        _inscricoes.Add(ins);
        return ins;
    }
}
