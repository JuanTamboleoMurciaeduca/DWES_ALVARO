<?php

use function App\Soporte\e;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alta de una película</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <main class="contenedor">
        <header class="cabecera">
            <h1>Alta de una película</h1>
        </header>

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
            <form action="alta.php" method="post" enctype="multipart/form-data">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" required maxlength="120">
          

                <label for="director">Director</label>
                <input type="text" name="director" id="director" required maxlength="100">
     

                <label for="duracion">Duracion</label>
                <input type="text" name="duracion" id="duracion">
     

                <label for="genero">Genero</label>
                <select name="genero" id="genero">
                    <option value="">Sin genero</option>
                    <option value="ciencia">Ciencia ficcion</option>
                    <option value="fantasia">Fantasia</option>
                    <option value="terror">Terror</option>
                </select>
        

                <label for="fechaEstreno">Fecha de estreno</label>
                <input type="text" name="fechaEstreno" id="fechaEstreno" placeholder="YYYY-MM-DD">
  

                <label for="cartel">Cartel</label>
                <input type="file" name="cartel" id="cartel" accept="image/jpeg,image/png,image/webp" >

                <button type="submit">Dar de alta</button>
            </form>

        <?php else: ?>
            <!-- Confirmación proporcionada. Solo aparece cuando asignas $creado. -->
            <section class="ficha" aria-labelledby="titulo-ficha">
                <h2 id="titulo-ficha">Película creada</h2>

                <dl>
                    <dt>Título</dt>
                    <dd><?= e($creado->titulo()) ?></dd>

                    <dt>Director</dt>
                    <dd><?= e($creado->director()) ?></dd>

                    <dt>Duración</dt>
                    <dd><?= $creado->duracion() ?></dd>

                    <dt>Género</dt>
                    <dd><?= e($creado->genero()) ?></dd>

                    <dt>Fecha de estreno</dt>
                    <dd><?= e($creado->fechaEstreno()?->format('Y-m-d') ?? 'Sin fecha') ?></dd>
                </dl>

                <p>La colección de este envío contiene <?= count($catalogo->todos()) ?> películas.</p>

                <?php if ($creado->cartel() !== null): ?>
                    <img src="cartel.php?nombre=<?= e($creado->cartel()) ?>"
                         alt="Cartel de la película creada" width="180">
                <?php else: ?>
                    <p>Sin cartel</p>
                <?php endif; ?>

                <p class="acciones"><a href="alta.php">Nueva alta</a></p>
            </section>
        <?php endif; ?>

        <p class="acciones"><a href="index.php">Volver al catálogo</a></p>
    </main>
</body>

</html>
