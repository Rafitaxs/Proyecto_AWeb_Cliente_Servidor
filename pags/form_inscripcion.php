<?php
require '../app/config/db.php';
session_start();
$conn = Database::connect();

// Cargar sedes para el <select>
$sedes = [];
$respuesta = $conn->query("SELECT ID, Provincia FROM sede ORDER BY Provincia");
while ($fila = $respuesta->fetch_assoc()) {
    $sedes[] = $fila;
}

// Inicializar variables
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$nombre = $apellido = $tipoLicencia = "";
$cedula = 0;
$sedeID = null; // MUY IMPORTANTE para evitar "Undefined variable"

// Si es edición, precargar datos
if ($id) {
    $stmt = $conn->prepare("SELECT ID_Inscripcion, Nombre, Apellido, Cedula, TipoLicencia, SedeID FROM inscripcion WHERE ID_Inscripcion = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();

    if ($resultado) {
        $nombre = $resultado['Nombre'];
        $apellido = $resultado['Apellido'];
        $cedula = (int) $resultado['Cedula'];
        $tipoLicencia = $resultado['TipoLicencia'];
        $sedeID = isset($resultado['SedeID']) ? (int) $resultado['SedeID'] : null;
    }
}

// Guardar (crear/actualizar)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Entradas
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $cedula = (int) ($_POST['cedula'] ?? 0);
    $tipoLicencia = strtoupper(trim($_POST['tipoLicencia'] ?? ''));
    $sedeID = isset($_POST['sede_id']) && $_POST['sede_id'] !== '' ? (int) $_POST['sede_id'] : null;

    // Validaciones mínimas
    if ($nombre === '' || $apellido === '' || !$cedula || $tipoLicencia === '' || $sedeID === null) {
        die('Faltan datos del formulario (incluida la sede).');
    }

    // Validar FK: que la sede exista
    $v = $conn->prepare("SELECT 1 FROM sede WHERE ID=?");
    $v->bind_param("i", $sedeID);
    $v->execute();
    if (!$v->get_result()->fetch_row()) {
        die('La sede seleccionada no existe.');
    }

    if ($id) {
        // UPDATE con SedeID
        $stmt = $conn->prepare("
            UPDATE inscripcion
               SET Nombre=?, Apellido=?, Cedula=?, TipoLicencia=?, SedeID=?
             WHERE ID_Inscripcion=?");
        // ssisii -> Nombre(s), Apellido(s), Cedula(i), TipoLicencia(s), SedeID(i), ID(i)
        $stmt->bind_param("ssisii", $nombre, $apellido, $cedula, $tipoLicencia, $sedeID, $id);
    } else {
        // INSERT con SedeID
        $stmt = $conn->prepare("
            INSERT INTO inscripcion (Nombre, Apellido, Cedula, TipoLicencia, SedeID)
            VALUES (?, ?, ?, ?, ?)");
        // ssisi -> Nombre(s), Apellido(s), Cedula(i), TipoLicencia(s), SedeID(i)
        $stmt->bind_param("ssisi", $nombre, $apellido, $cedula, $tipoLicencia, $sedeID);
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

        <label for="sede_id">Sede:</label>
        <select name="sede_id" id="sede_id" required>
            <option value="">-- Seleccione la sede --</option>
            <?php foreach ($sedes as $s): ?>
                <option value="<?= $s['ID'] ?>" <?= ($s['ID'] == $sedeID) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['Provincia']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <button type="submit">Guardar</button>
        <a href="inscripciones.php">Cancelar</a>
    </form>
</body>

</html>