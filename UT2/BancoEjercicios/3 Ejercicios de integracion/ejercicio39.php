<?php
    class Libro {
        public function __construct(
            public int $id,
            public string $titulo,
            public int $paginas,
            public bool $disponible = true,
        ) {}
    }

    $datos = [
        ['id' => 10, 'titulo' => 'Dune', 'paginas' => 412, 'disponible' => true],
        ['id' => 20, 'titulo' => 'Drácula', 'paginas' => 418, 'disponible' => false],
        ['id' => 30, 'titulo' => '1984', 'paginas' => 328, 'disponible' => true],
        ['id' => 40, 'titulo' => 'It', 'paginas' => 1504, 'disponible' => true],
    ];

    $libros = array_map(
        fn(array $d): Libro => new Libro($d['id'], $d['titulo'], $d['paginas'], $d['disponible']),
        $datos
    );

    // Normalizar busqueda
    $busqueda = mb_strtolower(trim(' DRÁ '), 'UTF-8');

    // Filtrar libros con array_filter y arrow function
    $filtrados = array_filter(
        $libros,
        fn(Libro $libro): bool => str_contains(
            mb_strtolower($libro->titulo, 'UTF-8'),
            $busqueda
        )
    );

    // Transformar en etiquetas con array_map
    $etiquetas = array_map(
        fn(Libro $l): string => $l->titulo . " - " . $l->paginas . " páginas",
        $filtrados
    );

    foreach ($etiquetas as $etiqueta) {
        echo $etiqueta . "<br>";
    }

    // En las arrow functions de PHP, las variables del ambito externo como $busqueda
    // se capturan automaticamente por valor (sin necesidad de escribir use ($busqueda)).

    // Repetir con busqueda que no encuentre nada
    $busquedaVacia = mb_strtolower(trim(' Harry '), 'UTF-8');
    $filtrados2 = array_filter(
        $libros,
        fn(Libro $libro): bool => str_contains(
            mb_strtolower($libro->titulo, 'UTF-8'),
            $busquedaVacia
        )
    );

    if (empty($filtrados2)) {
        echo "Sin resultados";
    } else {
        $etiquetas2 = array_map(fn(Libro $l): string => $l->titulo . " - " . $l->paginas . " páginas", $filtrados2);
        print_r($etiquetas2);
    }
?>
