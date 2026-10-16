<?php
declare(strict_types=1);

require_once __DIR__ . '/Autor.php';
require_once __DIR__ . '/Categoria.php';
require_once __DIR__ . "/Libro.php";

// Fase 2.1: crea aquí un Autor y una Categoria y muestra sus nombres.
$autor = new Autor("Frank Herbert");
$cat = new Categoria("Ciencia Ficcion");

echo $autor->nombre ."<br>";
echo $cat->nombre . "<br>";

// Fase 2.2: cuando completes Libro.php, añade su require_once arriba.
// Después crea los dos libros y muestra su disponibilidad.
$libro = new Libro(01, "          Dune             ", 412, $autor, $cat);
echo $libro->disponible . "<br>";
echo $libro->titulo;

$libro2 = new Libro(01, "Dune", 412, $autor, $cat, false);
echo $libro2->disponible . "<br>";
// Fase 3.2: sustituye las pruebas anteriores por un Libro construido
// con las variables $titulo y $paginas. Muestra ambas propiedades.
$libro = new Libro(01, "          Dune             ", 412, $autor, $cat);
echo $libro->disponible . "<br>";
echo $libro->titulo . "<br>";

$libro2 = new Libro(01, "", -10, $autor, $cat, false);
echo $libro2->titulo . "<br>";
echo $libro2->paginas . "<br>";
?>