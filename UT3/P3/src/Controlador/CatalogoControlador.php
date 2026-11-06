<?php
declare(strict_types=1);
namespace App\Controlador;

use App\Servicio\Inventario;
use function App\Soporte\validarFiltros;

final class CatalogoControlador
{
    public function __construct(private Inventario $inventario) {}

    public function mostrar(): void
    {
        $inventario = $this->inventario;
        $filtros = ['q' => '', 'categoria' => ''];
        $errores = [];
        $materiales = [];
        // COMPLETAR 2. Validar $_GET y consultar solo si no hay errores.

        //***********************************//
        //              FALLA                 //    
        //***********************************//

        $validar = validarFiltros($_GET);
        // $filtros = $validar['valores'];
        $errores = $validar["errores"];
        $materiales = $validar["valores"];
        // ['valores' => $valores, 'errores' => $errores] = $validar;

        require dirname(__DIR__, 2) . '/vistas/catalogo.php';
    }
}
