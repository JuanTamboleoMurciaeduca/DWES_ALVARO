<?php

declare(strict_types=1);

use App\Modelo\Pelicula;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

final class CatalogoTest extends TestCase
{
    // COMPLETAR 8. Creación válida y estado del objeto.
    function testCatalogo(){
        $pelicula = new Pelicula(" Dune ", " Denis Villeneuve ", 155, "ciencia");

        assertEquals("Dune", $pelicula->titulo());
        assertEquals("Denis Villeneuve", $pelicula->director());
        assertEquals(155, $pelicula->duracion());
        assertEquals(null, $pelicula->fechaEstreno());
    }
}
