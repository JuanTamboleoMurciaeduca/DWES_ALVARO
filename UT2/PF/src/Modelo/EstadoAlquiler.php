<?php
    namespace Clase\Alquileres\Modelo;

    enum EstadoAlquiler:string{
        case Reservado="reservado";
        case Activo =  "activo";
        case Finalizado = "finalizado";
    }

?>