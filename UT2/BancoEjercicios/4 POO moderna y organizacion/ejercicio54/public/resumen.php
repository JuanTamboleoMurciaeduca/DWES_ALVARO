<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Libro;
    use App\Model\Revista;

    $libro = new Libro('Dune');
    $revista = new Revista('National Geographic');

    $recursos = [$libro, $revista];

    echo "Total de recursos: " . count($recursos) . PHP_EOL;
    foreach ($recursos as $recurso) {
        echo "Tipo: " . $recurso->tipo() . PHP_EOL;
    }
?>
