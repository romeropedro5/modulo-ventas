<?php
require '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM ventas WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;