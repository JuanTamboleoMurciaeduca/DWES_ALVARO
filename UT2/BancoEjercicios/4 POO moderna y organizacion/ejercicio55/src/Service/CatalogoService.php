<?php
namespace App\Service;

use App\Model\Libro;

class CatalogoService {
    public function mostrar(Libro $libro): string {
        return $libro->titulo();
    }
}
