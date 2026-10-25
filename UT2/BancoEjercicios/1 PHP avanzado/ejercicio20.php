<?php
    $cadena = "texto   con     muchos       espacios
    
    y saltos de linea";

    $normalizada = preg_replace('/\s+/', ' ', $cadena);

    echo $normalizada;
?>
