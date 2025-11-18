<?php
include 'config_sesion.php';


if(isset($_SESSION['usuario'])) {
    if($_SESSION['tipo'] == "profesor"){
        header("Location: DashboardProfesor.php");
        exit(); 
    }
}elseif(!isset($_SESSION['usuario'])) {
    header("Location: Inicio_de_Sesion.php");
}

$datosJson = file_get_contents("datos_de_usuarios.json");
$datos = json_decode($datosJson, true);
$datosb = array_filter($datos, function($datos){
    return $datos['user'] == $_SESSION['usuario'];
});


?>
 <!DOCTYPE html>
<html lang="es">
<head>
    <title>ESTUDIANTE</title>
</head>
<body>
<h2>Sus notas:</h2>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Estudiante:</th>
                <th>Nota:</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datosb as $d): ?>
                <tr>
                    <td><?= (htmlspecialchars($d["nombre"])) ?></td>
                    <td><?= (htmlspecialchars($d["calificacion"])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <input type="button" onclick="window.location.href='cerrar_sesion.php'"value="Cerrar Sesion">
</form>
</body>
</html>
