<?php
    require_once __DIR__ . "/src/cargar.php";
    require_once __DIR__ . "/src/datos.php";

    $actividades = crearActividades();

    $actividades.importe(2);
    
?>