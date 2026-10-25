<?php
    $codigo = "LIB-2026-0042";

    $prefijo = substr($codigo, 0, 3);
    $numero = substr($codigo, -4);

    echo $prefijo . "<br>";
    echo $numero . "<br>";

    $palabra = "Drácula";
    $tresPrimeros = mb_substr($palabra, 0, 3, "UTF-8");
    echo $tresPrimeros . "<br>";

    // Se usa mb_substr porque la 'a' con tilde ocupa 2 bytes y substr normal romperia el caracter
?>