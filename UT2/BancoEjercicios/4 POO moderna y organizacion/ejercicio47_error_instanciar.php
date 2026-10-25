<?php
    // Intento de instanciar una clase abstracta -> Produce Error Fatal

    abstract class RecursoBiblioteca {
        public function __construct(public int $id, public string $titulo) {}
    }

    // Fatal error: Uncaught Error: Cannot instantiate abstract class RecursoBiblioteca
    $recurso = new RecursoBiblioteca(1, "Recurso generico");
?>
