<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Material audiovisual y préstamos</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>

<body>
    <main>
        <header>
            <p class="eyebrow">DWES · UT2 01 · PHP avanzado</p>
            <h1>Material audiovisual y préstamos</h1>
            <p>Consulta el material del taller audiovisual y sus unidades disponibles.</p>
        </header>

        <form class="filters" method="get">
            <label>
                Buscar equipo
                <input name="q" value="<?= e($texto) ?>" placeholder="Prueba CÁMARA u ÓRBITA">
            </label>
            <label>
                Categoría
                <select name="categoria">
                    <option value="">Todas</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= e($cat) ?>" <?= $categoria === $cat ? 'selected' : '' ?>>
                            <?= e($cat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                Orden
                <select name="orden">
                    <option value="nombre" <?= $orden === 'nombre' ? 'selected' : '' ?>>
                        Nombre A–Z
                    </option>
                    <option value="disponibles" <?= $orden === 'disponibles' ? 'selected' : '' ?>>
                        Unidades disponibles de menor a mayor
                    </option>
                </select>
            </label>
            <label class="checkbox">
                <input type="checkbox" name="disponibles" value="1" <?= $soloDisponibles ? 'checked' : '' ?>>
                Solo disponibles
            </label>
            <button>Consultar</button>
            <a href="./public/index.php">Reiniciar</a>
        </form>

        <?php if ($aviso !== null): ?>
            <p class="notice" role="status"><?= e($aviso) ?></p>
        <?php endif; ?>

        <section class="metrics" aria-label="Resumen del listado">
            <div>
                <strong><?= $resumen['cantidad'] ?></strong>
                <span>equipos</span>
            </div>
            <div>
                <strong><?= $resumen['unidades'] ?></strong>
                <span>unidades totales</span>
            </div>
            <div>
                <strong><?= $resumen['prestadas'] ?></strong>
                <span>unidades prestadas</span>
            </div>
            <div>
                <strong><?= $resumen['disponibles'] ?></strong>
                <span>unidades disponibles</span>
            </div>
        </section>

        <p class="checks">
            ¿Hay algún equipo agotado? <strong><?= $resumen['hayAgotados'] ? 'Sí' : 'No' ?></strong> ·
            ¿Todos tienen disponibilidad? <strong><?= $resumen['todosDisponibles'] ? 'Sí' : 'No' ?></strong>
        </p>

        <?php if ($visibles === []): ?>
            <p class="empty">No hay equipos que coincidan con la consulta.</p>
        <?php endif; ?>

        <section class="equipos" aria-label="Equipos">
            <?php foreach ($visibles as $a): ?>
                <article class="equipo" data-id="<?= $a['id'] ?>">
                    <p class="category"><?= e($a['categoria']) ?></p>
                    <h2><?= e(limpiarEspacios($a['nombre'])) ?></h2>
                    <p><?= e(responsableVisible($a['responsable'])) ?></p>
                    <p><?= e($a['codigo']) ?></p>
                    <p>
                        Inicio del nombre:
                        <span class="inicio"><?= e(inicioNombre($a['nombre'])) ?></span>
                    </p>
                    <p class="stock">
                        <?= $a['prestadas'] ?> prestadas · <?= $a['disponibles'] ?> disponibles de <?= $a['unidades'] ?>
                    </p>
                    <a href="/?id=<?= $a['id'] ?>">Ver equipo <?= $a['id'] ?> y sus préstamos</a>
                </article>
            <?php endforeach; ?>
        </section>

        <section class="panel">
            <h2>Consulta de equipo por id</h2>
            <p>La ficha se busca entre todos los equipos, independientemente de los filtros.</p>
            <form method="get" class="filters">
                <label>
                    Id de equipo
                    <input name="id" value="<?= e($id) ?>" placeholder="Prueba 201 o 999">
                </label>
                <button>Ver ficha</button>
            </form>

            <?php if ($seleccionado !== null): ?>
                <article class="ficha">
                    <h3><?= e(limpiarEspacios($seleccionado['nombre'])) ?></h3>
                    <p>
                        <?= e(responsableVisible($seleccionado['responsable'])) ?> ·
                        <?= $seleccionado['disponibles'] ?> unidades disponibles
                    </p>
                    <table>
                        <caption>Préstamos precargados de este equipo</caption>
                        <thead>
                            <tr>
                                <th>Préstamo</th>
                                <th>Unidades</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prestamosFicha as $r): ?>
                                <tr>
                                    <td><?= $r['id'] ?></td>
                                    <td><?= $r['unidades'] ?></td>
                                    <td><?= e($r['estado']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p>Solo los préstamos activos ocupan unidades.</p>
                </article>
            <?php endif; ?>

            <?php if ($avisoFicha !== ''): ?>
                <p class="notice" role="status"><?= e($avisoFicha) ?></p>
            <?php endif; ?>
        </section>

        <section class="panel">
            <h2>Comprobación de códigos de equipo</h2>
            <form class="filters" method="get">
                <label>
                    Código
                    <input name="codigo" value="<?= e($codigo) ?>" placeholder="AV-2026-0201">
                </label>
                <button>Comprobar</button>
            </form>

            <?php if ($validacionCodigo !== null): ?>
                <p class="resultado-codigo" role="status">
                    <?= $validacionCodigo ? 'Código válido' : 'Código no válido' ?>
                </p>
            <?php endif; ?>
        </section>

        <details>
            <summary>Etiquetas del listado</summary>
            <ul>
                <?php foreach ($etiquetas as $etiqueta): ?>
                    <li><?= e($etiqueta) ?></li>
                <?php endforeach; ?>
            </ul>
        </details>

        <footer>Prototipo local · Equipos y préstamos en arrays · PHP 8.5</footer>
    </main>
</body>

</html>