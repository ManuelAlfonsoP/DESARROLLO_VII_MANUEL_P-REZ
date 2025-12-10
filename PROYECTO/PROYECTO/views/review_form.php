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
                    <h2 class="h4 mb-3">Dejar una reseña</h2>
                    <p class="text-muted mb-4">
                        Califique el producto y deje un comentario sobre su experiencia de compra.
                    </p>

                    <form action="index.php?action=create" method="post">
                        <!-- IDs ocultos -->
                        <input type="hidden" name="product_id"
                               value="<?= htmlspecialchars($_GET['product_id'] ?? '') ?>">
                        <input type="hidden" name="user_id"
                               value="<?= htmlspecialchars($_SESSION['user_id'] ?? '') ?>">

                        <!-- Puntuación -->
                        <div class="mb-3">
                            <label class="form-label" for="rating">Puntuación (1 a 5)</label>
                            <input
                                type="number"
                                class="form-control"
                                id="rating"
                                name="rating"
                                min="1"
                                max="5"
                                step="1"
                                placeholder="5"
                                required
                            >
                            <div class="form-text">
                                1 = Muy mala experiencia &nbsp;&middot;&nbsp; 5 = Excelente experiencia
                            </div>
                        </div>

                        <!-- Comentario -->
                        <div class="mb-4">
                            <label class="form-label" for="comment">Comentario</label>
                            <textarea
                                class="form-control"
                                id="comment"
                                name="comment"
                                rows="4"
                                placeholder="Cuéntenos qué le pareció el producto y/o el vendedor..."
                            ></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between flex-wrap gap-2">

                            <button type="submit" class="btn btn-primary">
                                Enviar reseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Pie opcional -->
            <!-- <div class="mt-3 text-muted small text-center">
                Gracias por ayudarnos a mejorar con su opinión.
            </div> -->
        </div>
    </div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require 'layout.php';
?>
