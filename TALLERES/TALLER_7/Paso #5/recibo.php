<?php
// Aqui se toma lo de la sesion, se limpia por completo y se crea la cookie con el nombre que el usuario dio.
include 'config_sesion.php';
if(empty($_SESSION['carrito'])) {
        echo "El carrito esta vacio.";
        exit();
    }

if(!isset($_SESSION['carrito'])) {
    echo "La sesion no existe.";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(empty($_POST['firma'])){
        echo "Por favor, coloque su nombre.";
        echo "<br><br>".'<button onclick="window.location.href=\'checkout.php\'">Volver al checkout</button>';
        exit();
    }
    $nombre = $_POST['firma'];
    echo "Muchas gracias por su compra, ".$nombre.".<br>";
    unset($_SESSION['carrito']);

    // Configurar una cookie segura
    setcookie("usuario", $nombre, [
    'expires' => time() + 86400,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
}
?>

<!DOCTYPE html>
<head>
    <title>Gracias</title>
</head>
<body>
<br>
<input type="button" onclick="window.location.href='productos.php'" value="Volver a los productos">
</body>
</html>