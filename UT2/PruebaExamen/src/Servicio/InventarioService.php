<?php

declare(strict_types=1);

namespace Alquiler\Equipo\Servicio;

use Alquiler\Equipo\Contrato\EquipoRepository;
use Alquiler\Equipo\Excepcion\EquipoException;
use Alquiler\Equipo\Modelo\{Equipo, EstadoEquipo};

final class InventarioService
{
    public function __construct(private EquipoRepository $repository)
    {
    }

    public function filtrar(
        string $texto = '',
        ?EstadoEquipo $estado = null,
        int $minDisponibles = 0
    ): array {
        $texto = mb_strtolower(trim($texto), 'UTF-8');

        if ($minDisponibles < 0) {
            throw new \InvalidArgumentException('Mínimo negativo');
        }

        // TODO F1: filtra con array_filter y devuelve claves consecutivas.
        throw new \LogicException('Pendiente F1');
    }

    public function ordenar(array $equipos): array
    {
        // TODO F2: ordena una copia mediante usort y un callback.
        throw new \LogicException('Pendiente F2');
    }

    public function fichas(array $equipos, string $prefijo = 'Equipo: '): array
    {
        // TODO F3: utiliza array_map y una arrow function.
        throw new \LogicException('Pendiente F3');
    }

    public function resumen(array $equipos): array
    {
        // TODO F4: acumula las tres cifras mediante array_reduce.
        throw new \LogicException('Pendiente F4');
    }

    public function presupuestarLotes(
        int $cantidad,
        int $dias,
        int $presupuestoCentimos
    ): array {
        // TODO D1: repara las etapas conservando las funciones de arrays.
        if ($cantidad <= 0 || $dias <= 0 || $presupuestoCentimos < 0) {
            throw new \InvalidArgumentException('Cantidad, días o presupuesto no válidos');
        }

        $candidatos = array_filter(
            $this->repository->todos(),
            fn (Equipo $equipo): bool =>
                $equipo->estado() === EstadoEquipo::Disponible
                && $equipo->disponibles() > $cantidad
        );

        $propuestas = array_map(
            fn (Equipo $equipo): array => [
                'id' => $equipo->id(),
                'importeCentimos' => $equipo->tarifaDia() * $dias,
                'disponiblesDespues' => $equipo->unidades() - $cantidad
            ],
            $candidatos
        );

        $opciones = array_reduce(
            $propuestas,
            function (array $resultado, array $propuesta) use ($presupuestoCentimos): array {
                if ($propuesta['importeCentimos'] >= $presupuestoCentimos) {
                    $resultado = [$propuesta];
                }

                return $resultado;
            },
            []
        );

        usort(
            $opciones,
            fn (array $a, array $b): int =>
                (($b['importeCentimos'] <=> $a['importeCentimos']) !== 0)
                    ? ($b['importeCentimos'] <=> $a['importeCentimos'])
                    : ($b['id'] <=> $a['id'])
        );

        return $opciones;
    }

    private function requerido(int $id): Equipo
    {
        return $this->repository->buscarPorId($id)
            ?? throw new EquipoException('El equipo no existe');
    }

    public function reservar(int $id, int $cantidad): void
    {
        $this->requerido($id)->reservar($cantidad);
    }

    public function devolver(int $id, int $cantidad): void
    {
        $this->requerido($id)->devolver($cantidad);
    }
}
