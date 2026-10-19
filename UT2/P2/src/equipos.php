<?php

declare(strict_types=1);

function limpiarEspacios(string $texto): string
{
    // TODO 1: limpiar extremos y agrupar espacios consecutivos.
    return trim(preg_replace("/\s+/", " " ,$texto));
}

function normalizarBusqueda(string $texto): string
{
    // REVISAR: ¿funciona con CÁMARA y ÓRBITA?
    return mb_strtolower(limpiarEspacios($texto), "UTF-8");
}

function obtenerCategorias(array $equipos): array
{
    // TODO 2: extraer categorías sin duplicados en orden de aparición.
    $categorias = array_column(
        $equipos,
        "categoria",
    );
    
    $categorias = array_unique($categorias);

    $categorias = array_values($categorias);

    return $categorias;
}

function categoriaValida(string $categoria, array $categorias): bool
{
    return $categoria === '' || array_search($categoria, $categorias, true) !== false;
}

function unidadesPrestadas(array $prestamos, int $equipoId): int
{
    // TODO 5: sumar unidades de préstamos activos de este equipo.
    $filtroId = array_filter(
        $prestamos,
        fn(array $a): bool =>
        $a["equipoId"] === $equipoId && $a["estado"] === "activo",
    );


    return array_reduce(
        $filtroId,
        fn(int $contador, array $a): int => $contador + $a["unidades"],
        0
    );
}

// Función facilitada: añade los cálculos a una copia de cada equipo.
function prepararEquipos(array $equipos, array $prestamos): array
{
    return array_map(
        function (array $equipo) use ($prestamos): array {
            $equipo['prestadas'] = unidadesPrestadas($prestamos, $equipo['id']);
            $equipo['disponibles'] = $equipo['unidades'] - $equipo['prestadas'];

            return $equipo;
        },
        $equipos
    );
}

function filtrarEquipos(
    array $equipos,
    string $texto,
    string $categoria,
    bool $soloDisponibles
): array
{
    // TODO 3: filtrar por nombre, categoría y unidades disponibles.
    return array_filter($equipos,
    fn(array $a):bool => 
    (empty($texto) || str_contains(normalizarBusqueda($a["nombre"]), normalizarBusqueda($texto))) &&
    (empty($categoria) || str_contains(normalizarBusqueda($a["categoria"]), normalizarBusqueda($categoria))) &&
    (!$soloDisponibles || $a["disponibles"]>0),
    );
}

function ordenarEquipos(array $equipos, string $orden): array
{
    $copia = $equipos;

    usort(
        $copia,
        function (array $a, array $b) use ($orden): int {
            if ($orden === "disponibles") {
                $resultado = $a["disponibles"] <=> $b["disponibles"];
                if ($resultado !== 0) {
                    return $resultado;
                }
            } elseif ($orden === "nombre") {
                $resultado = normalizarBusqueda($a["nombre"]) <=> normalizarBusqueda($b["nombre"]);
                if ($resultado !== 0) {
                    return $resultado;
                }
            }

            return $a["id"] <=> $b["id"];
        }
    );

    return $copia;
}

function resumirEquipos(array $equipos): array
{
    return [
        'cantidad' => count($equipos),
        'unidades' => array_reduce(
            $equipos,
            fn(int $c, array $a): int => $c+$a["unidades"],
            0,
        ), // REVISAR: cuenta equipos, no unidades
        'prestadas' => array_reduce(
            $equipos,
            fn(int $s, array $a): int => $s + $a['prestadas'],
            0
        ),
        'disponibles' => array_reduce(
            $equipos,
            fn(int $s, array $a): int => $s + $a['disponibles'],
            0
        ), // TODO 6: sumar unidades disponibles
        'hayAgotados' => array_any(
            $equipos,
            fn(array $a):bool => $a["disponibles"] === 0,
        ), // TODO 7: comprobar si algún equipo está agotado
        'todosDisponibles' => array_all(
            $equipos,
            fn(array $a):bool => $a["disponibles"] >0,
        ), // TODO 8: comprobar si todos tienen disponibilidad
    ];
}

// Función facilitada: permite pasar una función como dato.
function transformarNombres(array $nombres, callable $callback): array
{
    return array_map($callback, $nombres);
}

function generarEtiquetas(array $equipos, string $prefijo = 'Equipo: '): array
{
    // TODO 9: extraer nombres y usar una closure que capture el prefijo.
    $nombres = array_column($equipos, "nombre");
    return transformarNombres($nombres, function(string $nombre) use ($prefijo):string{
            return $prefijo . limpiarEspacios($nombre);
        });


}

// Función facilitada. La entrada web valida el id antes de llamar.
function normalizarId(int|string $id): int
{
    return (int) $id;
}

function buscarPorId(array $equipos, int|string $id): ?array
{
    // TODO 10: buscar por id en todos los equipos; id no es índice.º
    return array_find(
        $equipos,
        fn(array $a):bool => $a["id"] === normalizarId($id),
    );
}

function responsableVisible(?string $responsable): string
{
    // TODO 11: resolver el caso de responsable null
    if($responsable === null){
        return "Responsable pendiente";
    }
    return $responsable;
}

function inicioNombre(string $nombre): string
{
    return mb_substr(limpiarEspacios($nombre), 0, 3, "UTF-8");
}

function codigoValido(string $codigo): bool
{
    return preg_match('/^AV-[0-9]{4}-[0-9]{4}$/', $codigo) === 1;
}
