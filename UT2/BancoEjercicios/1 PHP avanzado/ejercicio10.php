<?php
    $paginas = [123,12434,452,5424];

    $masDeMil = array_any(
        $paginas,
        fn(int $n): bool => $n > 1000,
    );

    $masDeCero = array_all(
        $paginas,
        fn(int $n): bool => $n > 0,
    );

    echo $masDeMil . "<br>";
    echo $masDeCero;

?>