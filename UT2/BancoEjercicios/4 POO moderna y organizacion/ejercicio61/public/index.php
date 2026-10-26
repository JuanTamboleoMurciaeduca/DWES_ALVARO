<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Libro;
    use App\Repository\ArrayLibroRepository;
    use App\Service\CatalogoService;
    use App\Exception\LibroNoDisponibleException;

    // 1. Inicialización del catálogo
    $dune = new Libro(10, 'Dune', 412, true);
    $solaris = new Libro(20, 'Solaris', 216, false);
    $dracula = new Libro(30, 'Drácula', 418, true);
    $hobbit = new Libro(40, 'El Hobbit', 310, true);

    $repositorio = new ArrayLibroRepository([$dune, $solaris, $dracula, $hobbit]);
    $servicio = new CatalogoService($repositorio);

    // Función auxiliar para imprimir resultados en la entrada
    $imprimir = function (array $libros): void {
        if (empty($libros)) {
            echo "Sin resultados" . PHP_EOL;
            return;
        }
        foreach ($libros as $libro) {
            echo "- {$libro->titulo()} ({$libro->paginas()} páginas)" . PHP_EOL;
        }
    };

    // 2. Búsqueda vacía y máximo 500 -> El Hobbit, Dune, Drácula
    echo "=== 1. Búsqueda vacía y máximo 500 ===" . PHP_EOL;
    $imprimir($servicio->buscarDisponibles('', 500));

    // 3. Búsqueda ' DRÁ ' y máximo 500 -> Drácula
    echo PHP_EOL . "=== 2. Búsqueda ' DRÁ ' y máximo 500 ===" . PHP_EOL;
    $imprimir($servicio->buscarDisponibles(' DRÁ ', 500));

    // 4. Búsqueda 'xyz' -> Sin resultados
    echo PHP_EOL . "=== 3. Búsqueda 'xyz' y máximo 500 ===" . PHP_EOL;
    $imprimir($servicio->buscarDisponibles('xyz', 500));

    // 5. Prestar ID 10 y capturar segundo intento
    echo PHP_EOL . "=== 4. Prestando ID 10 ===" . PHP_EOL;
    $servicio->prestarPorId(10);
    echo "ID 10 prestado con éxito." . PHP_EOL;

    try {
        $servicio->prestarPorId(10);
    } catch (LibroNoDisponibleException $e) {
        echo "Excepción capturada (segundo préstamo ID 10): " . $e->getMessage() . PHP_EOL;
    }

    // 6. Consultar de nuevo con búsqueda vacía y máximo 500 -> El Hobbit, Drácula
    echo PHP_EOL . "=== 5. Búsqueda tras prestar ID 10 (máx 500) ===" . PHP_EOL;
    $imprimir($servicio->buscarDisponibles('', 500));

    // 7. Devolver ID 10 y consultar catálogo disponible completo
    echo PHP_EOL . "=== 6. Devolviendo ID 10 ===" . PHP_EOL;
    $servicio->devolverPorId(10);
    echo "ID 10 devuelto con éxito." . PHP_EOL;
    echo "Catálogo disponible completo:" . PHP_EOL;
    $imprimir($servicio->buscarDisponibles('', 500));

    // 8. Capturar rechazo de prestar ID 99
    echo PHP_EOL . "=== 7. Intentando prestar ID 99 ===" . PHP_EOL;
    try {
        $servicio->prestarPorId(99);
    } catch (InvalidArgumentException $e) {
        echo "Excepción capturada (ID 99): " . $e->getMessage() . PHP_EOL;
    }

    // 9. Capturar rechazo de consulta con máximo 0
    echo PHP_EOL . "=== 8. Intentando consulta con máximo 0 ===" . PHP_EOL;
    try {
        $servicio->buscarDisponibles('', 0);
    } catch (InvalidArgumentException $e) {
        echo "Excepción capturada (máximo 0): " . $e->getMessage() . PHP_EOL;
    }
?>
