<?php
require_once __DIR__ . '/../src/config_session.php';

// Tipo de usuario desde la sesión
$userType = $_SESSION['user_type'] ?? 'buyer'; // valor por defecto buyer
$isBuyer  = $userType === 'buyer';

// Iniciamos el buffer de salida
ob_start();
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Encabezado -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                        <div>
                            <h2 class="h4 mb-1">
                                <?= $isBuyer ? 'Historial de compras' : 'Historial de ventas' ?>
                            </h2>
                            <p class="text-muted mb-0">
                                <?php if ($isBuyer): ?>
                                    Aquí puedes ver todas las compras realizadas con tu cuenta.
                                <?php else: ?>
                                    Aquí puedes ver todos los productos que has vendido.
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <?php if (!empty($factura)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <!-- Columna dinámica: Vendedor / Comprador -->
                                        <th><?= $isBuyer ? 'Vendedor' : 'Comprador' ?></th>

                                        <?php if ($isBuyer): ?>
                                            <th class="text-center">Acciones</th>
                                        <?php else: ?>
                                            <th class="text-center">Fecha</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($factura as $f): ?>
                                        <tr>
                                            <!-- Nombre del producto -->
                                            <td><?= htmlspecialchars($f['product_name']) ?></td>

                                            <!-- Precio -->
                                            <td>
                                                $<?= htmlspecialchars(number_format($f['product_price'], 2)) ?>
                                            </td>

                                            <!-- Nombre de la otra parte -->
                                            <td>
                                                <?php if ($isBuyer): ?>
                                                    <?= htmlspecialchars($f['seller_name']) ?>
                                                <?php else: ?>
                                                    <?= htmlspecialchars($f['buyer_name']) ?>
                                                <?php endif; ?>
                                            </td>

                                            <?php if ($isBuyer): ?>
                                                <!-- Acciones solo para comprador -->
                                                <td class="text-center">
                                                    <!-- Review: usa el product_id -->
                                                    <a href="../review/index.php?action=create&product_id=<?= urlencode($f['product_id']) ?>"
                                                       class="btn btn-sm btn-primary me-2">
                                                        Review
                                                    </a>

                                                    <!-- Dispute: usa el id de la factura -->
                                                    <a href="../disputa/index.php?action=create&receipt_id=<?= urlencode($f['id']) ?>"
                                                       class="btn btn-sm btn-outline-danger"
                                                       onclick="return confirm('¿Abrir disputa para esta compra?');">
                                                        Dispute
                                                    </a>
                                                </td>
                                            <?php else: ?>
                                                <!-- Para el vendedor, solo mostramos la fecha de la venta -->
                                                <td class="text-center">
                                                    <?= htmlspecialchars($f['created_at']) ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">
                            <?php if ($isBuyer): ?>
                                Aún no tienes compras registradas.
                            <?php else: ?>
                                Aún no has realizado ventas.
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                </div>
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
