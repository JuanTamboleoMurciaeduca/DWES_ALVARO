<?php

declare(strict_types=1);

namespace Juan\Biblioteca\Servicio;

use Juan\Biblioteca\Modelo\Libro;

class BibliotecaService
{
    public function __construct(private array $libros) {}

    public function todos(): array
    {
        return $this->libros;
    }

    public function agregar(Libro $libro): void
    {
        $this->libros[] = $libro;
    }

    private static function normalizar(string $texto): string
    {
        return mb_strtolower(trim($texto), 'UTF-8');
    }

    public function filtrar(
        string $q,
        string $genero,
        string $tipo,
        bool $soloDestacados
    ): array {
        $texto = self::normalizar($q);

        $filtrados = array_filter(
            $this->todos(),
            fn(Libro $l) => (str_contains(self::normalizar($l->titulo()), $texto) ||
                str_contains(self::normalizar($l->autor()), $texto)) &&
                ($genero === '' || $l->genero() === $genero) &&
                ($tipo === '' || $l->getTipo() === $tipo) &&
                (!$soloDestacados || $l->destacado())
        );

        return array_values($filtrados);
    }

    public function filas(array $libros): array
    {
        return array_map(
            fn(Libro $l) => [
                "titulo" => $l->titulo(),
                "autor" => $l->autor(),
                "paginas" => $l->paginas(),
                "genero" => $l->genero(),
                "tipo" => $l->getTipo(),
                "unidades" => $l->unidades(),
                "fechaAlta" => $l->fechaAlta()?->format('Y-m-d') ?? "Sin fecha",
                "destacado" => $l->destacado(),
                "observaciones" => $l->observaciones(),
                "costeCentimos" => $l->costeReposicionCentimos()
            ],
            $libros
        );
    }

    public function resumen(array $libros): array
    {
        return array_reduce(
            $libros,
            fn(array $carry, Libro $l) => [
                "titulos" => ++$carry["titulos"],
                "unidades" => $carry["unidades"] + $l->unidades(),
                "paginas" => $carry["paginas"] + $l->paginas(),
                "costeCentimos" => $carry["costeCentimos"] + $l->costeReposicionCentimos()
            ],
            ["titulos" => 0, "unidades" => 0, "paginas" => 0, "costeCentimos" => 0]
        );
    }
}
