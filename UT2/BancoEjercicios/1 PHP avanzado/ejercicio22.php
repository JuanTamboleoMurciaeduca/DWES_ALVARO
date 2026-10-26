<?php
    function sumarPaginas(int ...$paginas): int {
        return array_sum($paginas);
    }

    $arrayPaginas = [412, 872, 256, 352];

    $resultadoDesempaquetado = sumarPaginas(...$arrayPaginas);
    $resultadoUnoAUno = sumarPaginas(412, 872, 256, 352);

    echo $resultadoDesempaquetado . "<br>";
    echo $resultadoUnoAUno . "<br>";

    var_dump($resultadoDesempaquetado === $resultadoUnoAUno);
?>
