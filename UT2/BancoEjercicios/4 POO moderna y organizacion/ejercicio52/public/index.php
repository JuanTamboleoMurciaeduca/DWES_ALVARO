<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Personas\Autor;
    use App\Model\Libro;
    use App\Service\CatalogoService;

    $dune = new Libro('Dune', new Autor('Frank Herbert'));
    $solaris = new Libro('Solaris', new Autor('Stanislaw Lem'));

    $servicio = new CatalogoService([$dune, $solaris]);

    foreach ($servicio->fichas() as $ficha) {
        echo $ficha . PHP_EOL;
    }

    // Segunda comprobacion con array vacio: no debe mostrar fichas
    $servicioVacio = new CatalogoService([]);
    foreach ($servicioVacio->fichas() as $ficha) {
        echo $ficha . PHP_EOL;
    }
?>
