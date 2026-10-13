<?php
    $libros= [
        [
            'id' => 1,
            'titulo' => 'Dune',
            'autor' => 'Frank Herbert',
            'genero' => 'ciencia ficcion',
            'paginas' => 412,
            'disponible' => true,
            'fechaAlta' => '2026-09-01',
            "ejemplares" => 12,
        ],
        [
            'id' => 2,
            'titulo' => 'El nombre del viento',
            'autor' => 'Patrick Rothfuss',
            'genero' => 'fantasia',
            'paginas' => 872,
            'disponible' => false,
            'fechaAlta' => '2026-08-18',
            "ejemplares" => 0,
        ],
        [
            'id' => 3,
            'titulo' => 'Un mago de Terramar',
            'autor' => 'Ursula K. Le Guin',
            'genero' => 'fantasia',
            'paginas' => 256,
            'disponible' => true,
            'fechaAlta' => '2026-07-03',
            "ejemplares" => 1,
        ],
        [
            'id' => 4,
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'genero' => 'distopia',
            'paginas' => 352,
            'disponible' => true,
            'fechaAlta' => '2026-06-20',
            "ejemplares" => 90,
        ]
    ];

    $ejemplares = array_find_key(
        $libros, 
        fn(array $libro):bool => $libro["ejemplares"] === 0,
    );
?>