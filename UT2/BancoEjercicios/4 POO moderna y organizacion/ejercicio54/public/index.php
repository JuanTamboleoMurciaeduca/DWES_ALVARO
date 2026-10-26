<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Libro;
    use App\Model\Revista;
    use App\Service\ListadoService;

    $dune = new Libro('Dune');
    $ciencia = new Revista('Ciencia');
    $historia = new Revista('Historia');

    $servicio = new ListadoService();
    $lineas = $servicio->lineas([$dune, $ciencia, $historia]);

    foreach ($lineas as $linea) {
        echo $linea . PHP_EOL;
    }
?>
