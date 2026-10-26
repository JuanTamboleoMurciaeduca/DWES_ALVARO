<?php
namespace App\Model;

class Libro {
    public function __construct(private string $titulo) {}

    public function titulo(): string {
        return $this->titulo;
    }
}
