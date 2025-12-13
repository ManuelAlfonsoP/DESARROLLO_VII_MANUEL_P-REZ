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
        echo "<input type='button' value='Añadir producto' onclick=\"window.location.href='crear.php'\">";
        echo "<input type='button' value='Editar producto' onclick=\"window.location.href='editar.php'\">";
        echo "<input type='button' value='Eliminar producto' onclick=\"window.location.href='eliminar.php'\">";
        mysqli_free_result($result);
    } else{
        echo "No se encontraron registros.";
    }
} else{
    echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
?>
        