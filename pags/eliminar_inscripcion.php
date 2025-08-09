<?php
require '../app/config/db.php';
$conn = Database::connect();

$id = $_POST['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM inscripcion WHERE ID_Inscripcion = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

$conn->close();
