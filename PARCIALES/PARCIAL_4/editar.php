        
<?php
require_once "database.php";

$sql = "SELECT id, nombre, categoria, precio, cantidad, fecha_registro FROM productos";
$result = mysqli_query($conn, $sql);

if($result){
    if(mysqli_num_rows($result) > 0){
        echo "<table border='1' cellpadding='6'>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nombre</th>";
                echo "<th>categoria</th>";
                echo "<th>precio</th>";
                echo "<th>cantidad</th>";
                echo "<th>Fecha de Registro</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>" . $row['fecha_registro'] . "</td>";
            echo "</tr>";
        }
        echo "</table> <br>";
        mysqli_free_result($result);
    } else{
        echo "No se encontraron registros.";
    }
} else{
    echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = mysqli_real_escape_string($conn, $_POST['id']);


    
    $sql = "SELECT * FROM productos WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i",$id);
        
        if(mysqli_stmt_execute($stmt)){
            echo ($id);
        } else{
            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
        }
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Producto a Editar<h3>
    <div><label>ID</label>
    <input type="text" name="id" required></div><br>
    <input type="submit" value="Editar"> <input type="button" onclick="window.location.href='index.php'"value="Volver a productos">
</form><br>
