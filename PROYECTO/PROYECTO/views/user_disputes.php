<?php
require_once __DIR__ . '/../src/config_session.php';

$userType = $_SESSION['user_type'] ?? 'buyer';

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
                                <?php if ($userType === 'seller'): ?>
                                    Disputas sobre tus ventas
                                <?php elseif ($userType === 'admin'): ?>
                                    Todas las disputas
                                <?php else: ?>
                                    Tus disputas abiertas
                                <?php endif; ?>
                            </h2>
                            <p class="text-muted mb-0">
                                Aquí puedes ver el detalle de las disputas registradas.
                            </p>
                        </div>
                    </div>

                    <?php if (!empty($disputas)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>
                                            <?php if ($userType === 'seller' || $userType === 'admin'): ?>
                                                Comprador
                                            <?php else: ?>
                                                Vendedor
                                            <?php endif; ?>
                                        </th>
                                        <th>Precio</th>
                                        <th>Motivo</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <?php if ($userType === 'admin'): ?>
                                            <th class="text-center">Acciones</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($disputas as $d): ?>
                                        <tr>
                                            <!-- Nombre del producto -->
                                            <td><?= htmlspecialchars($d['product_name']) ?></td>

                                            <!-- Comprador / Vendedor según rol -->
                                            <td>
                                                <?php if ($userType === 'seller' || $userType === 'admin'): ?>
                                                    <?= htmlspecialchars($d['buyer_name']) ?>
                                                <?php else: ?>
                                                    <?= htmlspecialchars($d['seller_name']) ?>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Precio -->
                                            <td>
                                                $<?= htmlspecialchars(number_format((float)($d['product_price'] ?? 0), 2)) ?>
                                            </td>

                                            <!-- Motivo -->
                                            <td><?= htmlspecialchars($d['reason'] ?? '') ?></td>

                                            <!-- Estado con badge -->
                                            <td>
                                                <?php
                                                $status = $d['status'] ?? 'pendiente';
                                                $badgeClass = 'bg-secondary';

                                                if ($status === 'pendiente')  $badgeClass = 'bg-warning text-dark';
                                                if ($status === 'aceptada')   $badgeClass = 'bg-success';
                                                if ($status === 'rechazada')  $badgeClass = 'bg-danger';
                                                ?>
                                                <span class="badge <?= $badgeClass ?>">
                                                    <?= htmlspecialchars(ucfirst($status)) ?>
                                                </span>
                                            </td>

                                            <!-- Fecha -->
                                            <td><?= htmlspecialchars($d['created_at'] ?? '') ?></td>

                                            <!-- Acciones solo para admin -->
                                            <?php if ($userType === 'admin'): ?>
                                                <td class="text-center">
                                                    <a href="index.php?action=detail&id=<?= urlencode($d['id']) ?>"
                                                       class="btn btn-sm btn-outline-primary">
                                                        Ver detalle
                                                    </a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">
                            <?php if ($userType === 'seller'): ?>
                                Aún no tienes disputas sobre tus ventas.
                            <?php elseif ($userType === 'admin'): ?>
                                No hay disputas registradas.
                            <?php else: ?>
                                Aún no has registrado disputas.
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
