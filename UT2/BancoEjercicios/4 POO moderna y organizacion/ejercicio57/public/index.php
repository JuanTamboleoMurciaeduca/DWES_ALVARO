<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Libro;
    use App\Repository\ArrayLibroRepository;
    use App\Service\CatalogoService;
    use App\Exception\LibroNoDisponibleException;

    $dune = new Libro(10, 'Dune', true);
    $solaris = new Libro(20, 'Solaris', false);
    $dracula = new Libro(30, 'Drácula', true);

    $repositorio = new ArrayLibroRepository([$dune, $solaris, $dracula]);
    $servicio = new CatalogoService($repositorio);

    echo "--- Disponibles iniciales ---" . PHP_EOL;
    foreach ($servicio->titulosDisponibles() as $titulo) {
        echo $titulo . PHP_EOL;
    }

    // Prestar ID 10 mediante el servicio
    $servicio->prestarPorId(10);

    echo PHP_EOL . "--- Disponibles tras prestar ID 10 ---" . PHP_EOL;
    foreach ($servicio->titulosDisponibles() as $titulo) {
        echo $titulo . PHP_EOL;
    }

    echo PHP_EOL . "Dune estaDisponible(): " . ($dune->estaDisponible() ? 'true' : 'false') . PHP_EOL;

    // Intentar prestar otra vez id 10
    echo PHP_EOL . "--- Intento 1: volver a prestar ID 10 ---" . PHP_EOL;
    try {
        $servicio->prestarPorId(10);
    } catch (LibroNoDisponibleException $e) {
        echo "Excepción capturada: " . $e->getMessage() . PHP_EOL;
    }

    // Intentar prestar id 99
    echo PHP_EOL . "--- Intento 2: prestar ID 99 ---" . PHP_EOL;
    try {
        $servicio->prestarPorId(99);
    } catch (InvalidArgumentException $e) {
        echo "Excepción capturada: " . $e->getMessage() . PHP_EOL;
    }

    // Listar disponibles tras ambos rechazos
    echo PHP_EOL . "--- Disponibles finales ---" . PHP_EOL;
    foreach ($servicio->titulosDisponibles() as $titulo) {
        echo $titulo . PHP_EOL;
    }
?>
