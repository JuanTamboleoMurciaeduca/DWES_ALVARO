<?php
$escapar = static fn(string $texto): string => htmlspecialchars(
    $texto,
    ENT_QUOTES | ENT_SUBSTITUTE,
    'UTF-8'
);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de un libro</title>
</head>

<body>
    <h1>Alta de un libro</h1>

    <?php if ($ficha !== null): ?>
        <h2>Libro dado de alta correctamente</h2>
        <p>Registro realizado por <?= $escapar($ficha['correo']) ?></p>

        <h2>Ficha del libro</h2>
        <dl>
            <dt>Título</dt>
            <dd><?= $escapar($ficha['titulo']) ?></dd>
            <dt>Autor</dt>
            <dd><?= $escapar($ficha['autor']) ?></dd>
            <dt>Tipo</dt>
            <dd><?= $ficha['tipo'] === 'papel' ? 'Papel' : 'Digital' ?></dd>
            <dt>Género</dt>
            <dd><?= $escapar($ficha['genero']) ?></dd>
            <dt>Páginas</dt>
            <dd><?= $ficha['paginas'] ?></dd>
            <dt>Ejemplares o licencias</dt>
            <dd><?= $ficha['unidades'] ?></dd>
            <dt>Fecha de alta</dt>
            <dd><?= $escapar($ficha['fechaAlta']) ?></dd>
            <dt>Destacado</dt>
            <dd><?= $ficha['destacado'] ? 'Sí' : 'No' ?></dd>
            <dt>Observaciones</dt>
            <dd><?= $ficha['observaciones'] !== '' ? $escapar($ficha['observaciones']) : 'Sin observaciones' ?></dd>
            <dt>Coste de reposición</dt>
            <dd><?= number_format($ficha['costeCentimos'] / 100, 2, ',', '.') ?> €</dd>
        </dl>

        <h2>Catálogo actualizado</h2>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Tipo</th>
                    <th>Páginas</th>
                    <th>Unidades</th>
                    <th>Coste de reposición</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filas as $fila): ?>
                    <tr>
                        <td><?= $escapar($fila['titulo']) ?></td>
                        <td><?= $escapar($fila['autor']) ?></td>
                        <td><?= $escapar($fila['genero']) ?></td>
                        <td><?= $fila['tipo'] === 'papel' ? 'Papel' : 'Digital' ?></td>
                        <td><?= $fila['paginas'] ?></td>
                        <td><?= $fila['unidades'] ?></td>
                        <td><?= number_format($fila['costeCentimos'] / 100, 2, ',', '.') ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Resumen</h2>
        <p>Número de títulos: <?= $resumen['titulos'] ?></p>
        <p>Unidades: <?= $resumen['unidades'] ?></p>
        <p>Páginas: <?= $resumen['paginas'] ?></p>
        <p>Coste total: <?= number_format($resumen['costeCentimos'] / 100, 2, ',', '.') ?> €</p>

        <p><a href="index.php">Volver al catálogo</a></p>
    <?php else: ?>
        <?php if (isset($errores['general'])): ?>
            <p><?= $escapar($errores['general']) ?></p>
        <?php endif; ?>

        <form action="alta.php" method="post">
            <p>
                <label for="tipo">Tipo de libro</label>
                <select id="tipo" name="tipo">
                    <option value="" <?= $valores['tipo'] === '' ? 'selected' : '' ?>>Selecciona un tipo</option>
                    <option value="papel" <?= $valores['tipo'] === 'papel' ? 'selected' : '' ?>>Papel</option>
                    <option value="digital" <?= $valores['tipo'] === 'digital' ? 'selected' : '' ?>>Digital</option>
                </select>
                <?php if (isset($errores['tipo'])): ?>
                    <span><?= $escapar($errores['tipo']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" maxlength="120" required value="<?= $escapar($valores['titulo']) ?>">
                <?php if (isset($errores['titulo'])): ?>
                    <span><?= $escapar($errores['titulo']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" maxlength="100" required value="<?= $escapar($valores['autor']) ?>">
                <?php if (isset($errores['autor'])): ?>
                    <span><?= $escapar($errores['autor']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="paginas">Páginas</label>
                <input type="text" id="paginas" name="paginas" inputmode="numeric" value="<?= $escapar($valores['paginas']) ?>">
                <?php if (isset($errores['paginas'])): ?>
                    <span><?= $escapar($errores['paginas']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="genero">Género</label>
                <select id="genero" name="genero">
                    <option value="" <?= $valores['genero'] === '' ? 'selected' : '' ?>>Selecciona un género</option>
                    <option value="ciencia" <?= $valores['genero'] === 'ciencia' ? 'selected' : '' ?>>Ciencia</option>
                    <option value="fantasia" <?= $valores['genero'] === 'fantasia' ? 'selected' : '' ?>>Fantasía</option>
                    <option value="terror" <?= $valores['genero'] === 'terror' ? 'selected' : '' ?>>Terror</option>
                </select>
                <?php if (isset($errores['genero'])): ?>
                    <span><?= $escapar($errores['genero']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="unidades">Ejemplares o licencias</label>
                <input type="text" id="unidades" name="unidades" inputmode="numeric" value="<?= $escapar($valores['unidades']) ?>">
                <?php if (isset($errores['unidades'])): ?>
                    <span><?= $escapar($errores['unidades']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="fechaAlta">Fecha de alta (YYYY-MM-DD)</label>
                <input type="text" id="fechaAlta" name="fechaAlta" placeholder="YYYY-MM-DD" value="<?= $escapar($valores['fechaAlta']) ?>">
                <?php if (isset($errores['fechaAlta'])): ?>
                    <span><?= $escapar($errores['fechaAlta']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="destacado">Destacado</label>
                <input type="checkbox" id="destacado" name="destacado" value="1" <?= $valores['destacado'] ? 'checked' : '' ?>>
                <?php if (isset($errores['destacado'])): ?>
                    <span><?= $escapar($errores['destacado']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="observaciones">Observaciones</label>
                <textarea id="observaciones" name="observaciones" maxlength="300"><?= $escapar($valores['observaciones']) ?></textarea>
                <?php if (isset($errores['observaciones'])): ?>
                    <span><?= $escapar($errores['observaciones']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="correo">Correo</label>
                <input type="text" id="correo" name="correo" required value="<?= $escapar($valores['correo']) ?>">
                <?php if (isset($errores['correo'])): ?>
                    <span><?= $escapar($errores['correo']) ?></span>
                <?php endif; ?>
            </p>

            <button type="submit">Dar de alta</button>
        </form>

        <p><a href="index.php">Volver al catálogo</a></p>
    <?php endif; ?>
</body>

</html>
