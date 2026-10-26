<?php
namespace App\Model;

use App\Exception\LibroNoDisponibleException;
use InvalidArgumentException;

class Libro {
    private int $id;
    private string $titulo;
    private int $paginas;
    private bool $disponible;

    public function __construct(int $id, string $titulo, int $paginas, bool $disponible = true) {
        $tituloLimpio = trim($titulo);
        if ($id <= 0 || $tituloLimpio === '' || $paginas <= 0) {
            throw new InvalidArgumentException("Argumentos de libro invalidos (id, titulo o paginas)");
        }

        $this->id = $id;
        $this->titulo = $tituloLimpio;
        $this->paginas = $paginas;
        $this->disponible = $disponible;
    }

    public function id(): int {
        return $this->id;
    }

    public function titulo(): string {
        return $this->titulo;
    }

    public function paginas(): int {
        return $this->paginas;
    }

    public function estaDisponible(): bool {
        return $this->disponible;
    }

    public function prestar(): void {
        if (!$this->disponible) {
            throw new LibroNoDisponibleException("El libro '{$this->titulo}' no está disponible para préstamo");
        }
        $this->disponible = false;
    }

    public function devolver(): void {
        $this->disponible = true;
    }
}
