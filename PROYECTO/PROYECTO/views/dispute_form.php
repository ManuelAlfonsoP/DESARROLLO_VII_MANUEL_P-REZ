<?php 
require_once __DIR__ . '/../src/config_session.php';
ob_start(); 
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Encabezado -->
                    <h2 class="h4 mb-3">Disputar una devolución</h2>
                    <p class="text-muted mb-4">
                        Explique brevemente el motivo por el cual desea abrir una disputa sobre esta compra.
                    </p>

                    <form action="index.php?action=create" method="post">
                        <!-- IDs ocultos -->
                        <input type="hidden" name="receipt_id"
                               value="<?= htmlspecialchars($_GET['receipt_id'] ?? '') ?>">
                        <input type="hidden" name="user_id"
                               value="<?= htmlspecialchars($_SESSION['user_id'] ?? '') ?>">

                        <!-- Motivo -->
                        <div class="mb-4">
                            <label class="form-label" for="reason">Motivo de la disputa</label>
                            <textarea
                                class="form-control"
                                id="reason"
                                name="reason"
                                rows="4"
                                placeholder="Describa qué ocurrió con el producto, el envío o la atención recibida..."
                                required
                            ></textarea>
                            <div class="form-text">
                                Mientras más detalles proporcione, más fácil será revisar su caso.
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                            <button type="submit" class="btn btn-primary">
                                Enviar disputa
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Opcional: espacio para un enlace de vuelta -->
            <!--
            <div class="mt-3 text-end">
                <a href="../factura/index.php?action=viewbuyer&id=<?= urlencode($_SESSION['user_id'] ?? '') ?>"
                   class="btn btn-outline-secondary btn-sm">
                    Volver al historial de compras
                </a>
            </div>
            -->
        </div>
    </div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require 'layout.php';
?>
