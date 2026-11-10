<?php

use function App\Soporte\e;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Alta de un videojuego</title>
</head>

<body>
    <h1>Alta de un videojuego</h1>

    <?php if ($creado === null): ?>
        <!-- Bloque de errores proporcionado. Cada entrada identifica el campo y su mensaje. -->
        <?php if ($errores !== []): ?>
            <ul role="alert">
                <?php foreach ($errores as $campo => $mensaje): ?>
                    <li><?= e($campo) ?>: <?= e($mensaje) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- COMPLETAR 2. Formulario POST multipart con controles HTML estáticos. -->

    <?php else: ?>
        <!-- Confirmación proporcionada. Solo aparece cuando asignas $creado. -->
        <h2>Videojuego creado</h2>

        <dl>
            <dt>Título</dt>
            <dd><?= e($creado->titulo()) ?></dd>

            <dt>Estudio</dt>
            <dd><?= e($creado->estudio()) ?></dd>

            <dt>Horas de juego</dt>
            <dd><?= $creado->horas() ?></dd>

            <dt>Género</dt>
            <dd><?= e($creado->genero()) ?></dd>

            <dt>Fecha de lanzamiento</dt>
            <dd><?= e($creado->fechaLanzamiento()?->format('Y-m-d') ?? 'Sin fecha') ?></dd>
        </dl>

        <p>La colección de este envío contiene <?= count($catalogo->todos()) ?> videojuegos.</p>

        <?php if ($creado->caratula() !== null): ?>
            <img src="caratula.php?nombre=<?= e($creado->caratula()) ?>"
                 alt="Carátula del videojuego creado" width="180">
        <?php else: ?>
            <p>Sin carátula</p>
        <?php endif; ?>

        <p><a href="alta.php">Nueva alta</a></p>
    <?php endif; ?>

    <p><a href="index.php">Volver al catálogo</a></p>
</body>

</html>
