<?php
namespace App\Model;

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
}
