<?php
    // Ejercicio 55: Reparar un proyecto que no carga sus clases
    // Pasos de reparacion efectuados:
    // 1. Se movio Libro de src/libro.php a src/Model/Libro.php respetando PSR-4 (directorio Model y nombre de archivo Libro.php con mayuscula).
    // 2. Se corrigio el namespace de CatalogoService de App\Services a App\Service.
    // 3. Se anadio la importacion 'use App\Model\Libro;' dentro de CatalogoService.php.

    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Libro;
    use App\Service\CatalogoService;

    $servicio = new CatalogoService();

    $dune = new Libro('Dune');
    echo $servicio->mostrar($dune) . PHP_EOL;

    $solaris = new Libro('Solaris');
    echo $servicio->mostrar($solaris) . PHP_EOL;
?>
