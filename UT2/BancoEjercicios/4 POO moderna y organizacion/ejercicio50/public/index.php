<?php
    require_once __DIR__ . '/../src/Model/Autor.php';
    require_once __DIR__ . '/../src/Model/Libro.php';
    require_once __DIR__ . '/../src/Importacion/Libro.php';

    use App\Model\Autor;
    use App\Model\Libro;
    use App\Importacion\Libro as LibroImportado;

    $autor = new Autor('Frank Herbert');
    $libro = new Libro('Dune', $autor);

    echo $libro->ficha() . PHP_EOL;

    $libroImportado = new LibroImportado('El Hobbit');
    echo $libroImportado->titulo() . PHP_EOL;
?>
