<?php
    final class Libro{
        public function __construct(
            public string $titulo,
            public bool $disponible = true,
        ){}

        public function prestar():void{
            $this->disponible=false;
        }
    }
    
    $Dune = new Libro("dune");
    var_dump($Dune->disponible);

    $Dune->prestar();
    var_dump($Dune->disponible);
?>