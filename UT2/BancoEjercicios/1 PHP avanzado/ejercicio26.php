<?php
    function mostrar(mixed $valor): string {
        if (is_bool($valor)) {
            return $valor ? 'true' : 'false';
        }
        return (string)$valor;
    }

    echo mostrar(true) . "<br>";
    echo mostrar(42) . "<br>";
    echo mostrar('Dune') . "<br>";

    // mixed no debe sustituir a un tipo mas concreto cuando se conoce porque reduce la seguridad y claridad del codigo,
    // impide detectar errores de tipo en tiempo de desarrollo y dificulta el autocompletado en el IDE.
?>
