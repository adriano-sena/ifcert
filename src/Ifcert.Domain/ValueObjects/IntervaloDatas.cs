namespace IfcERT.Domain.ValueObjects;

/// <summary>
/// Intervalo de datas em UTC: imutável, igualdade por valor, validação e normalização.
/// </summary>
public sealed class IntervaloDatas : IEquatable<IntervaloDatas>
{
    public DateTime InicioUtc { get; }
    public DateTime FimUtc   { get; }

    // Necessário ao EF Core (owned type)
    private IntervaloDatas() { }

    private IntervaloDatas(DateTime inicioUtc, DateTime fimUtc)
    {
        InicioUtc = inicioUtc;
        FimUtc    = fimUtc;
    }

    /// <summary>
    /// Cria e valida um intervalo, normalizando para UTC.
    /// </summary>
    /// <exception cref="ArgumentException">Se o fim não for maior que o início.</exception>
    public static IntervaloDatas From(DateTime inicio, DateTime fim)
    {
        var i = NormalizeUtc(inicio);
        var f = NormalizeUtc(fim);

        if (f <= i)
            throw new ArgumentException("A data/hora final deve ser maior que a inicial.");

        return new IntervaloDatas(i, f);
    }

    /// <summary>
    /// Tenta criar sem lançar exceção.
    /// </summary>
    public static bool TryFrom(DateTime inicio, DateTime fim, out IntervaloDatas? intervalo)
    {
        intervalo = null;
        var i = NormalizeUtc(inicio);
        var f = NormalizeUtc(fim);
        if (f <= i) return false;

        intervalo = new IntervaloDatas(i, f);
        return true;
    }

    /// <summary>
    /// Verifica se um instante UTC está contido no intervalo [início, fim).
    /// </summary>
    public bool Contains(DateTime instantUtc)
    {
        var t = NormalizeUtc(instantUtc);
        return t >= InicioUtc && t < FimUtc;
    }

    /// <summary>
    /// Verifica se há interseção com outro intervalo (interseção de medida positiva).
    /// </summary>
    public bool Overlaps(IntervaloDatas other)
        => other is not null && other.FimUtc > InicioUtc && FimUtc > other.InicioUtc;

    /// <summary>
    /// Duração do intervalo.
    /// </summary>
    public TimeSpan Duration => FimUtc - InicioUtc;

    public override string ToString() => $"{InicioUtc:o} - {FimUtc:o}";

    // Igualdade por valor
    public bool Equals(IntervaloDatas? other)
        => other is not null && InicioUtc == other.InicioUtc && FimUtc == other.FimUtc;

    public override bool Equals(object? obj) => obj is IntervaloDatas d && Equals(d);

    public override int GetHashCode()
        => HashCode.Combine(InicioUtc, FimUtc);

    /// <summary>
    /// Normaliza para UTC:
    /// - Utc: mantém
    /// - Local: converte para UTC (ToUniversalTime)
    /// - Unspecified: assume que já está em UTC (SpecifyKind)
    /// </summary>
    private static DateTime NormalizeUtc(DateTime dt) =>
        dt.Kind switch
        {
            DateTimeKind.Utc => dt,
            DateTimeKind.Local => dt.ToUniversalTime(),
            _ => DateTime.SpecifyKind(dt, DateTimeKind.Utc)
        };
}