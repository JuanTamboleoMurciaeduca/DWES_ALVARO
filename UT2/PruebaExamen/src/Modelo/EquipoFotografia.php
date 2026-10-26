<?php

declare(strict_types=1);

namespace Alquiler\Equipo\Modelo;

use InvalidArgumentException;

final class EquipoFotografia extends Equipo
{
    public function __construct(
        int $id,
        string $nombre,
        int $unidades,
        int $reservadas,
        EstadoEquipo $estado,
        int $tarifaBaseCentimos,
        private readonly int $seguroCentimos,
    ) {
        // TODO M0: valida el seguro e inicializa la parte heredada.
        if($seguroCentimos < 0){
            throw new InvalidArgumentException("El seguro no puede ser mnor de 0");
        }
        parent::__construct($id, $nombre,$unidades, $reservadas, $estado,$tarifaBaseCentimos);
    }

    public function tipo(): string
    {
        return 'fotografia';
    }

    public function tarifaDia(): int
    {
        // TODO M1: calcula la tarifa diaria de fotografía.
        return $this->tarifaBaseCentimos + $this->seguroCentimos;
    }
}
