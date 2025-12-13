<?php
require_once "database.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);


    
    $sql = "INSERT INTO productos (nombre, categoria, precio, cantidad) VALUES (?, ?, ?, ?)";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssdi", $nombre, $categoria, $precio, $cantidad);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: index.php");
        } else{
            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
        }
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Añadir datos del producto<h3>
    <div><label>Nombre</label>
    <input type="text" name="nombre" required></div>
    <div><label>Categoria</label>
    <input type="text" name="categoria" required></div>
    <div><label>Precio</label>
    <input type="text" name="precio" required></div>
    <div><label>Cantidad</label>
    <input type="text" name="cantidad" required></div>
    <input type="submit" value="Añadir Producto">
</form>
<input type="button" onclick="window.location.href='index.php'"value="Volver a productos">