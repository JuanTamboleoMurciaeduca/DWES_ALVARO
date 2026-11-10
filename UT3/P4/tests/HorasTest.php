<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function App\Soporte\validarVideojuego;

final class HorasTest extends TestCase
{
    // COMPLETAR 9. Proveedor y prueba de los cinco valores de horas.


    // Proporcionado. Datos válidos sobre los que varías solo horas.
    private function datosValidos(): array
    {
        return [
            'titulo' => 'Islas de cristal',
            'estudio' => 'Nébula Studio',
            'horas' => '35',
            'genero' => 'aventura',
            'fechaLanzamiento' => '',
        ];
    }
}
