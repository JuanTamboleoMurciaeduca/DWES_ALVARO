<?php
    class LibroNoDisponibleException extends RuntimeException {}

    class Libro {
        private string $titulo;
        private bool $disponible;

        public function __construct(string $titulo) {
            $tituloLimpio = trim($titulo);
            if ($tituloLimpio === '') {
                throw new InvalidArgumentException("El título no puede estar vacío");
            }
            $this->titulo = $tituloLimpio;
            $this->disponible = true;
        }

        public function titulo(): string {
            return $this->titulo;
        }

        public function estaDisponible(): bool {
            return $this->disponible;
        }

        public function prestar(): void {
            if (!$this->disponible) {
                throw new LibroNoDisponibleException("El libro '{$this->titulo}' no está disponible");
            }
            $this->disponible = false;
        }

        public function devolver(): void {
            $this->disponible = true;
        }
    }

    $dune = new Libro('Dune');

    // Primer prestamo
    $dune->prestar();
    echo "Primer préstamo realizado.<br>";

    // Segundo prestamo en otro bloque try
    try {
        $dune->prestar();
    } catch (LibroNoDisponibleException $e) {
        echo "Excepción capturada: " . $e->getMessage() . "<br>";
    }

    echo "Disponibilidad tras el rechazo: " . ($dune->estaDisponible() ? 'true' : 'false') . "<br>";

    // Devolver y volver a prestar
    $dune->devolver();
    $dune->prestar();
    echo "Dune devuelto y vuelto a prestar correctamente.<br>";

    // En otro try intentar construir un libro formado por espacios
    try {
        $libroInvalido = new Libro('   ');
    } catch (InvalidArgumentException $e) {
        echo "Excepción capturada al construir con espacios: " . $e->getMessage() . "<br>";
    }
?>
