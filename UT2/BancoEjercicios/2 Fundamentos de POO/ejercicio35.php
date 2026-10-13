<?php
    class Autor{
        public function __construct(
            public string $nombre,
        ){}
    }

    class Categoria{
        public function __construct(
            public string $nombre,
        ){}
    }

    class Libro{
        public function __construct(
            public string $titulo,
            public Autor $autor,
            public Categoria $cat, 
        ){}
    }

    $autor = new Autor("frank herbert");
    $categoria = new Categoria("Sci-fi");
    $libro = new Libro("Dune", $autor, $categoria);

    echo $libro->autor->nombre . "  ";
    echo $libro->cat->nombre;
?>