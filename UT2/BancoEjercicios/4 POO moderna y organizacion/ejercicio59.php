<?php
    class OperacionBibliotecaException extends RuntimeException {}
    class LibroNoDisponibleException extends OperacionBibliotecaException {}

    class Libro {
        public function __construct(
            private string $titulo,
            private bool $disponible = true,
        ) {}

        public function titulo(): string {
            return $this->titulo;
        }

        public function estaDisponible(): bool {
            return $this->disponible;
        }

        public function prestar(): void {
            if (!$this->disponible) {
                throw new LibroNoDisponibleException("El libro '{$this->titulo}' no se puede prestar porque ya está prestado");
            }
            $this->disponible = false;
        }
    }

    $libros = [
        10 => new Libro('Dune', true),
        20 => new Libro('Solaris', false),
    ];

    function prestarPorId(array $libros, int $id): void {
        if ($id <= 0) {
            throw new InvalidArgumentException("El ID debe ser positivo");
        }
        if (!isset($libros[$id])) {
            throw new OperacionBibliotecaException("No existe el libro con ID $id");
        }
        $libros[$id]->prestar();
    }

    $idsAProcesar = [10, 10, 20, 99, 0];

    foreach ($idsAProcesar as $id) {
        try {
            prestarPorId($libros, $id);
            echo "ID $id: Préstamo realizado<br>";
        } catch (LibroNoDisponibleException $e) {
            echo "ID $id - LibroNoDisponibleException: " . $e->getMessage() . "<br>";
        } catch (OperacionBibliotecaException $e) {
            echo "ID $id - OperacionBibliotecaException: " . $e->getMessage() . "<br>";
        } catch (InvalidArgumentException $e) {
            echo "ID $id - InvalidArgumentException: " . $e->getMessage() . "<br>";
        } finally {
            echo "Fin de operación $id<br><br>";
        }
    }

    echo "--- Disponibilidad final ---<br>";
    echo "Dune (10): " . ($libros[10]->estaDisponible() ? 'disponible' : 'prestado') . "<br>";
    echo "Solaris (20): " . ($libros[20]->estaDisponible() ? 'disponible' : 'prestado') . "<br>";
?>
