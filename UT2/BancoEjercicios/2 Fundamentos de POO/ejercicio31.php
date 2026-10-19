<?php
    final class Libro{
        public function __construct(
            public string $titulo,
            public bool $disponible = true,
        ) {}
        
        public function prestar(): void
        {
            //no hace falta poner el libro, lo reconoce automaticamente
            $this->disponible=false;
        }
        
        public function devolver(): void
        {
            $this->disponible=true;
        }
    }

    $dune = new Libro("dune");
    $solaris = new Libro("solaris");
    print_r($dune);

    $dune->prestar();
    print_r($dune);

    $dune->devolver();
    print_r($dune);

    // al modificar un objeto, modificas la instacia del objeto, no todas las instacias de todos los objetos


?>