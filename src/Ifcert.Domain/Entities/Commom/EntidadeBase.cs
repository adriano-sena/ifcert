namespace Ifcert.Domain.Entities.Commom;

public class EntidadeBase 
{
    public Guid Id { get; protected set; } = Guid.NewGuid();
    public DateTime DataCriacao { get; protected set; } = DateTime.Now;
    public DateTime DataAlteracao { get; protected set; }
    
    public void MarcarModificacao() => DataAlteracao = DateTime.Now;
    
}