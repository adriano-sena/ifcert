using FluentValidation;
using Ifcert.Application.DTOs;

namespace Ifcert.Application.Validators;

public class CriarParticipanteRequestValidator : AbstractValidator<CriarParticipanteRequest>
{
    public CriarParticipanteRequestValidator()
    {
        RuleFor(x => x.Nome)
            .NotEmpty().WithMessage("Nome é obrigatório.")
            .MaximumLength(200).WithMessage("Nome deve ter no máximo 200 caracteres.");

        RuleFor(x => x.Email)
            .NotEmpty().WithMessage("E-mail é obrigatório.")
            .EmailAddress().WithMessage("E-mail em formato inválido.")
            .MaximumLength(254).WithMessage("E-mail excede o tamanho máximo (254).");
    }
}

