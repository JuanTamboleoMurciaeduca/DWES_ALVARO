<?php

declare(strict_types=1);

namespace Juan\Biblioteca\Modelo;

class LibroDigital extends Libro {
    public function getTipo(): string
    {
        return 'digital';
    }

    public function costeReposicionCentimos(): int
    {
        return $this->unidades() * 400;
    }
}