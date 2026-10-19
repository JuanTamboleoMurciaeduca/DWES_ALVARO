<?php
    class Libro{
        public function __construct(
            public string $titulo,
            public int $paginas,
        ){}

        public function ficha():string{
            
            return $this->titulo . " - " . $this->paginas . " paginas";

        }

        public function mostrarFicha():void{
            echo $this->titulo . " - " . $this->paginas . " paginas";
        }
    }

    $Dune = new Libro("dune", 412);
    $ficha = $Dune -> ficha();
    echo "Ficha: " . $ficha . "<br>";

    $Dune -> mostrarFicha();
?>