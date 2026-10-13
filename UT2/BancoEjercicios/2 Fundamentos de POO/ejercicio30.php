<?php
    // final class Libro
    // {
    //     public string $titulo;
    //     public bool $disponible;
    //     public function __construct(
    //     string $titulo, bool $disponible = true
    // ) {
    //     $this->titulo = $titulo;
    //     $this->disponible = $disponible;
    //     }
    // }

    final class Libro{
        public function __construct(
            public string $titulo,
            public bool $disponible = true,
        ){}
    }

    $libro2 = new Libro("Dune");
    $libro3 = new Libro("solaris", false);

    print_r($libro2); // Por defecto cojo el true
    print_r($libro3);

    // si pusiese el new libro daria error ya que no hay un valor por defecto
    // para $titulo
?>