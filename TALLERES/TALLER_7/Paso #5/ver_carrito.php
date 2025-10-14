<?php
include 'config_sesion.php';
    if(!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

?>
<!-- Este es otro cuadro form mas, en este caso toma los datos de la sesion para mostrar todos los articulos del carrito -->
<!DOCTYPE html>
<head>
    <title>Carrito de compras</title>
</head>
<body>
<h2>Articulos del Carrito:</h2>
<form action="eliminar_del_carrito.php" method="POST">
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Eliminar #</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalcompra = 0;
            foreach ($_SESSION['carrito'] as $id => $valor): 
                    if($valor['cantidad'] < 1){
                        continue;
                    }
                    $totalcompra += (float)$valor["precio"]*(int)$valor["cantidad"];
            ?>
                <tr>
                    <td><?= (htmlspecialchars($valor["nombre"])) ?></td>
                    <td><?= (htmlspecialchars("$".$valor["precio"])) ?></td>
                    <td><?= (htmlspecialchars($valor["cantidad"])) ?></td>
                    <td><?= (htmlspecialchars("$".$valor["precio"]*$valor["cantidad"])) ?></td>
                    <td><input type="number" name="productos[<?=htmlspecialchars($id) ?>][cantidad]" min="0" max="<?= $valor["cantidad"]?>" value="0">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <h3>Total de la compra: <?php echo "$".$totalcompra ?></h3>
    <input type="button" onclick="window.location.href='productos.php'" value="Volver a los productos">
    <input type="submit" value="Eliminar Articulos">
    <input type="button" onclick="window.location.href='checkout.php'" value="Realizar el pago">
</form>



</body>
</html>