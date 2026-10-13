<?php
    final class Libro
    {
        public function __construct(public string $titulo) {}
    }


    $original = new Libro('Dune');
    $alias = $original;
    $otro = new Libro('Dune');
    $alias->titulo = 'Solaris';

    //existen 2 objetos libro, original y otro, alias es una copia de original
    
    echo $original->titulo . PHP_EOL; // solarias
    echo $otro->titulo . PHP_EOL; //dune
    var_dump($original === $alias); // true
    var_dump($original === $otro); // false
?>