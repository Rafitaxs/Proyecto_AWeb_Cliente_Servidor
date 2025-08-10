<?php
require '../app/config/db.php';
session_start();
$conn = Database::connect();

$id = $_GET['id'] ?? null;
$nombre = $apellido = $cedula = $tipoLicencia = "";

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM inscripcion WHERE ID_Inscripcion = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    $nombre = $resultado['Nombre'];
    $apellido = $resultado['Apellido'];
    $cedula = $resultado['Cedula'];
    $tipoLicencia = $resultado['TipoLicencia'];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $tipoLicencia = $_POST['tipoLicencia'];

    if ($id) {
        $stmt = $conn->prepare("UPDATE inscripcion SET Nombre=?, Apellido=?, Cedula=?, TipoLicencia=? WHERE ID_Inscripcion=?");
        $stmt->bind_param("ssssi", $nombre, $apellido, $cedula, $tipoLicencia, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO inscripcion (Nombre, Apellido, Cedula, TipoLicencia) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $cedula, $tipoLicencia);
    }
    $stmt->execute();
    header("Location: inscripciones.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../assets/css/inscripciones.css">
    <meta charset="UTF-8">
    <title><?= $id ? 'Modificar' : 'Agregar' ?> Inscripción</title>
</head>

<body>
    <h2><?= $id ? 'Modificar' : 'Agregar' ?> Inscripción</h2>
    <form method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= htmlspecialchars($apellido) ?>" required><br>

        <label>Cédula:</label>
        <input type="text" name="cedula" value="<?= htmlspecialchars($cedula) ?>" required><br>

        <label>Tipo Licencia:</label>
        <input type="text" name="tipoLicencia" value="<?= htmlspecialchars($tipoLicencia) ?>" required><br>

        <button type="submit">Guardar</button>
        <a href="inscripciones.php">Cancelar</a>
    </form>
</body>

</html>