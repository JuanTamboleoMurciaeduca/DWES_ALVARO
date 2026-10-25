<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Libro;
    use App\Repository\ArrayLibroRepository;
    use App\Service\CatalogoService;

    // Coleccion inicial
    $dune = new Libro(10, 'Dune', true);
    $solaris = new Libro(20, 'Solaris', false);
    $dracula = new Libro(30, 'Drácula', true);

    $repositorio = new ArrayLibroRepository([$dune, $solaris, $dracula]);
    $servicio = new CatalogoService($repositorio);

    echo "--- Libros disponibles en Catalogo 1 ---" . PHP_EOL;
    $titulos = $servicio->titulosDisponibles();
    foreach ($titulos as $titulo) {
        echo $titulo . PHP_EOL;
    }

    // Segundo servicio con repositorio vacio
    echo PHP_EOL . "--- Catalogo 2 (Vacio) ---" . PHP_EOL;
    $repoVacio = new ArrayLibroRepository([]);
    $servicioVacio = new CatalogoService($repoVacio);

    $titulosVacio = $servicioVacio->titulosDisponibles();
    if (empty($titulosVacio)) {
        echo "Sin libros disponibles" . PHP_EOL;
    } else {
        foreach ($titulosVacio as $titulo) {
            echo $titulo . PHP_EOL;
        }
    }
?>
