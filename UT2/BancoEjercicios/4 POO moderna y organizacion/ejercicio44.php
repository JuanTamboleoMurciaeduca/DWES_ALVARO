<?php
    class Autor {
        public function __construct(
            public readonly string $nombre,
            public readonly string $codigo,
        ) {}
    }

    class Categoria {
        private string $nombre;

        public function __construct(string $nombre) {
            $this->renombrar($nombre);
        }

        public function nombre(): string {
            return $this->nombre;
        }

        public function renombrar(string $nombre): void {
            $nombreLimpio = trim($nombre);
            if ($nombreLimpio === '') {
                throw new InvalidArgumentException("El nombre de la categoria no puede estar vacio");
            }
            $this->nombre = $nombreLimpio;
        }
    }

    class Libro {
        private string $titulo;

        public function __construct(
            string $titulo,
            public readonly Autor $autor,
            public readonly Categoria $categoria,
        ) {
            $this->titulo = $titulo;
        }

        public function ficha(): string {
            return "{$this->titulo} | Autor: {$this->autor->nombre} ({$this->autor->codigo}) | Categoria: {$this->categoria->nombre()}";
        }
    }

    $autor = new Autor('Frank Herbert', 'AUT-01');
    $categoria = new Categoria('Ciencia ficción');

    $dune = new Libro('Dune', $autor, $categoria);
    $mesias = new Libro('El mesías de Dune', $autor, $categoria);

    echo $dune->ficha() . "<br>";
    echo $mesias->ficha() . "<br><br>";

    // Cambiar la categoria compartida a Narrativa
    $categoria->renombrar('Narrativa');

    echo "--- Tras renombrar categoria compartida ---<br>";
    echo $dune->ficha() . "<br>";
    echo $mesias->ficha() . "<br>";
?>
