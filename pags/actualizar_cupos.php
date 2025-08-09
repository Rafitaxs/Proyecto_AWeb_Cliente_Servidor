<?php
require '../app/config/db.php';
$conn = Database::connect();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sede = $_POST['sede'] ?? '';
    $max_cupos = isset($_POST['max_cupos']) ? intval($_POST['max_cupos']) : null;
    $cupos_disponibles = isset($_POST['cupos_disponibles']) ? intval($_POST['cupos_disponibles']) : null;

    if (!$sede || $max_cupos === null || $cupos_disponibles === null) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios']);
        exit;
    }

    if ($max_cupos < 1 || $cupos_disponibles < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Valores inválidos para cupos']);
        exit;
    }

    if ($cupos_disponibles > $max_cupos) {
        echo json_encode(['status' => 'error', 'message' => 'Los cupos disponibles no pueden ser mayores que el máximo de cupos']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE cupos_sede SET max_cupos = ?, cupos_disponibles = ? WHERE sede = ?");
    $stmt->bind_param("iis", $max_cupos, $cupos_disponibles, $sede);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Cupos actualizados correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar los cupos']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}

$conn->close();
?>
