<?php
    class Libro {
        public function __construct(
            public int $id,
            public string $titulo,
            public int $paginas,
            public bool $disponible = true,
        ) {}

        public function prestar(): void {
            $this->disponible = false;
        }

        public function devolver(): void {
            $this->disponible = true;
        }
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

    // Coleccion de disponibles antes del prestamo
    $disponiblesAntes = array_filter($libros, fn(Libro $l): bool => $l->disponible);

    // Localizar libro con id 10 en la coleccion completa
    $encontrado = array_find($libros, fn(Libro $l): bool => $l->id === 10);

    if ($encontrado !== null) {
        $encontrado->prestar();
    }

    echo "Disponible en \$encontrado: " . ($encontrado->disponible ? 'true' : 'false') . "<br>";
    echo "Disponible en \$libros[0] (Dune): " . ($libros[0]->disponible ? 'true' : 'false') . "<br>";
    echo "Disponible en \$disponiblesAntes (Dune): " . ($disponiblesAntes[0]->disponible ? 'true' : 'false') . "<br>";

    // Volver a filtrar para lista actualizada
    $disponiblesActualizada = array_filter($libros, fn(Libro $l): bool => $l->disponible);
    echo "Total disponibles ahora: " . count($disponiblesActualizada) . "<br>";

    // Explicacion:
    // Los arrays en PHP guardan referencias (punteros de objeto) a las mismas instancias de Libro en memoria.
    // Al mutar el objeto Dune con prestar(), el cambio se refleja en todos los arrays que lo contienen.
    // La lista filtrada antes del cambio todavia incluye a Dune porque el array ya habia sido creado y no se reevalua solo,
    // aunque la propiedad disponible del objeto que contiene haya pasado a false.

    // Busqueda con id 99
    $libroInexistente = array_find($libros, fn(Libro $l): bool => $l->id === 99);
    $tituloInexistente = $libroInexistente?->titulo ?? 'Libro no encontrado';
    echo "Busqueda id 99: " . $tituloInexistente . "<br>";
?>
