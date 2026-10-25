<?php
    $cadena = ' DRÁCULA ';

    $sinEspacios = trim($cadena);
    echo $sinEspacios . "<br>";

    $minusculas = mb_strtolower($sinEspacios, 'UTF-8');
    echo $minusculas . "<br>";

    $longitud = mb_strlen($minusculas, 'UTF-8');
    echo $longitud . "<br>";
?>
