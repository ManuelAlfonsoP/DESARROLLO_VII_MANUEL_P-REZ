<?php
include 'config_sesion.php';
// Esto toma lo de la sesion, y lo muestra como un cuadro con todos los articulos que habia en el carrito, tambien pide la firma del usuario que luego es lo que se 
// utiliza para crear la cookie que se almacena por 24 horas
if(empty($_SESSION['carrito'])) {
        echo "El carrito esta vacio.";
        echo "<br><br>".'<button onclick="window.location.href=\'productos.php\'">Volver a los productos</button>';
        exit();
    }

if(!isset($_SESSION['carrito'])) {
    echo "La sesion no existe.";
    exit();
}

?>

<!DOCTYPE html>
<head>
    <title>Checkout</title>
</head>
<body>
<h2>Resumen de la compra:</h2>
<form action="recibo.php" method="POST">
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
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
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table><br>
    <label for="firma">Firma del usuario:</label>
    <input type="text" name="firma" name="firma" >
    <br>
    <h3>Total de la compra: <?php echo "$".$totalcompra ?></h3>
    <input type="button" onclick="window.location.href='productos.php'" value="Volver a los productos">
    <input type="submit" value="Finalizar Pago">
</form>



</body>
</html>