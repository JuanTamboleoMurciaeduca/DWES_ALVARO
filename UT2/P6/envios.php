<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Excepcion\EnvioException;
use App\Modelo\EnvioNormal;
use App\Modelo\EnvioUrgente;
use App\Modelo\EstadoEnvio;
use App\Repositorio\RepositorioEnviosMemoria;
use App\Servicio\ServicioEnvios;

// Función auxiliar para imprimir las etiquetas y el resumen de un resultado de consulta
function mostrarConsulta(string $titulo, array $envios, ServicioEnvios $servicio): void
{
    echo "=================================================="."<br>";
    echo "CONSULTA: {$titulo}"." <br>";
    echo "=================================================="."<br>";

    $etiquetas = $servicio->etiquetas($envios);
    $resumen = $servicio->resumir($envios);

    if (empty($envios)) {
        echo "Sin resultados "."<br>";
    } else {
        foreach ($etiquetas as $etiqueta) {
            echo "  * {$etiqueta}"." <br>";
        }
    }

    echo "<br>Resumen de la selección:"." <br>";
    echo "  - Cantidad: {$resumen['cantidad']} ". "<br>";
    echo "  - Peso total: {$resumen['peso']} g "." <br>";
    echo "  - Importe total: {$resumen['importeTotal']} céntimos "." <br>";
    echo "  - Importe activo: {$resumen['importeActivo']} céntimos "." <br>";
    echo "  - Estados -> Pendiente: {$resumen['pendiente']}, Enviado: {$resumen['enviado']}, Entregado: {$resumen['entregado']}, Cancelado: {$resumen['cancelado']} " ."<br>";
}

// -------------------------------------------------------------------------
// 5.1 ARRANQUE Y TARIFAS INICIALES
// -------------------------------------------------------------------------

// 1. Crear el repositorio y el servicio
$repositorio = new RepositorioEnviosMemoria();
$servicio = new ServicioEnvios($repositorio);

// 2. Cargar los 6 envíos iniciales en el catálogo (Apartado 2)
$repositorio->registrar(new EnvioNormal(101, 'Librería Órbita', 1000, EstadoEnvio::Pendiente));
$repositorio->registrar(new EnvioUrgente(102, 'Taller Norte', 1500, EstadoEnvio::Enviado));
$repositorio->registrar(new EnvioNormal(103, 'Café Álamo', 2500, EstadoEnvio::Entregado));
$repositorio->registrar(new EnvioUrgente(104, 'Estudio Prisma', 500, EstadoEnvio::Cancelado));
$repositorio->registrar(new EnvioNormal(105, 'Papelería Sol', 2000, EstadoEnvio::Pendiente));
$repositorio->registrar(new EnvioUrgente(106, 'Órbita Creativa', 1001, EstadoEnvio::Pendiente));

// 3. Mostrar catálogo inicial y tarifas
echo "=================================================="."<br>";
echo "CATÁLOGO INICIAL Y TARIFAS". " <br>";
echo "================================================== "."<br>";

$todosIniciales = $repositorio->todos();

foreach ($servicio->etiquetas($todosIniciales) as $etiqueta) {
    echo "{$etiqueta}"." <br>";
}

$resumenInicial = $servicio->resumir($todosIniciales);
echo "Resumen del catálogo inicial:". " <br>";
echo "  {$resumenInicial['cantidad']} envíos, {$resumenInicial['peso']} g,". "  <br>";
echo "importe total de {$resumenInicial['importeTotal']} céntimos e importe activo de {$resumenInicial['importeActivo']} céntimos."." <br>";
echo "  Estados: {$resumenInicial['pendiente']} pendientes, {$resumenInicial['enviado']} enviado, 
{$resumenInicial['entregado']} entregado y {$resumenInicial['cancelado']} cancelado." . "<br>";


// -------------------------------------------------------------------------
// 5.2 CONSULTAS ANTES DE MODIFICAR LOS ESTADOS
// -------------------------------------------------------------------------

// 1. Sin filtros (orden por precio por defecto) -> IDs esperados: 101, 105, 103, 104, 102, 106
$res1 = $servicio->consultar();
mostrarConsulta("Sin filtros (orden precio)", $res1, $servicio);

// 2. Texto "ORBITA" -> IDs esperados: 101, 106
$res2 = $servicio->consultar(texto: 'ORBITA');
mostrarConsulta("Texto 'ORBITA'", $res2, $servicio);

// 3. Modalidad urgente -> IDs esperados: 104, 102, 106
$res3 = $servicio->consultar(modalidad: 'urgente');
mostrarConsulta("Modalidad 'urgente'", $res3, $servicio);

// 4. Estado pendiente -> IDs esperados: 101, 105, 106
$res4 = $servicio->consultar(estado: EstadoEnvio::Pendiente);
mostrarConsulta("Estado 'pendiente'", $res4, $servicio);

// 5. Texto ÓRBITA, urgente y pendiente -> ID esperado: 106
$res5 = $servicio->consultar(texto: 'ÓRBITA', modalidad: 'urgente', estado: EstadoEnvio::Pendiente);
mostrarConsulta("Texto 'ÓRBITA', urgente y pendiente", $res5, $servicio);

// 6. Texto "ORBITA CREATIVA" -> ID esperado: 106
$res6 = $servicio->consultar(texto: 'ORBITA CREATIVA');
mostrarConsulta("Texto 'ORBITA CREATIVA'", $res6, $servicio);

// 7. Texto xyz -> Ninguno (Sin resultados)
$res7 = $servicio->consultar(texto: 'xyz');
mostrarConsulta("Texto 'xyz'", $res7, $servicio);

// 8. Sin filtros y orden por peso -> IDs esperados: 104, 101, 106, 102, 105, 103
$res8 = $servicio->consultar(orden: 'peso');
mostrarConsulta("Sin filtros (orden por peso)", $res8, $servicio);

// -------------------------------------------------------------------------
// COMPROBACIONES FINALES DEL APARTADO 5.2
// -------------------------------------------------------------------------

echo "=================================================="." <br>";
echo "COMPROBACIONES DE INTEGRIDAD Y REPOSICIÓN"." <br>";
echo "=================================================="." <vr>";

// Verificar que el repositorio conserva el orden inicial intacto
$idsRepositorio = array_map(fn($e) => $e->id(), $repositorio->todos());
echo "Orden actual en el repositorio: " . implode(', ', $idsRepositorio) ;

// Comprobar que buscar(101) devuelve la misma instancia en llamadas consecutivas
$instancia1 = $repositorio->buscar(101);
$instancia2 = $repositorio->buscar(101);

if ($instancia1 === $instancia2) {
    echo "Confirmado: buscar(101) devuelve la misma instancia de memoria."." <br>";
} else {
    echo "Error: buscar(101) devolvió distintas instancias.". " <br>";
}