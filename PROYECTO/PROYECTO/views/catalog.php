<?php
require_once "../config_session.php";
// Iniciamos el buffer de salida
ob_start();

$isSeller = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'seller';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">Catálogo de productos</h2>
                <?php if ($isSeller): ?>
                <a href="index.php?action=create" class="btn btn-primary">
                    + Nuevo producto
                </a>
                <?php endif; ?>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <?php if (!empty($products)): ?>
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Inventario</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($product['nombre']) ?></td>
                                            <td>$<?= htmlspecialchars($product['precio']) ?></td>
                                            <td><?= htmlspecialchars($product['inventario']) ?></td>
                                            <td class="text-end">
                                                <!-- Ver / Detalle -->
                                                <a href="index.php?action=view&id=<?= $product['id'] ?>"
                                                   class="btn btn-sm btn-outline-secondary">
                                                    Ver
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="p-4 text-center text-muted">
                            No hay productos registrados todavía.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
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
