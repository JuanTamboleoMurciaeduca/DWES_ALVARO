<?php
    final class Libro
    {
        public string $titulo;
        public int $paginas = 0; // -> inicializada
        public bool $disponible = true; // inicializada
    }

    // si se lee titulo unicamente, cogeria los valores por defecto
    $libro = new Libro("solarias", 216);

    print_r($libro);
    //no funcionaria una clase hija porque el objeto es final lo cual bloquea la herencia
?>