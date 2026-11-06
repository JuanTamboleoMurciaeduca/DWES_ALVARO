<?php
    $nombre = $_GET['nombre'] ?? '';
    if (!is_string($nombre) || 
    preg_match('/\A[a-f0-9]{32}\.(jpg|png|webp)\z/',$nombre) !== 1) {
        http_response_code(404);
        exit;
    }
    $directorio = __DIR__ . '/../storage/portadas';
    $ruta = $directorio . '/' . $nombre;
    

    if(!is_file($ruta) || !is_readable($ruta)){
        http_response_code(404);    
        exit;
    }

    $mime = new finfo(FILEINFO_MIME_TYPE)->file($ruta);

    $permitidos = [
        "image/jpeg" => "jpg",
        "image/png" => "png",
        "image/webp" => "webp",
    ];

    if($mime === false || !isset($permitidos[$mime])){
        http_response_code(404);
        exit;
    }
?>
