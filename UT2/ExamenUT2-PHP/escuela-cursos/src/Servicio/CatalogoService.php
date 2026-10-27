<?php

declare(strict_types=1);

namespace Escuela\Curso\Servicio;

use Escuela\Curso\Contrato\CursoRepository;
use Escuela\Curso\Excepcion\CursoException;
use Escuela\Curso\Modelo\{Curso, EstadoCurso};
use InvalidArgumentException;

final class CatalogoService
{
    public function __construct(private CursoRepository $repository)
    {
    }

    public function filtrar(
        string $texto = '',
        ?EstadoCurso $estado = null,
        bool $soloConPlazas = false
    ): array
    {
        $texto = mb_strtolower(trim($texto), 'UTF-8');

        // TODO F1: filtra los cursos mediante array_filter.
        $aux = $this->repository->todos();
        $aux2 = array_filter(
            $aux,
            function(Curso $c) use ($texto, $estado, $soloConPlazas):bool{
                if(!str_contains($texto, $c->nombreNormalizado()) && $texto !== ""){
                    return false;
                }

                if($c->estado() !== null && $c->estado() !== $estado){
                    return false;
                }

                if($soloConPlazas === true){
                    if($estado !== EstadoCurso::Abierto && $c->plazasLibres() > 0){
                        return true;
                    }
                }

                return true;

            }
        );
        return array_values($aux2);
    }

    public function ordenar(array $cursos): array
    {
        // TODO F2: ordena una copia mediante usort y un callback.
        $copia = $cursos;
        usort($copia,
        fn(Curso $a, Curso $b): int =>
            ($b->precioPlaza() <=> $a->precioPlaza()) ?:
            ($a->id() <=> $b->id()),
        );

        return $copia;
    }

    public function etiquetas(array $cursos, string $prefijo = 'Curso: '): array
    {
        // TODO F3: array_map y arrow function.
        
        return array_map(
            fn(Curso $c):string =>
                $c->etiqueta($prefijo)
            ,$cursos
        );
    }

    public function resumen(array $cursos): array
    {
        // TODO F4: calcula las tres cifras mediante array_reduce.
        return array_reduce($cursos,
            fn(array $carry, Curso $c) =>[
                "cantidad" => $carry["cantidad"]++,
                "libres"=> $carry["libres"] + $c->plazasLibres(),
                "importeCentimos"=> $carry["importeCentimos"]+ $c->ocupadas() * $c->precioPlaza(),
            ],
            ["cantidad" => 0, "libres" => 0, "importeCentimos" =>0]
        );
    }

    public function buscarOpciones(int $plazas, int $presupuestoCentimos): array
    {
        // TODO D1: repara las etapas de esta búsqueda sin utilizar bucles.
        if ($plazas <= 0 || $presupuestoCentimos <= 0) {
            throw new \InvalidArgumentException('Plazas o presupuesto no válidos');
        }

        $candidatos = array_filter(
            $this->repository->todos(),
            fn (Curso $curso): bool =>
                $curso->estado() === EstadoCurso::Abierto
                && $curso->plazasLibres() >= $plazas
        );

        $propuestas = array_map(
            fn (Curso $curso): array => [
                'id' => $curso->id(),
                'importeCentimos' => $curso->precioPlaza() * $plazas,
                'libresDespues' => $curso->plazasLibres() - $plazas
            ],
            $candidatos
        );
        
        // echo "<br> <br> <br>";
        // print_r($propuestas);
        // echo "<br> <br> <br>";

        $resultado = array_reduce(
            $propuestas,
            function (array $acumulado, array $propuesta) use ($presupuestoCentimos): array {
                if ($propuesta['importeCentimos'] <= $presupuestoCentimos) {
                    $acumulado[] = $propuesta;
                }

                return $acumulado;
            },
            []
        );

        usort(
            $propuestas,
            fn (array $a, array $b): int =>
                (($a['importeCentimos'] <=> $b['importeCentimos']) !== 0)
                    ? ($a['importeCentimos'] <=> $b['importeCentimos'])
                    : ($a['id'] <=> $b['id'])
        );

        return $resultado;
    }

    private function requerido(int $id): Curso
    {
        return $this->repository->buscarPorId($id)
            ?? throw new CursoException('El curso no existe');
    }

    public function reservar(int $id, int $cantidad): void
    {
        $this->requerido($id)->reservar($cantidad);
    }

    public function cancelar(int $id, int $cantidad): void
    {
        $this->requerido($id)->cancelar($cantidad);
    }

    public function planificarReserva(
        int $plazas,
        int $presupuestoCentimos
    ): array{
        if($plazas <=0 && $presupuestoCentimos <0){
            throw new InvalidArgumentException("Las plazas no pueden ser 0 ni el presupuesto menor");
        }

        return [];
    }

}
