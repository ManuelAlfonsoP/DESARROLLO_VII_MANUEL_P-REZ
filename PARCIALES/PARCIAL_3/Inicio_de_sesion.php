<?php
include 'config_sesion.php';

// Los datos vienen de un json, que actua como base de datos.
$datosJson = file_get_contents("datos_de_usuarios.json");
$datos = json_decode($datosJson, true);
// Si ya hay una sesión activa, redirigir al panel correspondiente
if(isset($_SESSION['usuario'])) {
    if($_SESSION['tipo'] == "profesor"){
        header("Location: DashboardProfesor.php");
        exit();
    }elseif($_SESSION['tipo'] == "estudiante"){
        header("Location: DashboardEstudiante.php");
        exit();
    }
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = "";
    $usuario = (htmlspecialchars($_POST['usuario']));
    $contrasena = (htmlspecialchars($_POST['contrasena']));

    if(strlen($usuario) < 3){
        $error = "El usuario debe ser de por lo menos 3 caracteres. ";
    }elseif(strlen($contrasena) < 5){
        $error = $error. " La contraseña debe ser de por lo menos 5 caracteres.";
    }
    echo($error);

    foreach($datos as $d){
    if($usuario == $d['user'] && $contrasena == $d['contraseña']){
        $_SESSION['usuario'] = $d['user'];
        $_SESSION['nombre'] = $d['nombre'];
        $_SESSION['tipo'] = $d['tipo'];

        if($d['tipo'] == "profesor"){
            header("Location: DashboardProfesor.php");
        }else{
            header("Location: DashboardEstudiante.php");
        }
        exit();
        }else{
            $error = "Usuario o contraseña incorrectos";
        }
    }
    echo($error);
}

?>
<!--formulario HTML -->
 <h2>Login</h2>
<form method="post" action="">
    <label for="usuario">Usuario:</label><br>
    <input type="text" id="usuario" name="usuario" required pattern="[a-zA-Z0-9]+" ><br><br>
    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" required><br><br>
    <input type="submit" value="Iniciar Sesión">
</form>