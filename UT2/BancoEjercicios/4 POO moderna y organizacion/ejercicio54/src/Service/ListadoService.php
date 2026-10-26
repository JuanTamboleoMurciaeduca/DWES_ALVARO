<?php
namespace App\Service;

use App\Model\Recurso;

class ListadoService {
    /**
     * @param Recurso[] $recursos
     * @return string[]
     */
    public function lineas(array $recursos): array {
        return array_map(
            fn(Recurso $r): string => "{$r->tipo()}: {$r->titulo()}",
            $recursos
        );
    }
}
