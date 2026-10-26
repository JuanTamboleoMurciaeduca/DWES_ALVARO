<?php
namespace App\Model;

class Libro {
    public function __construct(
        private string $titulo,
        private Autor $autor
    ) {}

    public function ficha(): string {
        return "{$this->titulo} | {$this->autor->nombre()}";
    }
}
