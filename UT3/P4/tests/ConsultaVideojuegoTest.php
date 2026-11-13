<?php

declare(strict_types=1);

use App\Contrato\VideojuegoRepository;
use App\Modelo\Videojuego;
use App\Servicio\ConsultaVideojuego;
use PHPUnit\Framework\TestCase;

final class ConsultaVideojuegoTest extends TestCase
{
    public function testVideojuegoAusenteConStub(): void
    {
        $repositorio = new class implements VideojuegoRepository {
            public function buscarPorId(int $id): ?Videojuego
            {
                return null;
            }
        };

        $consulta = new ConsultaVideojuego($repositorio);

        $this->expectException(OutOfBoundsException::class);
        $consulta->obtener(99);
    }

    public function testConsultaUnicaDelIdentificadorConMock(): void
    {
        $videojuego = new Videojuego('Islas de cristal', 'Nébula Studio', 35, 'aventura');

        $repositorio = $this->createMock(VideojuegoRepository::class);
        $repositorio->expects($this->once())
            ->method('buscarPorId')
            ->with(7)
            ->willReturn($videojuego);

        $consulta = new ConsultaVideojuego($repositorio);

        $this->assertSame($videojuego, $consulta->obtener(7));
    }
}
