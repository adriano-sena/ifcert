using System.Security.Cryptography;
using System.Text;

namespace Ifcert.Domain.ValueObjects;

public sealed class CodigoCertificado : IEquatable<CodigoCertificado>
{
    public string Valor { get; }

    private CodigoCertificado() { } // EF
    private CodigoCertificado(string valor) => Valor = valor;

    public static CodigoCertificado From(string value)
    {
        var v = (value ?? "").Trim().ToUpperInvariant();
        if (v.Length < 10 || v.Length > 32) throw new ArgumentException("Código inválido.", nameof(value));
        if (!v.All(char.IsLetterOrDigit)) throw new ArgumentException("Código deve ser alfanumérico.");
        return new CodigoCertificado(v);
    }

    public static CodigoCertificado Generate(int length = 16)
    {
        const string alphabet = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789"; // sem I/O/1/0
        Span<byte> buffer = stackalloc byte[length];
        RandomNumberGenerator.Fill(buffer);
        var sb = new StringBuilder(length);
        for (int i = 0; i < length; i++)
            sb.Append(alphabet[buffer[i] % alphabet.Length]);
        return new CodigoCertificado(sb.ToString());
    }

    public override string ToString() => Valor;
    public bool Equals(CodigoCertificado? other) => other is not null && Valor == other.Valor;
    public override bool Equals(object? obj) => obj is CodigoCertificado o && Equals(o);
    public override int GetHashCode() => Valor.GetHashCode(StringComparison.Ordinal);
}

