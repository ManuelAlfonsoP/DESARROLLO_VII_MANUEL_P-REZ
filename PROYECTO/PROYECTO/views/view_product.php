<?php
require_once "../config_session.php";
// Iniciamos el buffer de salida
ob_start(); 

require_once BASE_PATH . '../user/userManager.php';
$userManager = new userManager();

// Traemos datos del vendedor una sola vez
$seller = $userManager->getUserById($product['vendedor']);
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Encabezado -->
                    <h2 class="h4 mb-3">
                        Detalles del producto
                    </h2>

                    <!-- Datos del producto -->
                    <div class="mb-4">
                        <h3 class="h5 mb-2">
                            <?= htmlspecialchars($product['nombre']) ?>
                        </h3>
                        <p class="mb-1">
                            <span class="text-muted">ID del producto:</span>
                            <strong>#<?= htmlspecialchars($product['id']) ?></strong>
                        </p>

                        <?php if (!empty($product['precio'])): ?>
                            <p class="mb-1">
                                <span class="text-muted">Precio:</span>
                                <strong>$<?= htmlspecialchars($product['precio']) ?></strong>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($product['inventario'])): ?>
                            <p class="mb-0">
                                <span class="text-muted">Inventario disponible:</span>
                                <strong><?= htmlspecialchars($product['inventario']) ?></strong>
                            </p>
                        <?php endif; ?>
                    </div>

                    <hr>

                    <!-- Datos del vendedor -->
                    <div class="mb-4">
                        <h3 class="h5 mb-3">Datos del vendedor</h3>

                        <?php if ($seller): ?>
                            <p class="mb-1">
                                <span class="text-muted">Nombre:</span>
                                <strong><?= htmlspecialchars($seller['full_name'] ?? $seller['user'] ?? 'N/A') ?></strong>
                            </p>
                            <?php if (!empty($seller['email'])): ?>
                                <p class="mb-1">
                                    <span class="text-muted">Correo:</span>
                                    <strong><?= htmlspecialchars($seller['email']) ?></strong>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($seller['id'])): ?>
                                <p class="mb-0">
                                    <span class="text-muted">ID vendedor:</span>
                                    <strong>#<?= htmlspecialchars($seller['id']) ?></strong>
                                </p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-muted mb-0">
                                No se encontraron datos del vendedor.
                            </p>
                        <?php endif; ?>
                    </div>

                    <hr>

                    <!-- Acciones -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                onclick="window.location.href='index.php'">
                            Volver al catálogo
                        </button>

                        <form method="post"
                              action="../factura/index.php?action=create"
                              class="mb-0 d-inline"
                              onsubmit="return confirm('¿Comprar este producto?');">
                            <input type="hidden" name="product_id"
                                   value="<?= htmlspecialchars($product['id']); ?>">
                            <input type="hidden" name="product_name"
                                   value="<?= htmlspecialchars($product['nombre']); ?>">
                            <input type="hidden" name="buyer"
                                   value="<?= htmlspecialchars($_SESSION['user_id']); ?>">
                            <input type="hidden" name="seller"
                                   value="<?= htmlspecialchars($product['vendedor']); ?>">

                            <button type="submit" class="btn btn-primary">
                                Comprar producto
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Opcional: abajo un pequeño enlace secundario -->
            <div class="mt-3 text-end">
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
