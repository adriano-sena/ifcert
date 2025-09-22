namespace Ifcert.Domain.Entities.Commom;

public class Inscricao : EntidadeBase
{
    public Guid AtividadeId { get; private set; }
    public Guid ParticipanteId { get; private set; }
    public DateTime DataInscricaoUtc { get; private set; }

    protected Inscricao() { }

    public static Inscricao Criar(Guid atividadeId, Guid participanteId)
    {
        return new Inscricao
        {
            AtividadeId = atividadeId,
            ParticipanteId = participanteId,
            DataInscricaoUtc = DateTime.UtcNow
        };
    }
}
