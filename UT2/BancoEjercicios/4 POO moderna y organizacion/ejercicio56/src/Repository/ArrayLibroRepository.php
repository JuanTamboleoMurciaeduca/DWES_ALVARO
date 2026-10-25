<?php
namespace App\Repository;

use App\Contract\LibroRepository;
use App\Model\Libro;

class ArrayLibroRepository implements LibroRepository {
    /**
     * @param Libro[] $libros
     */
    public function __construct(private array $libros) {}

    public function todos(): array {
        return $this->libros;
    }
}
