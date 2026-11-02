<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/datos/libros.php';

use Juan\Biblioteca\Servicio\BibliotecaService;

$bibService = new BibliotecaService($libros);

$q = isset($_GET['q']) && is_string($_GET['q']) ? $_GET['q'] : '';
$genero = isset($_GET['genero']) && is_string($_GET['genero']) ? $_GET['genero'] : '';
$tipo = isset($_GET['tipo']) && is_string($_GET['tipo']) ? $_GET['tipo'] : '';
$soloDestacados = isset($_GET['destacados']);

$librosFiltrados = $bibService->filtrar(
    $q,
    $genero,
    $tipo,
    $soloDestacados
);

$filas = $bibService->filas($librosFiltrados);
$resumen = $bibService->resumen($librosFiltrados);

require dirname(__DIR__) . '/vistas/catalogo.php';
