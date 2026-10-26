<?php
    class Libro {
        public function __construct(
            private int $id,
            private string $titulo,
        ) {}

        public function id(): int {
            return $this->id;
        }

        public function titulo(): string {
            return $this->titulo;
        }
    }

    interface LibroRepository {
        public function todos(): array;
    }

    class ArrayLibroRepository implements LibroRepository {
        /**
         * @param Libro[] $libros
         */
        public function __construct(private array $libros) {}

        public function todos(): array {
            return $this->libros;
        }
    }

    class CatalogoDemostracionRepository implements LibroRepository {
        public function todos(): array {
            return [
                new Libro(10, 'Dune'),
                new Libro(20, 'Solaris'),
            ];
        }
    }

    function mostrarCatalogo(LibroRepository $repositorio): void {
        $libros = $repositorio->todos();
        $total = count($libros);

        if ($total === 0) {
            echo "Catálogo vacío (0 libros)<br>";
            return;
        }

        echo "Total de libros: $total<br>";
        foreach ($libros as $libro) {
            echo "- ID: {$libro->id()}, Titulo: {$libro->titulo()}<br>";
        }
    }

    echo "--- 1. Catalogo Demostracion ---<br>";
    $repoDemo = new CatalogoDemostracionRepository();
    mostrarCatalogo($repoDemo);

    echo "<br>--- 2. ArrayLibroRepository con 2 libros ---<br>";
    $repoArray = new ArrayLibroRepository([
        new Libro(30, 'Drácula'),
        new Libro(40, 'El Hobbit'),
    ]);
    mostrarCatalogo($repoArray);

    echo "<br>--- 3. ArrayLibroRepository vacio ---<br>";
    $repoVacio = new ArrayLibroRepository([]);
    mostrarCatalogo($repoVacio);
?>
