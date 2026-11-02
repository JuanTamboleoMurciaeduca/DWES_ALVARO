<?php

declare(strict_types=1);

namespace Juan\Biblioteca\Modelo;


class LibroPapel extends Libro {
    
    public function getTipo(): string
    {
        return 'papel';
    }

    public function costeReposicionCentimos(): int
    {
        return $this->unidades() * $this->paginas() * 5;
    }
}