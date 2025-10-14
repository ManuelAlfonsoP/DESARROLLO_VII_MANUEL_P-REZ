<?php
// Los datos vienen de un json, que actua como base de datos.
$datosJson = file_get_contents("productos.json");
$productos = json_decode($datosJson, true);
?>
<!-- Aqui se crea una tabla que tambien sirve de formulario, la cual toma el dato de cantidad que se quiere comprar de un articulo, y tambien lleva, para el post
 3 datos ocultos, que son el nombre, precio y id de cada articulo, estos se envian por post a agregar_al_carrito. -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Catálogo de productos</title>
</head>
<body>
<h2>Artículos Disponibles:</h2>
<form action="agregar_al_carrito.php" method="POST">
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $id => $valor): ?>
                <tr>
                    <td><?= (htmlspecialchars($valor["nombre"])) ?></td>
                    <td><?= (htmlspecialchars("$".$valor["precio"])) ?></td>
                    <td>
                        <input type="number" name="productos[<?=htmlspecialchars($id) ?>][cantidad]" min="0" max="10" value="0">
                        <input type="hidden" name="productos[<?=htmlspecialchars($id) ?>][nombre]" value="<?=($valor['nombre']) ?>">
                        <input type="hidden" name="productos[<?=htmlspecialchars($id) ?>][precio]" value="<?=($valor['precio']) ?>">
                        <input type="hidden" name="productos[<?=htmlspecialchars($id) ?>][id]" value="<?=($valor['id']) ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <!-- Aqui se añaden dos botones, uno para enviar la form y otro para ver el carrito. -->
    <input type="submit" value="Añadir al carrito">
    <input type="button" onclick="window.location.href='ver_carrito.php'"value="Ver el carrito">
</form>
</body>
</html>
