<?php 
// Iniciamos el buffer de salida
ob_start(); 
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 col-xl-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <!-- Título -->
                    <h2 class="h4 mb-1">
                        Registrar cuenta de usuario
                    </h2>
                    <p class="text-muted mb-4">
                        Crea tu cuenta como comprador o vendedor para poder usar la plataforma.
                    </p>

                    <!-- Formulario -->
                    <form action="index.php?action=register" method="post">
                        <!-- Usuario -->
                        <div class="mb-3">
                            <label class="form-label" for="user">
                                Usuario
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="user" 
                                name="user" 
                                required
                                placeholder="Ej: mperez123"
                            >
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label class="form-label" for="password">
                                Contraseña
                            </label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password" 
                                required
                            >
                        </div>

                        <!-- Nombre completo -->
                        <div class="mb-3">
                            <label class="form-label" for="full_name">
                                Nombre completo
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="full_name" 
                                name="full_name" 
                                required
                                placeholder="Ej: Manuel Pérez"
                            >
                        </div>

                        <!-- Tipo de cuenta -->
                        <div class="mb-4">
                            <label class="form-label" for="user_type">
                                Tipo de cuenta
                            </label>
                            <select 
                                class="form-select" 
                                id="user_type" 
                                name="user_type" 
                                required
                            >
                                <option value="">-- Seleccione un tipo --</option>
                                <option value="buyer">Comprador</option>
                                <option value="seller">Vendedor</option>
                            </select>
                        </div>

                        <!-- Botón -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <a href="index.php" class="btn btn-outline-secondary">
                                Volver
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Registrarse
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Texto secundario opcional -->
            <div class="mt-3 text-center">
                <small class="text-muted">
                    ¿Ya tienes una cuenta? 
                    <a href="index.php" class="text-decoration-none">Inicia sesión</a>
                </small>
            </div>
        </div>
    </div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require 'layout.php';
?>
