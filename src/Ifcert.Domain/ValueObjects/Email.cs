using System.Text.RegularExpressions;

namespace IfcERT.Domain.ValueObjects;

public sealed class Email : IEquatable<Email>
{
    private static readonly Regex EmailRegex = new(
        pattern: @"^[^@\s]+@[^@\s]+\.[^@\s]+$",
        options: RegexOptions.Compiled | RegexOptions.CultureInvariant,
        matchTimeout: TimeSpan.FromMilliseconds(250));

    public string Valor { get; }

    private Email() { } // EF Core
    private Email(string valor) => Valor = valor;

    public static Email From(string? value)
    {
        if (value is null) throw new ArgumentNullException(nameof(value), "E-mail não pode ser nulo.");
        var v = value.Trim();
        if (v.Length == 0) throw new ArgumentException("E-mail não pode ser vazio.", nameof(value));
        if (v.Length > 254) throw new ArgumentException("E-mail excede o tamanho máximo (254).", nameof(value));
        if (!EmailRegex.IsMatch(v)) throw new ArgumentException("E-mail em formato inválido.", nameof(value));
        return new Email(v.ToLowerInvariant());
    }

    public static bool TryFrom(string? value, out Email? email)
    {
        email = null;
        if (string.IsNullOrWhiteSpace(value)) return false;
        var v = value.Trim();
        if (v.Length > 254 || !EmailRegex.IsMatch(v)) return false;
        email = new Email(v.ToLowerInvariant());
        return true;
    }

    public override string ToString() => Valor;
    public bool Equals(Email? other) => other is not null && Valor == other.Valor;
    public override bool Equals(object? obj) => obj is Email e && Equals(e);
    public override int GetHashCode() => Valor.GetHashCode(StringComparison.Ordinal);

    public static explicit operator Email(string value) => From(value);
    public static implicit operator string(Email email) => email.Valor;
}