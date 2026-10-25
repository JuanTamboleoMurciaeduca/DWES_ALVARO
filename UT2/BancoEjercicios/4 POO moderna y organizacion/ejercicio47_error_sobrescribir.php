<?php
    // Intento de sobrescribir el metodo final origen() -> Produce Error Fatal

    abstract class RecursoBiblioteca {
        final public function origen(): string {
            return "Biblioteca";
        }
    }

    class LibroEspecial extends RecursoBiblioteca {
        // Fatal error: Cannot override final method RecursoBiblioteca::origen()
        public function origen(): string {
            return "Otra biblioteca";
        }
    }
?>
