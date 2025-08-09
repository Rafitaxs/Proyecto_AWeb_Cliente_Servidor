<?php
include '../app/config/db.php';

if (isset($_POST['id']) && isset($_POST['accion'])) {
    $conn = Database::connect();

    $id = intval($_POST['id']);
    $accion = $_POST['accion'];

    if ($accion === 'confirmar') {
        $estado = 'Confirmado';
    } elseif ($accion === 'rechazar') {
        $estado = 'Rechazado';
    } else {
        $estado = 'Pendiente';
    }

    $sql = "UPDATE inscripcion SET Estado = ? WHERE ID_Inscripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $estado, $id);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
