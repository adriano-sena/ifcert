namespace Ifcert.Domain.Abstracoes;

public interface IFactory<T>
{
    T Criar();
}

