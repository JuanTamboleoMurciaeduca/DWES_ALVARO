<?php
    // Intento de reasignar una propiedad readonly en Autor -> Produce Error

    class Autor {
        public function __construct(
            public readonly string $nombre,
            public readonly string $codigo,
        ) {}
    }

    $autor = new Autor('Frank Herbert', 'AUT-01');

    // Intentar reasignar produce Error: Cannot modify readonly property Autor::$nombre
    $autor->nombre = 'Otro Nombre';
?>
