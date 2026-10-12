<?php
    $libros = [
        10 => ['titulo' => 'Dune', 'paginas' => 412],
        20 => ['titulo' => 'It', 'paginas' => 1504],
        30 => ['titulo' => '1984', 'paginas' => 328],
    ];

    $ordenTitu = uasort(
        $libros,
        fn(array $a, array $b):int => $a["titulo"] <=> $b["titulo"],
    );
?>