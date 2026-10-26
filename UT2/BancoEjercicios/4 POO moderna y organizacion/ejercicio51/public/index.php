<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Model\Autor;
    use App\Model\Libro;
    use App\Importacion\Libro as LibroImportado;
    use App\Model\Categoria;

    $autor = new Autor('Frank Herbert');
    $libro = new Libro('Dune', $autor);

    echo $libro->ficha() . PHP_EOL;

    $libroImportado = new LibroImportado('El Hobbit');
    echo $libroImportado->titulo() . PHP_EOL;

    $categoria = new Categoria('Ciencia ficción');
    echo $categoria->nombre() . PHP_EOL;
?>
