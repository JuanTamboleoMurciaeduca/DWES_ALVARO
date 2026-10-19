<?php
    $generos= ["fantasia", "terror", "sci-fi"];

    $terror = array_search(
        "terror",
        $generos,
        true,
    );

    if($terror === false){
        echo "no encontrado";
    }
?>