<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/datos/libros.php';

use Juan\Biblioteca\Modelo\LibroDigital;
use Juan\Biblioteca\Modelo\LibroPapel;
use Juan\Biblioteca\Servicio\BibliotecaService;

$bibService = new BibliotecaService($libros);

$valores = [
    'tipo' => '',
    'titulo' => '',
    'autor' => '',
    'paginas' => '',
    'genero' => '',
    'unidades' => '',
    'fechaAlta' => '',
    'destacado' => false,
    'observaciones' => '',
    'correo' => ''
];
$errores = [];
$ficha = null;
$filas = [];
$resumen = [
    'titulos' => 0,
    'unidades' => 0,
    'paginas' => 0,
    'costeCentimos' => 0
];
$fechaAlta = null;
$paginas = null;
$unidades = null;

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($metodo === 'POST') {
    $camposTexto = [
        'tipo',
        'titulo',
        'autor',
        'paginas',
        'genero',
        'unidades',
        'fechaAlta',
        'observaciones',
        'correo'
    ];

    foreach ($camposTexto as $campo) {
        $entrada = array_key_exists($campo, $_POST) ? $_POST[$campo] : '';

        if (!is_string($entrada)) {
            $errores[$campo] = 'El valor enviado no es válido.';
            continue;
        }

        $valores[$campo] = trim($entrada);
    }

    if (!isset($errores['tipo']) && !in_array($valores['tipo'], ['papel', 'digital'], true)) {
        $errores['tipo'] = 'Selecciona un tipo de libro válido.';
    }

    if (!isset($errores['titulo'])) {
        if ($valores['titulo'] === '') {
            $errores['titulo'] = 'El título es obligatorio.';
        } elseif (mb_strlen($valores['titulo'], 'UTF-8') > 120) {
            $errores['titulo'] = 'El título no puede superar los 120 caracteres.';
        }
    }

    if (!isset($errores['autor'])) {
        if ($valores['autor'] === '') {
            $errores['autor'] = 'El autor es obligatorio.';
        } elseif (mb_strlen($valores['autor'], 'UTF-8') > 100) {
            $errores['autor'] = 'El autor no puede superar los 100 caracteres.';
        }
    }

    if (!isset($errores['paginas'])) {
        $paginas = filter_var($valores['paginas'], FILTER_VALIDATE_INT);

        if ($paginas === false || $paginas < 1 || $paginas > 3000) {
            $errores['paginas'] = 'Introduce un número entero entre 1 y 3000.';
            $paginas = null;
        }
    }

    if (!isset($errores['genero']) && !in_array($valores['genero'], ['ciencia', 'fantasia', 'terror'], true)) {
        $errores['genero'] = 'Selecciona un género válido.';
    }

    if (!isset($errores['unidades'])) {
        $unidades = filter_var($valores['unidades'], FILTER_VALIDATE_INT);

        if ($unidades === false || $unidades < 1 || $unidades > 50) {
            $errores['unidades'] = 'Introduce un número entero entre 1 y 50.';
            $unidades = null;
        }
    }

    if (!isset($errores['fechaAlta']) && $valores['fechaAlta'] !== '') {
        try {
            $fechaAlta = DateTimeImmutable::createFromFormat('!Y-m-d', $valores['fechaAlta']);
        } catch (ValueError) {
            $fechaAlta = false;
        }

        if ($fechaAlta === false || $fechaAlta->format('Y-m-d') !== $valores['fechaAlta']) {
            $errores['fechaAlta'] = 'Introduce una fecha válida con formato YYYY-MM-DD.';
            $fechaAlta = null;
        }
    }

    if (array_key_exists('destacado', $_POST)) {
        if (is_string($_POST['destacado']) && $_POST['destacado'] === '1') {
            $valores['destacado'] = true;
        } else {
            $errores['destacado'] = 'El valor del campo destacado no es válido.';
        }
    }

    if (!isset($errores['observaciones']) && mb_strlen($valores['observaciones'], 'UTF-8') > 300) {
        $errores['observaciones'] = 'Las observaciones no pueden superar los 300 caracteres.';
    }

    if (!isset($errores['correo']) && filter_var($valores['correo'], FILTER_VALIDATE_EMAIL) === false) {
        $errores['correo'] = 'Introduce un correo electrónico válido.';
    }

    if ($errores === []) {
        try {
            $libro = $valores['tipo'] === 'papel'
                ? new LibroPapel(
                    $valores['titulo'],
                    $valores['autor'],
                    $paginas,
                    $valores['genero'],
                    $unidades,
                    $fechaAlta,
                    $valores['destacado'],
                    $valores['observaciones']
                )
                : new LibroDigital(
                    $valores['titulo'],
                    $valores['autor'],
                    $paginas,
                    $valores['genero'],
                    $unidades,
                    $fechaAlta,
                    $valores['destacado'],
                    $valores['observaciones']
                );

            $bibService->agregar($libro);
            $ficha = $bibService->filas([$libro])[0];
            $ficha['correo'] = $valores['correo'];
            $filas = $bibService->filas($bibService->todos());
            $resumen = $bibService->resumen($bibService->todos());
        } catch (InvalidArgumentException $exception) {
            $errores['general'] = $exception->getMessage();
        }
    }
}

require dirname(__DIR__) . '/vistas/alta.php';
