<?php
session_start();
require_once '../app/config/db.php';
$conn = Database::connect(); 

$bic   = trim($_POST['bic'] ?? '');
$monto = trim($_POST['monto'] ?? '');
$dia   = trim($_POST['dia'] ?? '');
$mes   = trim($_POST['mes'] ?? '');
$anio  = isset($_POST['anio']) ? trim($_POST['anio']) : (isset($_POST['ano']) ? trim($_POST['ano']) : '');

$errors = [];

if ($bic === '') {
    $errors[] = "BIC es obligatorio.";
}
if ($monto === '' || !is_numeric($monto) || floatval($monto) <= 0) {
    $errors[] = "Monto inválido.";
}
if ($dia === '' || !ctype_digit($dia) || intval($dia) < 1 || intval($dia) > 31) {
    $errors[] = "Día inválido.";
}
if ($mes === '' || !ctype_digit($mes) || intval($mes) < 1 || intval($mes) > 12) {
    $errors[] = "Mes inválido.";
}
if ($anio === '' || !ctype_digit($anio) || intval($anio) < 1900 || intval($anio) > 2100) {
    $errors[] = "Año inválido.";
}

if (!empty($errors)) {
    foreach ($errors as $err) {
        echo htmlspecialchars($err) . "<br>";
    }
    exit;
}

$montoFloat = floatval($monto);
$diaInt = intval($dia);
$mesInt = intval($mes);
$anioInt = intval($anio);

$sql = "INSERT INTO pago (`BIC`, `monto`, `dia`, `mes`, `anio`) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error en la preparación: " . htmlspecialchars($conn->error);
    exit;
}

$stmt->bind_param("sdiii", $bic, $montoFloat, $diaInt, $mesInt, $anioInt);

if ($stmt->execute()) {
    header("Location: pago_exito.php");
    exit;
} else {
    echo "Error al guardar el pago: " . htmlspecialchars($stmt->error);
    exit;
}
