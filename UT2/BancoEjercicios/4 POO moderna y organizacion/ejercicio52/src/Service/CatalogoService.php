<?php
namespace App\Service;

use App\Model\Libro;

class CatalogoService {
    /**
     * @param Libro[] $libros
     */
    public function __construct(private array $libros) {}

    public function fichas(): array {
        return array_map(fn(Libro $libro): string => $libro->ficha(), $this->libros);
    }
}
