<?php
include '../app/config/db.php';
$conn = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $accion = $_POST['accion'];

    if ($accion === 'confirmar') {
        $sql = "UPDATE citas SET estado = 'confirmado' WHERE id = ?";
    } elseif ($accion === 'rechazar') {
        $sql = "UPDATE citas SET estado = 'rechazado' WHERE id = ?";
    } else {
        header("Location: verCitas.php");
        exit();
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: verCitas.php");
exit();
