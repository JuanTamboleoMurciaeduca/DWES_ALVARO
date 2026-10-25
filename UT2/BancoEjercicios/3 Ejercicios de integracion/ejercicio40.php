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

    // Ordenar de menor a mayor paginas
    usort($libros, fn(Libro $a, Libro $b): int => $a->paginas <=> $b->paginas);

    // Total de paginas con array_reduce
    $totalPaginas = array_reduce(
        $libros,
        fn(int $acumulador, Libro $libro): int => $acumulador + $libro->paginas,
        0
    );

    echo "--- Orden ascendente por paginas ---<br>";
    foreach ($libros as $libro) {
        echo $libro->titulo . " (" . $libro->paginas . " paginas)<br>";
    }
    echo "Total de paginas: " . $totalPaginas . "<br><br>";

    // Orden descendente
    usort($libros, fn(Libro $a, Libro $b): int => $b->paginas <=> $a->paginas);

    echo "--- Orden descendente por paginas ---<br>";
    foreach ($libros as $libro) {
        echo $libro->titulo . " (" . $libro->paginas . " paginas, ID: " . $libro->id . ")<br>";
    }

    // Explicacion:
    // usort siempre renumera los indices/claves del array asignando nuevas posiciones indexadas (0, 1, 2, ...),
    // pero la propiedad interna $id del objeto no cambia porque pertenece al estado propio de la instancia de Libro.
?>
