<?php
    // Intento de sustituir la propiedad readonly categoria de un Libro -> Produce Error

    class Autor {
        public function __construct(
            public readonly string $nombre,
            public readonly string $codigo,
        ) {}
    }

    class Categoria {
        public function __construct(private string $nombre) {}
        public function nombre(): string { return $this->nombre; }
    }

    class Libro {
        public function __construct(
            private string $titulo,
            public readonly Autor $autor,
            public readonly Categoria $categoria,
        ) {}
    }

    $autor = new Autor('Frank Herbert', 'AUT-01');
    $cat1 = new Categoria('Ciencia ficción');
    $cat2 = new Categoria('Fantasia');

    $libro = new Libro('Dune', $autor, $cat1);

    // Intentar sustituir la categoria produce Error: Cannot modify readonly property Libro::$categoria
    $libro->categoria = $cat2;
?>
