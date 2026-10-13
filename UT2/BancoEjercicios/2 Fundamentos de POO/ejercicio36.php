<?php
    class Autor{
        public function __construct(
            public string $nombre,
        ){}
    }

    final class Libro{
        public function __construct(
            public string $titulo,
            public ?Autor $autor = null,
        ) {}
    }

    $conAutor = new Libro('Dune', new Autor('Frank Herbert'));
    $sinAutor = new Libro('Relato anónimo');

?>