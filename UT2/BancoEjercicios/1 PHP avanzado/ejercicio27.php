<?php
    $libros = [
        ['id' => 1, 'titulo' => 'Dune', 'paginas' => 412],
        ['id' => 2, 'titulo' => 'It', 'paginas' => 1504],
    ];

    $busqueda = mb_strtolower(trim('  IT  '), 'UTF-8');

    $visibles = array_filter(
        $libros,
        fn (array $l): bool => str_contains(
            mb_strtolower($l['titulo'], 'UTF-8'),
            $busqueda
        )
    );

    usort($libros, fn (array $a, array $b): int => $a['paginas'] <=> $b['paginas']);

    $titulos = array_column($libros, 'titulo');

    $etiquetas = array_map(fn (string $t): string => "Libro: $t", $titulos);

    // Obtener libro con id 2 mediante array_find
    $libroEncontrado = array_find($libros, fn(array $l): bool => $l['id'] === 2);

    print_r($etiquetas);
    echo "<br>";
    print_r($libroEncontrado);

    // Salida que se produciria:
    // $etiquetas contiene: ['Libro: Dune', 'Libro: It'] porque usort los ordeno de menor a mayor paginas (412 < 1504).
    // array_find devuelve el registro completo del libro con id 2: ['id' => 2, 'titulo' => 'It', 'paginas' => 1504].
?>
