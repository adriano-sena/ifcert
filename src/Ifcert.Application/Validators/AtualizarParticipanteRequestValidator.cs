using FluentValidation;
using Ifcert.Application.DTOs;

namespace Ifcert.Application.Validators;

public class AtualizarParticipanteRequestValidator : AbstractValidator<AtualizarParticipanteRequest>
{
    public AtualizarParticipanteRequestValidator()
    {
        RuleFor(x => x)
            .Must(x => !string.IsNullOrWhiteSpace(x.Nome) || !string.IsNullOrWhiteSpace(x.Email))
            .WithMessage("Informe ao menos um campo para atualização (Nome ou E-mail).");

        When(x => !string.IsNullOrWhiteSpace(x.Nome), () =>
        {
            RuleFor(x => x.Nome!)
                .NotEmpty().WithMessage("Nome é obrigatório.")
                .MaximumLength(200).WithMessage("Nome deve ter no máximo 200 caracteres.");
        });

        When(x => !string.IsNullOrWhiteSpace(x.Email), () =>
        {
            RuleFor(x => x.Email!)
                .NotEmpty().WithMessage("E-mail é obrigatório.")
                .EmailAddress().WithMessage("E-mail em formato inválido.")
                .MaximumLength(254).WithMessage("E-mail excede o tamanho máximo (254).");
        });
    }
}

