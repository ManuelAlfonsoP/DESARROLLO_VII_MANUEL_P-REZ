<?php 
require_once "../config_session.php";

if (
    !isset($_SESSION['user_id']) || 
    !isset($_SESSION['user_type']) || 
    $_SESSION['user_type'] !== 'seller'
) {
    header("Location: ../user/index.php");
    exit;
}

// Iniciamos el buffer de salida
ob_start(); 
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <!-- Título -->
                    <h2 class="h4 mb-1">
                        Añadir nuevo producto
                    </h2>
                    <p class="text-muted mb-4">
                        Completa los datos para publicar tu producto en el catálogo.
                    </p>

                    <!-- Formulario -->
                    <form action="index.php?action=create" method="post">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label" for="nombre">
                                Nombre del producto
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="nombre" 
                                name="nombre" 
                                placeholder="Ej: Audífonos inalámbricos"
                                required
                            >
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label class="form-label" for="precio">
                                Precio
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input 
                                    type="number" 
                                    step="0.01" 
                                    class="form-control" 
                                    id="precio" 
                                    name="precio" 
                                    placeholder="00.00"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Inventario -->
                        <div class="mb-3">
                            <label class="form-label" for="inventario">
                                Inventario disponible
                            </label>
                            <input 
                                type="number" 
                                step="1" 
                                class="form-control" 
                                id="inventario" 
                                name="inventario" 
                                placeholder="Ej: 10"
                                required
                            >
                        </div>

                        <!-- Id vendedor (oculto) -->
                        <input 
                            type="hidden" 
                            name="vendedor" 
                            value="<?= htmlspecialchars($_SESSION['user_id']) ?>"
                        >

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label class="form-label" for="description">
                                Descripción del producto
                            </label>
                            <textarea 
                                class="form-control" 
                                id="description" 
                                name="description" 
                                rows="4" 
                                placeholder="Describe tu producto, características, estado, etc."
                                required
                            ></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex flex-wrap justify-content-between gap-2">
                            <button 
                                type="button" 
                                class="btn btn-outline-secondary"
                                onclick="window.location.href='index.php'">
                                Volver al catálogo
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Publicar producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Enlace secundario bajo la tarjeta (opcional) -->
            <div class="mt-3 text-center text-md-start">
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
