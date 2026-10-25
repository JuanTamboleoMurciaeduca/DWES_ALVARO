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

    function seleccionarDesdeEntrada(array $libros, mixed $entrada): array {
        if (!is_string($entrada)) {
            echo "Entrada no válida<br>";
            return [];
        }

        $entero = filter_var($entrada, FILTER_VALIDATE_INT);
        if ($entero === false || $entero < 1) {
            echo "Entrada no válida<br>";
            return [];
        }

        // Libros disponibles con paginas <= maximo
        $seleccionados = array_values(array_filter(
            $libros,
            fn(Libro $l): bool => $l->disponible && $l->paginas <= $entero
        ));

        if (empty($seleccionados)) {
            echo "Sin coincidencias<br>";
            return [];
        }

        $titulos = array_map(fn(Libro $l): string => $l->titulo, $seleccionados);
        echo "Titulos seleccionados: " . implode(', ', $titulos) . "<br>";

        $hayMas400 = array_any($seleccionados, fn(Libro $l): bool => $l->paginas > 400);
        $todasPositivas = array_all($seleccionados, fn(Libro $l): bool => $l->paginas > 0);

        echo "Hay alguno con mas de 400 paginas: " . ($hayMas400 ? 'Si' : 'No') . "<br>";
        echo "Todos tienen paginas positivas: " . ($todasPositivas ? 'Si' : 'No') . "<br>";

        return $seleccionados;
    }

    // Pruebas solicitadas: '500', '0', 'abc', ['500'], '100'
    echo "--- Prueba '500' ---<br>";
    seleccionarDesdeEntrada($libros, '500');

    echo "<br>--- Prueba '0' ---<br>";
    seleccionarDesdeEntrada($libros, '0');

    echo "<br>--- Prueba 'abc' ---<br>";
    seleccionarDesdeEntrada($libros, 'abc');

    echo "<br>--- Prueba ['500'] ---<br>";
    seleccionarDesdeEntrada($libros, ['500']);

    echo "<br>--- Prueba '100' ---<br>";
    seleccionarDesdeEntrada($libros, '100');

    // Explicacion:
    // Convertir directamente con (int) no sustituye a validar porque castea cadenas no numericas como 'abc' a 0 sin avisar,
    // o tipos invalidos como arrays a 1 o lanza errores, perdiendo la capacidad de detectar datos corruptos o invalidos.
?>
