<?php
// Iniciamos el buffer de salida
ob_start(); 
?>
<div class="task-list">
    <h2>Todas las facturas del sistema</h2>
    <ul>
        <?php foreach ($factura as $f): ?>
            <li>
                <span><?= htmlspecialchars($f['product_name']) ?></span>
                <span><?= htmlspecialchars($f['buyer']) ?></span>
                <span><?= htmlspecialchars($f['seller']) ?></span>
                <div>
                    
                    <a href="index.php?action=view&id=<?= $product['id'] ?>" class="btn">🗑</a>
                    <a href="index.php?action=decrease&id=<?= $product['id'] ?>" class="btn" onclick="return confirm('¿Eliminar esta tarea?')">🗑</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="../user/index.php?action=logout" class="btn">logout</a>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require 'layout.php';
?>