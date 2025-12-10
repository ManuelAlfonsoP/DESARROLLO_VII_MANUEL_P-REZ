<?php 
// Iniciamos el buffer de salida
ob_start(); 
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="h4 text-center mb-4">Inicio de sesión</h2>

                    <form action="index.php?action=login" method="post" novalidate>
                        <!-- Usuario -->
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input
                                type="text"
                                id="usuario"
                                name="user"
                                class="form-control"
                                required
                                pattern="[a-zA-Z0-9]+"
                                minlength="3"
                                placeholder="Ingresa tu usuario"
                            >
                            <div class="form-text">
                                Solo letras y números, mínimo 3 caracteres.
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input
                                type="password"
                                id="contrasena"
                                name="password"
                                class="form-control"
                                required
                                placeholder="Ingresa tu contraseña"
                            >
                        </div>

                        <!-- Botón Login -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Iniciar sesión
                            </button>
                        </div>

                        <!-- Link registro -->
                        <p class="text-center mb-0">
                            ¿No tienes cuenta?
                            <a href="index.php?action=register" class="fw-medium">
                                Regístrate aquí
                            </a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Opcional: texto pequeño debajo -->
            <p class="text-center text-muted mt-3 fs-sm">
                Accede con tus credenciales para continuar.
            </p>
        </div>
    </div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require 'layout.php';
?>