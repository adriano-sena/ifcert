using FluentValidation;
using Ifcert.Application.DTOs;

namespace Ifcert.Application.Validators;

public class CriarAtividadeRequestValidator : AbstractValidator<CriarAtividadeRequest>
{
    public CriarAtividadeRequestValidator()
    {
        RuleFor(x => x.Titulo)
            .NotEmpty().WithMessage("Título é obrigatório.")
            .MaximumLength(200).WithMessage("Título deve ter no máximo 200 caracteres.");

        RuleFor(x => x.Descricao)
            .MaximumLength(2000).WithMessage("Descrição deve ter no máximo 2000 caracteres.")
            .When(x => !string.IsNullOrWhiteSpace(x.Descricao));

        RuleFor(x => x.InicioUtc)
            .NotEqual(default(DateTime)).WithMessage("Início é obrigatório.");

        RuleFor(x => x.FimUtc)
            .NotEqual(default(DateTime)).WithMessage("Fim é obrigatório.");

        RuleFor(x => x.InicioUtc.Kind)
            .Equal(DateTimeKind.Utc).WithMessage("Início deve estar em UTC (sufixo 'Z').");

        RuleFor(x => x.FimUtc.Kind)
            .Equal(DateTimeKind.Utc).WithMessage("Fim deve estar em UTC (sufixo 'Z').");

        RuleFor(x => x)
            .Must(x => x.FimUtc > x.InicioUtc)
            .WithMessage("A data/hora final deve ser maior que a inicial.");

        RuleFor(x => x.Capacidade)
            .GreaterThan(0).WithMessage("Capacidade deve ser maior que zero.");

    }
}

