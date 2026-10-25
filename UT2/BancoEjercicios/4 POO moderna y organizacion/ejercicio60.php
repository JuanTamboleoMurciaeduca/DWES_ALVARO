<?php
    $datos = [
        ['titulo' => 'Dune', 'paginas' => 412, 'disponible' => true],
        ['titulo' => 'Solaris', 'paginas' => 216, 'disponible' => false],
        ['titulo' => 'Drácula', 'paginas' => 418, 'disponible' => true],
        ['titulo' => 'El Hobbit', 'paginas' => 310, 'disponible' => true],
    ];

    // Version funcion procedural
    function titulosDisponiblesHasta(array $datos, int $maximo): array {
        if ($maximo < 1) {
            throw new InvalidArgumentException("El maximo debe ser al menos 1");
        }

        $filtrados = array_filter(
            $datos,
            fn(array $d): bool => $d['disponible'] && $d['paginas'] <= $maximo
        );

        return array_values(array_map(fn(array $d): string => $d['titulo'], $filtrados));
    }

    // Version orientada a objetos
    class Libro {
        public function __construct(
            private string $titulo,
            private int $paginas,
            private bool $disponible
        ) {}

        public function titulo(): string {
            return $this->titulo;
        }

        public function paginas(): int {
            return $this->paginas;
        }

        public function estaDisponible(): bool {
            return $this->disponible;
        }
    }

    class CatalogoService {
        /**
         * @param Libro[] $libros
         */
        public function __construct(private array $libros) {}

        public function titulosDisponiblesHasta(int $maximo): array {
            if ($maximo < 1) {
                throw new InvalidArgumentException("El maximo debe ser al menos 1");
            }

            $filtrados = array_filter(
                $this->libros,
                fn(Libro $l): bool => $l->estaDisponible() && $l->paginas() <= $maximo
            );

            return array_values(array_map(fn(Libro $l): string => $l->titulo(), $filtrados));
        }
    }

    $libros = array_map(
        fn(array $d): Libro => new Libro($d['titulo'], $d['paginas'], $d['disponible']),
        $datos
    );

    $servicio = new CatalogoService($libros);

    // Pruebas con funcion y con servicio: 400, 500, 100
    $pruebas = [400, 500, 100];

    echo "=== 1. Version funcion ===<br>";
    foreach ($pruebas as $max) {
        $res = titulosDisponiblesHasta($datos, $max);
        echo "Maximo $max: " . (empty($res) ? '[]' : implode(', ', $res)) . "<br>";
    }

    // Prueba con 0 en funcion
    try {
        titulosDisponiblesHasta($datos, 0);
    } catch (InvalidArgumentException $e) {
        echo "Maximo 0 (Excepcion): " . $e->getMessage() . "<br>";
    }

    echo "<br>=== 2. Version CatalogoService ===<br>";
    foreach ($pruebas as $max) {
        $res = $servicio->titulosDisponiblesHasta($max);
        echo "Maximo $max: " . (empty($res) ? '[]' : implode(', ', $res)) . "<br>";
    }

    // Prueba con 0 en servicio
    try {
        $servicio->titulosDisponiblesHasta(0);
    } catch (InvalidArgumentException $e) {
        echo "Maximo 0 (Excepcion): " . $e->getMessage() . "<br>";
    }
?>
