<?php
include 'config_sesion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productos = $_POST['productos'];

    if(!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
// Se toma lo que se recibio del post, y se hace un for each para sacar cada dato de cada producto, ignorando los productos cuya cantidad de compra es de 0,
// y añadiendolos a la sesion si no estaban ya en ella, y si estaban en ella, se les suma la cantidad que se recibio, a la que ya se encontraba en la sesion, 
// a su vez recalculando el total.
    foreach ($productos as $llave => $dato) {
        $id = $dato['id'];
        $nombre = $dato['nombre'];
        $precio = $dato['precio'];
        $cantidad = $dato['cantidad'];
        if($cantidad < 1){
            continue;
        }

        if(isset($_SESSION['carrito'][$id])){
        $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
        $_SESSION['carrito'][$id]['total'] = (int)$_SESSION['carrito'][$id]['cantidad']*(float)$_SESSION['carrito'][$id]['precio'];
        }else{
        $_SESSION['carrito'][$id] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'total' => (int)$cantidad*(int)$precio
        ];
    } 
    }
}
?>
<!-- otro form parecido al anterior, en este caso, el form esta trabajando sobre los datos que se recibieron del form anterior y no de los datos de la sesion
 de modo que solo muestra lo que se añadio al carrito y no todo lo que hay en el carrito. -->
<!DOCTYPE html>
<head>
    <title>Productos Añadidos al carrito</title>
</head>
<body>
<h2>Articulos Añadidos al Carrito:</h2>
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
            if(empty($productos)){
                echo "El carrito esta vacio.";
                
                exit;
            }
            foreach ($productos as $id => $valor): 
                    if($valor['cantidad'] < 1){
                        continue;
                    }?>
                <tr>
                    <td><?= (htmlspecialchars($valor["nombre"])) ?></td>
                    <td><?= (htmlspecialchars("$".$valor["precio"])) ?></td>
                    <td><?= (htmlspecialchars($valor["cantidad"])) ?></td>
                    <td><?= (htmlspecialchars("$".$valor["precio"]*$valor["cantidad"])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <input type="button" onclick="window.location.href='productos.php'" value="Volver a los productos">
    <input type="button" onclick="window.location.href='ver_carrito.php'"value="Ver el carrito">
</body>
</html>