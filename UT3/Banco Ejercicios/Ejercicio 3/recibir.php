<?php
    $titulo = "";
    $metodo = $_SERVER["REQUEST_METHOD"] ?? "GET";
    $esPost = $metodo === "POST";

    $titulo = $_POST["titulo"] ?? "";

    if(is_string($titulo)){
    
        trim($titulo);
    }

?>