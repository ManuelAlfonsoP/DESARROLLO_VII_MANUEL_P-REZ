<?php
$productos = [
"Jabon" => 12.5,
"Pan" => 4.0,
"Leche" => 3.50,
"Cereales" => 2.50,
"Arroz" => 1.75];
?>
<h2>Articulos Disponibles:</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Al carrito</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $llave => $valor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($llave); ?></td>
                    <td><?php echo htmlspecialchars($valor); ?></td>
                    <td><input type="number" min="1" max="10"></td>
                    <td><button type="button" >Añadir</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
