<?php
require_once __DIR__ . '/../src/config_session.php';
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
                            <h2 class="h4 mb-1">Sus reseñas</h2>
                            <p class="text-muted mb-0">
                                Aquí puede ver las reseñas que ha realizado sobre los productos.
                            </p>
                        </div>
                    </div>

                    <?php if (!empty($reviews)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID Producto</th>
                                        <th>Calificación</th>
                                        <th>Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reviews as $r): ?>
                                        <tr>
                                            <!-- ID del producto -->
                                            <td>
                                                <?= htmlspecialchars($r['product_id']) ?>
                                            </td>

                                            <!-- Rating como número + estrellitas -->
                                            <td>
                                                <?php
                                                    $rating = (int)($r['rating'] ?? 0);
                                                ?>
                                                <span class="fw-semibold">
                                                    <?= $rating ?>/5
                                                </span>
                                                <span class="ms-1 text-warning">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <?= $i < $rating ? '★' : '☆' ?>
                                                    <?php endfor; ?>
                                                </span>
                                            </td>

                                            <!-- Comentario -->
                                            <td style="max-width: 500px;">
                                                <span class="d-block text-wrap">
                                                    <?= nl2br(htmlspecialchars($r['comment'])) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">
                            Aún no ha realizado ninguna reseña.
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Botón volver -->
        </div>
    </div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require 'layout.php';
?>
