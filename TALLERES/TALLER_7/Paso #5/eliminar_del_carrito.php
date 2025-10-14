<?php
// Esto recibe lo del form de ver_carrito, el cual le envia los ids y la cantidad de articulos que se quiere eliminar referente a cada id, estos se restan
// del total de ese articulo de la sesion, o se eliminan por completo de la sesion, en caso de que el usuario asi lo desee.
include 'config_sesion.php';

if(empty($_SESSION['carrito'])) {
        echo "El carrito esta vacio.";
        echo "<br><br>".'<button onclick="window.location.href=\'productos.php\'">Volver a los productos</button>';
        exit();
    }

if(!isset($_SESSION['carrito'])) {
    echo "La sesion no existe.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productos = $_POST['productos'];
    foreach($productos as $llave => $dato){
        $cantidadenCarrito = $_SESSION['carrito'][$llave]['cantidad'];
        if($dato['cantidad'] < $cantidadenCarrito){
            $_SESSION['carrito'][$llave]['cantidad'] -= $dato['cantidad'];
        }elseif($dato['cantidad'] = $cantidadenCarrito){
            unset($_SESSION['carrito'][$llave]);
        }
    }
    echo "Accion realizada con exito.";
    echo "<br><br>".'<button onclick="window.location.href=\'ver_carrito.php\'">Volver al carrito</button>';

    
}

?>