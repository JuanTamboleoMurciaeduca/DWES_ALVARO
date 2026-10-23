<?php
    namespace App\model;

    use App\modelo\Envio;
    use App\modelo\EnvioNormal;
    use App\Modelo\EstadoEnvio;

    $envio = new EnvioNormal(1, "yo", 20, EstadoEnvio::Pendiente);

    print_r($envio);
?>