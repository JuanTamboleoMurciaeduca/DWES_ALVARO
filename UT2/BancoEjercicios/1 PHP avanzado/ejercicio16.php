<?php
    $texto = "Desarrollo Web con PHP";

    if(str_contains($texto, "PHP")){echo "aparece PHP en la posicion " . strpos($texto, "PHP");}

    if(strpos($texto, "D") !== false){
        echo "Esta es la posicion 0";
    }
?>