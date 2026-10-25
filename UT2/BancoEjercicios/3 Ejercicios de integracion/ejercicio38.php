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

    // Transformar registros a objetos con array_map y argumentos nombrados cambiando el orden
    $libros = array_map(
        fn(array $d): Libro => new Libro(
            titulo: $d['titulo'],
            id: $d['id'],
            paginas: $d['paginas'],
            disponible: $d['disponible'],
        ),
        $datos
    );

    foreach ($libros as $libro) {
        echo "ID: " . $libro->id . " | Titulo: " . $libro->titulo . " | Paginas: " . $libro->paginas . "<br>";
    }

    echo "Total de objetos creados: " . count($libros) . "<br>";

    // Comprobamos que el array original sigue conteniendo registros (arrays) y no objetos
    var_dump(is_array($datos[0])); // true
    var_dump($libros[0] instanceof Libro); // true
?>
