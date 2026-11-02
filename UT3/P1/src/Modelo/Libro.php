<?php

declare(strict_types=1);

namespace Juan\Biblioteca\Modelo;

use DateTimeImmutable;
use InvalidArgumentException;

abstract class Libro
{
    public function __construct(
        private string $titulo,
        private string $autor,
        private int $paginas,
        private string $genero,
        private int $unidades,
        private ?DateTimeImmutable $fechaAlta,
        private bool $destacado,
        private string $observaciones
    ) {
        $this->titulo = self::normalizar($this->titulo);
        $this->autor = self::normalizar($this->autor);
        $this->genero = mb_strtolower(self::normalizar($this->genero), 'UTF-8');
        $this->observaciones = self::normalizar($this->observaciones);

        if ($this->titulo === '' || $this->autor === '' || $this->genero === '')
            throw new InvalidArgumentException('Argumentos vacios');

        if (mb_strlen($this->titulo, 'UTF-8') > 120 || mb_strlen($this->autor, 'UTF-8') > 100)
            throw new InvalidArgumentException('Tamaños incorrectos');

        if ($this->paginas < 1 || $this->paginas > 3000)
            throw new InvalidArgumentException('Tamaño incorrecto de páginas');

        if (!in_array($this->genero, ['ciencia', 'fantasia', 'terror'], true))
            throw new InvalidArgumentException('Genero incorrecto');

        if ($this->unidades < 1 || $this->unidades > 50)
            throw new InvalidArgumentException('Unidades incorrectas');

        if (mb_strlen($this->observaciones, 'UTF-8') > 300)
            throw new InvalidArgumentException('Observaciones son 300 caracteres');
    }

    private static function normalizar(string $texto): string
    {
        return trim($texto);
    }

    public function titulo(): string {return $this->titulo;}
    public function autor(): string {return $this->autor;}
    public function paginas(): int {return $this->paginas;}
    public function genero(): string {return $this->genero;}
    public function unidades(): int {return $this->unidades;}
    public function fechaAlta(): ?DateTimeImmutable {return $this->fechaAlta;}
    public function destacado(): bool {return $this->destacado;}
    public function observaciones(): string {return $this->observaciones;}

    public abstract function getTipo(): string;
    public abstract function costeReposicionCentimos(): int;
}
