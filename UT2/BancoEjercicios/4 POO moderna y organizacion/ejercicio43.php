<?php
    class Libro {
        private int $id;
        private string $titulo;
        private int $paginas;
        private bool $disponible;

        public function __construct(int $id, string $titulo, int $paginas) {
            $tituloLimpio = trim($titulo);
            if ($id <= 0 || $tituloLimpio === '' || $paginas <= 0) {
                throw new InvalidArgumentException("Datos de libro no validos");
            }

            $this->id = $id;
            $this->titulo = $tituloLimpio;
            $this->paginas = $paginas;
            $this->disponible = true;
        }

        public function id(): int {
            return $this->id;
        }

        public function titulo(): string {
            return $this->titulo;
        }

        public function paginas(): int {
            return $this->paginas;
        }

        public function estaDisponible(): bool {
            return $this->disponible;
        }

        public function prestar(): void {
            if (!$this->disponible) {
                throw new LogicException("El libro ya está prestado");
            }
            $this->disponible = false;
        }

        public function devolver(): void {
            $this->disponible = true;
        }
    }

    $dune = new Libro(10, 'Dune', 412);
    $solaris = new Libro(20, 'Solaris', 216);

    echo "Ficha Dune: ID {$dune->id()}, Titulo: {$dune->titulo()}, Paginas: {$dune->paginas()}, Disponible: " . ($dune->estaDisponible() ? 'Si' : 'No') . "<br>";
    echo "Ficha Solaris: ID {$solaris->id()}, Titulo: {$solaris->titulo()}, Paginas: {$solaris->paginas()}, Disponible: " . ($solaris->estaDisponible() ? 'Si' : 'No') . "<br>";

    // Prestar Dune
    $dune->prestar();
    echo "Tras prestar Dune -> Dune disp: " . ($dune->estaDisponible() ? 'Si' : 'No') . " | Solaris disp: " . ($solaris->estaDisponible() ? 'Si' : 'No') . "<br>";

    // Devolver Dune
    $dune->devolver();
    echo "Tras devolver Dune -> Dune disp: " . ($dune->estaDisponible() ? 'Si' : 'No') . " | Solaris disp: " . ($solaris->estaDisponible() ? 'Si' : 'No') . "<br>";

    // Intentar prestar Dune dos veces seguidas
    $dune->prestar();
    try {
        $dune->prestar();
    } catch (LogicException $e) {
        echo "Excepcion capturada: " . $e->getMessage() . "<br>";
    }
    echo "Estado tras rechazo: Dune sigue " . ($dune->estaDisponible() ? 'disponible' : 'prestado') . "<br>";

    // Intento con 0 paginas
    try {
        $invalido = new Libro(30, 'Error', 0);
    } catch (InvalidArgumentException $e) {
        echo "Rechazo de construccion: " . $e->getMessage() . "<br>";
    }
?>
