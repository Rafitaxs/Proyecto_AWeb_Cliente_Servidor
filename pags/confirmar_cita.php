<?php
$nombre = htmlspecialchars($_POST['nombre']);
$email = htmlspecialchars($_POST['email']);
$sede = htmlspecialchars($_POST['sede']);
$fecha = htmlspecialchars($_POST['fecha_inscripcion']);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
    <link rel="stylesheet" href="../assets/css/citas.css">
</head>
<body>
    <main style="max-width: 600px; margin: auto; padding: 20px;">
        <h1>✅ Cita agendada con éxito</h1>
        <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
        <p><strong>Correo:</strong> <?php echo $email; ?></p>
        <p><strong>Sede:</strong> <?php echo ucfirst(str_replace('-', ' ', $sede)); ?></p>
        <p><strong>Fecha:</strong> <?php echo date("d/m/Y", strtotime($fecha)); ?></p>
        
        <a href="citas.php" style="display:inline-block; margin-top:20px; background:#007BFF; color:white; padding:10px 15px; text-decoration:none; border-radius:5px;">
            Volver al inicio
        </a>
    </main>
</body>
</html>
