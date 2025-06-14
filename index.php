<?php
require '../config/db.php';
include '../includes/header.php';

$stmt = $pdo->query("SELECT v.id, p.nombre AS producto, v.cantidad, v.precio, v.fecha 
                     FROM ventas v 
                     JOIN productos p ON v.producto_id = p.id 
                     ORDER BY v.fecha DESC");
$ventas = $stmt->fetchAll();
?>

<h2>Ventas Registradas</h2>
<a href="agregar.php">Registrar nueva venta</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($ventas as $venta): ?>
        <tr>
            <td><?= $venta['id'] ?></td>
            <td><?= $venta['producto'] ?></td>
            <td><?= $venta['cantidad'] ?></td>
            <td>$<?= number_format($venta['precio'], 2) ?></td>
            <td><?= $venta['fecha'] ?></td>
            <td><a href="eliminar.php?id=<?= $venta['id'] ?>" onclick="return confirm('¿Eliminar esta venta?')">Eliminar</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>