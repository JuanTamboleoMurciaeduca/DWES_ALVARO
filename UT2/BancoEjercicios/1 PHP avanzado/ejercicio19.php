<?php
    $patron = '/^LIB-\d{4}-\d{4}$/';

    $codigoValido = "LIB-2026-0042";
    $codigoInvalido1 = "LIB-2026-42";
    $codigoInvalido2 = "DOC-2026-0042";

    $resultadoValido = preg_match($patron, $codigoValido);
    $resultadoInvalido1 = preg_match($patron, $codigoInvalido1);
    $resultadoInvalido2 = preg_match($patron, $codigoInvalido2);

    var_dump($resultadoValido);
    var_dump($resultadoInvalido1);
    var_dump($resultadoInvalido2);

    // preg_match devuelve 1 si coincide, 0 si no coincide y false si da error el patron
?>
