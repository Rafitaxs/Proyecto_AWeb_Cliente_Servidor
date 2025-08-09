<?php
require '../app/config/db.php';
$conn = Database::connect();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sede = $_POST['sede'] ?? '';
    $fecha = $_POST['fecha_inscripcion'] ?? '';

    if (!$nombre || !$email || !$sede || !$fecha) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios']);
        exit;
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM citas WHERE email = ? AND fecha_inscripcion = ?");
    $stmt->bind_param("ss", $email, $fecha);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Ya tienes una cita agendada para esa fecha.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT cupos_disponibles FROM cupos_sede WHERE sede = ?");
    $stmt->bind_param("s", $sede);
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Error al verificar cupos disponibles']);
        exit;
    }
    $stmt->bind_result($cupos_disponibles);
    $stmt->fetch();
    $stmt->close();

    if ($cupos_disponibles === null) {
        echo json_encode(['status' => 'error', 'message' => 'Sede no válida']);
        exit;
    }

    if ($cupos_disponibles <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'No hay cupos disponibles para esta sede']);
        exit;
    }

    $estado = 'Pendiente';
    $stmt = $conn->prepare("INSERT INTO citas (nombre, email, sede, fecha_inscripcion, estado) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $email, $sede, $fecha, $estado);

    if ($stmt->execute()) {
        $stmt->close();

        $stmt2 = $conn->prepare("UPDATE cupos_sede SET cupos_disponibles = cupos_disponibles - 1 WHERE sede = ?");
        $stmt2->bind_param("s", $sede);
        $stmt2->execute();
        $stmt2->close();

        echo json_encode(['status' => 'success', 'message' => 'Cita agendada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al agendar la cita']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}

$conn->close();
