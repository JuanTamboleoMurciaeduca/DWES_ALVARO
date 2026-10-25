<?php
    function normalizarId(int|string $id): int {
        return (int)$id;
    }

    function etiqueta(?string $titulo): string {
        return $titulo !== null ? "Libro: " . $titulo : "Sin titulo";
    }

    // Pruebas normalizarId
    echo normalizarId(25) . "<br>";
    echo normalizarId("104") . "<br>";

    // Pruebas etiqueta
    echo etiqueta("Dune") . "<br>";
    echo etiqueta(null) . "<br>";
?>
