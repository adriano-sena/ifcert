using Ifcert.Domain.Entities;
using Ifcert.Domain.Interfaces;
using Ifcert.Infrastructure.Data;

namespace Ifcert.Infrastructure.Repositories;

public class ParticipantesRepository : RepositorioBase<Participante>, IParticipantesRepository
{
    public ParticipantesRepository(ApplicationDbContext contexto) : base(contexto)
    { }
}

