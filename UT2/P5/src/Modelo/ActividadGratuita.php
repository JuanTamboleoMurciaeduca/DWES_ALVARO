<?php
declare(strict_types=1);

// TODO M7. Implementa la especialización final gratuita.
final class ActividadGratuita extends Actividad{
    #[Override]
    public function __construct(int $id, string $nombre, int $capacidad, int $ocupadas, EstadoActividad $estado, ?Responsable $responsable){
        parent::__construct($id, $nombre, $capacidad, $ocupadas, $estado, $responsable);
    }

    #[Override]
    public function tipo(): string{
        return "gratuita";
    }

    #[Override]
    public function importe(int $cantidad): int{
        if($cantidad < 0){
            throw new InvalidArgumentException("No puede ser menor que 0");
        }

        return $cantidad;
    }
}