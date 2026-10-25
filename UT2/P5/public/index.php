<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/cargar.php';
require_once __DIR__ . '/../src/datos.php';
require_once __DIR__ . '/../src/funciones.php';

$actividades = crearActividades();
$avisos = [];
$mensaje = '';
$error = '';
$cierre = '';

// INICIO E1
// TODO E1. Lee y valida los filtros como indica el apartado 7.
$texto = entrada($_GET, 'q', ''); // El parámetro de búsqueda en el formulario GET es 'q'

// Validar tipo (vacío, gratuita o pago)
$tipoInput = entrada($_GET, 'tipo', '');
if ($tipoInput !== '' && $tipoInput !== 'gratuita' && $tipoInput !== 'pago') {
    $avisos[] = 'Tipo no válido. Se mostrarán todos los tipos.';
    $tipo = '';
} else {
    $tipo = $tipoInput;
}

// Validar estado (convertir usando tryFrom)
$estadoTexto = entrada($_GET, 'estado', '');
$estado = null;
if ($estadoTexto !== '') {
    $estado = EstadoActividad::tryFrom($estadoTexto);
    if ($estado === null) {
        $avisos[] = 'Estado desconocido. Se mostrarán todos los estados.';
    }
}

// Validar disponibles (solo '1' activa el filtro)
$disponiblesInput = entrada($_GET, 'disponibles', '');
$soloDisponibles = ($disponiblesInput === '1');

// Validar orden ('nombre' por defecto; solo admite 'nombre' o 'libres')
$ordenInput = entrada($_GET, 'orden', 'nombre');
if ($ordenInput !== 'nombre' && $ordenInput !== 'libres') {
    $avisos[] = 'Criterio de ordenación no válido. Se ordenará por nombre.';
    $orden = 'nombre';
} else {
    $orden = $ordenInput;
}

// Parámetro de ficha
$idConsulta = entrada($_GET, 'id', '');
// FIN E1

if (isset($_GET['accion'])) {
    // INICIO E2
    // TODO E2. Procesa la operación y captura las excepciones como indica el apartado 7.
    try {
        $accion = entrada($_GET, 'accion', '');
        if ($accion !== 'reservar' && $accion !== 'cancelar') {
            throw new InvalidArgumentException('Acción no válida.');
        }

        $idActividad = enteroPositivo(entrada($_GET, 'idActividad', ''));
        $cantidad = enteroPositivo(entrada($_GET, 'cantidad', ''));

        // Buscar en el catálogo completo
        $actividadOperacion = buscarPorId($actividades, $idActividad);
        if ($actividadOperacion === null) {
            throw new ReservaException('No existe la actividad indicada.');
        }

        if ($accion === 'reservar') {
            $actividadOperacion->reservar($cantidad);
            $importeFormateado = euros($actividadOperacion->importe($cantidad));
            $mensaje = "Reserva realizada. Importe: " . $importeFormateado;
        } else {
            $actividadOperacion->cancelar($cantidad);
            $importeFormateado = euros($actividadOperacion->importe($cantidad));
            $mensaje = "Cancelación realizada. Importe: " . $importeFormateado;
        }
    } catch (PlazasInsuficientesException $e) {
        $error = "Plazas insuficientes: " . $e->getMessage();
    } catch (ReservaException $e) {
        $error = "Operación rechazada: " . $e->getMessage();
    } catch (InvalidArgumentException $e) {
        $error = "Entrada no válida: " . $e->getMessage();
    } finally {
        $cierre = "Procesamiento de la operación finalizado.";
    }
    // FIN E2
}

// INICIO E3
// TODO E3. Consulta la ficha y prepara el listado, el resumen y las etiquetas.


$ficha = null;
if ($idConsulta !== '') {
    try {
        $idValidado = enteroPositivo($idConsulta);
        $ficha = buscarPorId($actividades, $idValidado);
        if ($ficha === null) {
            $avisos[] = 'No existe la actividad de la ficha.';
        }
    } catch (InvalidArgumentException $e) {
        $avisos[] = 'El id de la ficha debe ser un entero positivo.';
    }
}

$visibles = filtrarActividades($actividades, $texto, $tipo, $estado, $soloDisponibles);
$visibles = ordenarActividades($visibles, $orden);

$resumen = resumirActividades($visibles);
$etiquetas = generarEtiquetas($visibles, prefijo: 'Actividad: ');
// FIN E3

require __DIR__ . '/../vista/catalogo.php';
