<?php
require '../config/db.php';
include '../includes/header.php';

// Obtener productos para la venta
$productos = $pdo->query("SELECT * FROM productos")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    $stmt = $pdo->prepare("INSERT INTO ventas (producto_id, cantidad, precio, fecha) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$producto_id, $cantidad, $precio]);

    header("Location: index.php");
    exit;
}
?>

<h2>Registrar Venta</h2>
<form method="POST">
    <label>Producto:</label>
    <select name="producto_id" required>
        <option value="">Seleccione un producto</option>
        <?php foreach ($productos as $producto): ?>
            <option value="<?= $producto['id'] ?>"><?= $producto['nombre'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <label>Cantidad: <input type="number" name="cantidad" required></label><br><br>
    <label>Precio: <input type="number" name="precio" step="0.01" required></label><br><br>
    <button type="submit">Guardar Venta</button>
</form>

<?php include '../includes/footer.php'; ?>