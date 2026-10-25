<?php
namespace App\Model;

class Categoria {
    public function __construct(private string $nombre) {}

    public function nombre(): string {
        return $this->nombre;
    }
}
