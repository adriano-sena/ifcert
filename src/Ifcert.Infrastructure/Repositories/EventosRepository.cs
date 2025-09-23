using Ifcert.Domain.Entities;
using Ifcert.Domain.Entities.Commom;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;

namespace Ifcert.Infrastructure.Repositories;

public class EventosRepository : RepositorioBase<Evento>, IEventosRepository
{
    public EventosRepository(ApplicationDbContext contexto) : base(contexto)
    { }

}