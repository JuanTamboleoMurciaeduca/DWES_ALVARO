<?php
    // use App\Importacion\Libro;
    // use App\Model\Libro as libroModelo;
    // use App\Model\Personas\Autor;

    // require_once __DIR__ . '/../vendor/autoload.php';

    // $libro = new Libro('Dune');
    // $modelo = new libroModelo("Mantecao");
    // $auto = new Autor("Frank Herbert");

    // echo $libro->titulo() . PHP_EOL;
    // echo $auto->nombre() . PHP_EOL;
    // echo $modelo->titulo() . PHP_EOL;

    // use Ramsey\Uuid\Uuid;
    // require_once __DIR__ . '/../vendor/autoload.php';
    // $identificador = Uuid::uuid4();
    // echo $identificador->toString() . PHP_EOL;

    use App\Model\Libro;
    use App\Importacion\Libro as LibroImportado;
    use Ramsey\Uuid\Uuid;

    require_once __DIR__ . '/../vendor/autoload.php';

    $libro = new Libro('Dune');
    $importado = new LibroImportado('El Hobbit');
    
    $id = Uuid::uuid4()->toString();

    echo $libro->titulo() . PHP_EOL;
    echo $importado->titulo() . PHP_EOL;
    echo 'UUID generado: ' . $id . PHP_EOL;