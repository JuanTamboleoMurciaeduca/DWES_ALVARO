<?php

declare(strict_types=1);

$equipos = [
    [
    'id' => 201, 
    'nombre' => 'Cámara réflex', 
    'categoria' => 'Fotografía', 
    'unidades' => 6, 
    'responsable' => 'Ana Torres', 
    'codigo' => 'AV-2026-0201'
    ],
    [   
    'id' => 202, 'nombre' => 
    'Micrófono inalámbrico', 
    'categoria' => 'Sonido', 
    'unidades' => 4, 
    'responsable' => null, 
    'codigo' => 'AV-2026-0202'
    ],
    [
    'id' => 203, 
    'nombre' => 'Trípode ligero', 
    'categoria' => 'Fotografía', 
    'unidades' => 8, 
    'responsable' => 'Lucía Gil', 
    'codigo' => 'AV-2026-0203'
    ],
    [
    'id' => 204, 
    'nombre' => 'Cámara compacta', 
    'categoria' => 'Fotografía', 
    'unidades' => 3, 
    'responsable' => 'Óscar Ruiz', 
    'codigo' => 'AV-2026-0204'
    ],
    [
    'id' => 205, 
    'nombre' => '  Órbita   led  ', 
    'categoria' => 'Iluminación', 
    'unidades' => 5, 
    'responsable' => null, 
    'codigo' => 'AV-2026-0205'
    ],
];

$prestamos = [
    ['id' => 1, 'equipoId' => 201, 'unidades' => 2, 'estado' => 'activo'],
    ['id' => 2, 'equipoId' => 201, 'unidades' => 1, 'estado' => 'activo'],
    ['id' => 3, 'equipoId' => 201, 'unidades' => 1, 'estado' => 'devuelto'],
    ['id' => 4, 'equipoId' => 202, 'unidades' => 4, 'estado' => 'activo'],
    ['id' => 5, 'equipoId' => 203, 'unidades' => 3, 'estado' => 'activo'],
    ['id' => 6, 'equipoId' => 204, 'unidades' => 3, 'estado' => 'activo'],
    ['id' => 7, 'equipoId' => 205, 'unidades' => 1, 'estado' => 'activo'],
    ['id' => 8, 'equipoId' => 203, 'unidades' => 2, 'estado' => 'cancelado'],
];
