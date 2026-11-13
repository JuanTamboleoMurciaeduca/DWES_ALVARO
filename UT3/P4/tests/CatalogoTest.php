<?php

declare(strict_types=1);

use App\Modelo\Videojuego;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertSame;

final class CatalogoTest extends TestCase
{
    // COMPLETAR 8. Creación válida y estado del objeto.
    function testVideojuego()
    {
        $videojuego = new Videojuego(" Islas de cristal ", " Nébula Studio ", 35, "aventura");

        assertSame("Islas de cristal", $videojuego->titulo());
        assertSame("Nébula Studio", $videojuego->estudio());
        assertSame(35, $videojuego->horas());
        assertNull($videojuego->fechaLanzamiento());
    }
}
