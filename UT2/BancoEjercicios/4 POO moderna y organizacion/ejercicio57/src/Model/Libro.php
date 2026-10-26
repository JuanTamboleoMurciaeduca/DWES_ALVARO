<?php
namespace App\Model;

use App\Exception\LibroNoDisponibleException;

class Libro {
    public function __construct(
        private int $id,
        private string $titulo,
        private bool $disponible
    ) {}

    public function id(): int {
        return $this->id;
    }

    public function titulo(): string {
        return $this->titulo;
    }

    public function estaDisponible(): bool {
        return $this->disponible;
    }

    public function prestar(): void {
        if (!$this->disponible) {
            throw new LibroNoDisponibleException("El libro '{$this->titulo}' no está disponible");
        }
        $this->disponible = false;
    }

    public function devolver(): void {
        $this->disponible = true;
    }
}
