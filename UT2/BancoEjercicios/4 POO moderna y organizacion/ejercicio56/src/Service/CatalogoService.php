<?php
namespace App\Service;

use App\Contract\LibroRepository;
use App\Model\Libro;

class CatalogoService {
    public function __construct(private LibroRepository $repositorio) {}

    /**
     * @return Libro[]
     */
    public function disponibles(): array {
        return array_values(array_filter(
            $this->repositorio->todos(),
            fn(Libro $l): bool => $l->estaDisponible()
        ));
    }

    /**
     * @return string[]
     */
    public function titulosDisponibles(): array {
        return array_map(
            fn(Libro $l): string => $l->titulo(),
            $this->disponibles()
        );
    }
}
