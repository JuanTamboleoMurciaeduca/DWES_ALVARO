<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use function App\Soporte\inspeccionarCaratula;

final class CaratulaTemporalTest extends TestCase
{
    private ?string $temporal = null;

    // COMPLETAR 10. setUp, prueba de rechazo y tearDown.


    // Proporcionado. Representa el temporal como entrada de inspeccionarCaratula.
    private function entradaArchivo(): array
    {
        if ($this->temporal === null || !is_file($this->temporal)) {
            throw new RuntimeException('El temporal de prueba no está preparado.');
        }

        return [
            'caratula' => [
                'error' => UPLOAD_ERR_OK,
                'size' => filesize($this->temporal),
                'tmp_name' => $this->temporal,
            ],
        ];
    }
}
