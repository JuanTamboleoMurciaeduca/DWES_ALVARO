<?php
    class libros{
        public function __construct(
            private string $titulo,
            private string $autor,
            private int $paginas,
            private bool $disponible,
        ){}
    }

    $libro1 = new libros("Dune", "Frank Herbert", 412, true);
    print_r($libro1);
?>