<?php
    function ficha(string $titulo, string $autor): string {
        return "Titulo: $titulo | Autor: $autor";
    }

    // Llamada con argumentos nombrados en orden inverso
    $texto = ficha(autor: "Frank Herbert", titulo: "Dune");

    echo $texto;
?>
