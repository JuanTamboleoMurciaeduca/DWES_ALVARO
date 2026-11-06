<?php
use function App\Soporte\e;
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Catálogo del inventario</title></head>
<body>
<h1>Catálogo del inventario</h1>
<p><a href="alta.php">Dar de alta un material</a></p>
<!-- Bloque de errores proporcionado. Cada entrada identifica el campo y su mensaje. -->
<?php if ($errores !== []): ?>
    <ul role="alert">
        <?php foreach ($errores as $campo => $mensaje): ?>
            <li><?= e($campo) ?>: <?= e($mensaje) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<!-- COMPLETAR 1. Formulario GET con controles HTML estáticos. -->
<form method="get" action="../public/index.php">
    <label for="q">Nombre o fabricante</label>
    <input type="text" id="q" name="q">

    <label for="categoria">Categoria</label>
    <select name="categoria" id="categoria">
        <option value="">Todas</option>
        <option value="colectivo">Colectivo</option>
        <option value="raqueta">Raqueta</option>
        <option value="fitness">Fitness</option>
    </select>

    <button type="submit">Buscar</button>
</form>

<?php if ($errores === []): ?>
    <!-- COMPLETAR 3. Tabla de materiales o mensaje si no hay coincidencias. -->
     <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fabricante</th>
                <th>Unidades</th>
                <th>Categoria</th>
                <th>Fecha de alta</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><? ?></td>
                <td><? ?></td>

                
            </tr>
        </tbody>
     </table>
<?php endif; ?>
<p><a href="index.php">Limpiar filtros</a></p>
</body>
</html>
