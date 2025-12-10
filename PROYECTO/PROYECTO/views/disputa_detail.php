<?php
require_once __DIR__ . '/../src/config_session.php';
ob_start();
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Detalle de disputa #<?= htmlspecialchars($disputa['id']) ?></h2>

                    <div class="mb-3">
                        <h5 class="mb-2">Información del producto</h5>
                        <p class="mb-1"><span class="text-muted">Producto:</span>
                            <strong><?= htmlspecialchars($disputa['product_name']) ?></strong>
                        </p>
                        <p class="mb-1"><span class="text-muted">Precio:</span>
                            <strong>$<?= htmlspecialchars(number_format((float)($disputa['product_price'] ?? 0), 2)) ?></strong>
                        </p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <h5 class="mb-2">Partes involucradas</h5>
                        <p class="mb-1"><span class="text-muted">Comprador:</span>
                            <strong><?= htmlspecialchars($disputa['buyer_name']) ?></strong>
                        </p>
                        <p class="mb-1"><span class="text-muted">Vendedor:</span>
                            <strong><?= htmlspecialchars($disputa['seller_name']) ?></strong>
                        </p>
                        <p class="mb-0"><span class="text-muted">ID recibo:</span>
                            <strong>#<?= htmlspecialchars($disputa['receipt_id']) ?></strong>
                        </p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <h5 class="mb-2">Motivo de la disputa</h5>
                        <p class="mb-0"><?= nl2br(htmlspecialchars($disputa['reason'] ?? '')) ?></p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <h5 class="mb-2">Estado actual</h5>
                        <?php
                        $status = $disputa['status'] ?? 'pendiente';
                        $badgeClass = 'bg-secondary';
                        if ($status === 'pendiente')  $badgeClass = 'bg-warning text-dark';
                        if ($status === 'aceptada')   $badgeClass = 'bg-success';
                        if ($status === 'rechazada')  $badgeClass = 'bg-danger';
                        ?>
                        <span class="badge <?= $badgeClass ?>">
                            <?= htmlspecialchars(ucfirst($status)) ?>
                        </span>
                    </div>

                    <!-- Formulario para aceptar / rechazar -->
                    <form method="post"
                          action="index.php?action=detail&id=<?= htmlspecialchars($disputa['id']) ?>"
                          class="d-flex flex-wrap gap-2">
                        <button type="submit"
                                name="decision"
                                value="aceptada"
                                class="btn btn-success"
                                onclick="return confirm('¿Aceptar esta disputa?');">
                            Aceptar disputa
                        </button>
                        <button type="submit"
                                name="decision"
                                value="rechazada"
                                class="btn btn-danger"
                                onclick="return confirm('¿Rechazar esta disputa?');">
                            Rechazar disputa
                        </button>
                        <a href="index.php?action=admin" class="btn btn-outline-secondary ms-auto">
                            Volver al listado
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require 'layout.php';
?>
