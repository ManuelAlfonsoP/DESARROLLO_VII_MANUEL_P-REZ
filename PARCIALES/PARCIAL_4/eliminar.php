<?php
require_once "database.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = mysqli_real_escape_string($conn, $_POST['id']);


    
    $sql = "DELETE FROM productos WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: index.php");
        } else{
            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
        }
    }
    
    mysqli_stmt_close($stmt);
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Producto a Eliminar<h3>
    <div><label>ID</label>
    <input type="text" name="id" required></div><br>
    <input type="submit" value="Eliminar"> <input type="button" onclick="window.location.href='index.php'"value="Volver a productos">
</form><br>
