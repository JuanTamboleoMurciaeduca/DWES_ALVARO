<?php
    abstract class RecursoBiblioteca {
        private int $id;
        protected string $titulo;

        public function __construct(int $id, string $titulo) {
            $tituloLimpio = trim($titulo);
            if ($id <= 0 || $tituloLimpio === '') {
                throw new InvalidArgumentException("ID o titulo no validos");
            }
            $this->id = $id;
            $this->titulo = $tituloLimpio;
        }

        public function id(): int {
            return $this->id;
        }

        public function titulo(): string {
            return $this->titulo;
        }

        abstract public function tipo(): string;

        final public function origen(): string {
            return "Biblioteca";
        }
    }

    class Libro extends RecursoBiblioteca {
        private int $paginas;

        public function __construct(int $id, string $titulo, int $paginas) {
            parent::__construct($id, $titulo);
            if ($paginas <= 0) {
                throw new InvalidArgumentException("Las paginas deben ser positivas");
            }
            $this->paginas = $paginas;
        }

        public function tipo(): string {
            return "libro";
        }

        public function ficha(): string {
            return "Libro: {$this->titulo} ({$this->paginas} paginas)";
        }
    }

    class Revista extends RecursoBiblioteca {
        private int $numero;

        public function __construct(int $id, string $titulo, int $numero) {
            parent::__construct($id, $titulo);
            if ($numero <= 0) {
                throw new InvalidArgumentException("El numero debe ser positivo");
            }
            $this->numero = $numero;
        }

        public function tipo(): string {
            return "revista";
        }

        public function ficha(): string {
            return "Revista: {$this->titulo} (Numero {$this->numero})";
        }
    }

    $dune = new Libro(10, 'Dune', 412);
    $revista = new Revista(20, 'Ciencia', 7);

    /** @var RecursoBiblioteca[] $recursos */
    $recursos = [$dune, $revista];

    foreach ($recursos as $r) {
        echo "ID: {$r->id()} | Titulo: {$r->titulo()} | Tipo: {$r->tipo()} | Origen: {$r->origen()}<br>";
        echo "Ficha: {$r->ficha()}<br><br>";
    }
?>
