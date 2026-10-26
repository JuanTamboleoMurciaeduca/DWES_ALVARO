<?php

declare(strict_types=1);

namespace Alquiler\Equipo\Modelo;

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
        throw new \LogicException('Pendiente M0');
    }

    public function tipo(): string
    {
        return 'fotografia';
    }

    public function tarifaDia(): int
    {
        // TODO M1: calcula la tarifa diaria de fotografía.
        throw new \LogicException('Pendiente M1');
    }
}
