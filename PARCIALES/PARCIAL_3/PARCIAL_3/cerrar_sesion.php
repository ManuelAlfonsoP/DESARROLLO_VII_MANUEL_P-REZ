<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

?>

 <h2>Se ha cerrado sesion correctamente.</h2>

  <input type="button" onclick="window.location.href='Inicio_de_sesion.php'"value="Volver al inicio de sesion.">
