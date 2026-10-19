<?php
    $generos= ["terror", "sci-fi", "drama", "sci-fi"];

    $elimaGeneros = array_unique(
        $generos
    );

    $claves = ["titulo", "autor", "genero"];
    $valores = ["Dune", "pepito", null];
    // los 2 arrays deben ser del mismo tamaño
    $libro = array_combine($claves,$valores);

?>