using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;

namespace Ifcert.Infrastructure.Repositories;

public class AtividadesRepository : RepositorioBase<Atividade>, IAtividadesRepository
{
    public AtividadesRepository(ApplicationDbContext contexto) : base(contexto)
    { }
}

