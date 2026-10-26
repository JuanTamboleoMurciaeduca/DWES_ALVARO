<?php
    require_once __DIR__ . "/src/cargar.php";
    require_once __DIR__ . "/src/datos.php";

    $actividades = crearActividades();

    // $actividades.
    echo $actividades[1]->importe(2) . "<br>";
    echo $actividades[3]->importe(2). "<br>";

    $responsable1 = $actividades[1]->responsable();
    $responsable2 =  $actividades[3]->responsable();

    if($responsable1 === $responsable2){
        echo "Mismo responsable <br>";
    }else{
        echo "No son el mismo <br>";
    }

    echo "¿Responsable de 104 es null?: " . ($actividades[4]->responsable() === null ? "SÍ" : "NO") . "<br>";

    echo $actividades[1]->etiqueta("Actividad: ");
    echo "<br>";
    if ($responsable1 !== null) {
        echo $responsable1->etiqueta("Responsable: ");
    }


    echo "<br> --- 5. Modelo validado correctamente --- <br>";
?>