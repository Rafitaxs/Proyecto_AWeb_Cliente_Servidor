<?php
include '../app/config/db.php';
session_start();

$conn = Database::connect();

$sql = "SELECT i.ID_Inscripcion, i.Nombre, i.Apellido, i.Cedula, i.TipoLicencia,
               s.Provincia AS Sede
        FROM inscripcion i
        LEFT JOIN sede s ON i.SedeID = s.ID
        ORDER BY i.ID_Inscripcion ASC";
$result = $conn->query($sql);


if (!$result) {
    die("Error en la consulta SQL: " . $conn->error);
}
if (!isset($_SESSION['rol'])) {
    header('Location: ../pags/inicioSesion.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción a Práctica de Manejo</title>
    <link rel="stylesheet" href="../assets/css/inscripciones.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <header>
        <nav class="navegacion">
            <a class="navegacion__enlace--activo" href="inicio.html">Inicio</a>
            <a href="../pags/contacto.html">Contacto</a>
            <a href="../pags/inicioSesion.php">Registrarse</a>
            <a href="../pags/miPerfil.php">Perfil</a>
            <a href="../pags/inscripciones.php">Inscripciones</a>
            <a href="../pags/pago.html">Pago</a>
            <a href="../pags/logout.php" class="btn-logout" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </nav>
    </header>

    <div class="contenedor">
        <section id="admin-citas">
            <h2>Registro de Inscripciones</h2>

            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
            <button class="btn-agregar">Agregar</button>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Tipo Licencia</th>
                        <th>Sede</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                    <?php while ($fila = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="ID"><?= htmlspecialchars($fila['ID_Inscripcion']) ?></td>
                        <td data-label="Nombre"><?= htmlspecialchars($fila['Nombre']) ?></td>
                        <td data-label="Apellido"><?= htmlspecialchars($fila['Apellido']) ?></td>
                        <td data-label="Cédula"><?= htmlspecialchars($fila['Cedula']) ?></td>
                        <td data-label="Tipo Licencia"><?= htmlspecialchars($fila['TipoLicencia']) ?></td>
                        <td data-label="Sede"><?= htmlspecialchars($fila['Sede']) ?></td>
                        <td data-label="Acciones">
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                            <button data-id="<?= $fila['ID_Inscripcion'] ?>" class="btn-modificar">Modificar</button>
                            <button data-id="<?= $fila['ID_Inscripcion'] ?>" class="btn-eliminar">Eliminar</button>
                            <?php else: ?>
                            <em>Sin permisos</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7">No hay inscripciones registradas</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
    <footer class="footer footer-fixed-bottom">
        <div class="footer-content">
            <p>© 2025 Citas Prácticas de Manejo - Todos los derechos reservados</p>
            <div class="footer-icons">
                <a href='https://www.facebook.com/MOPTcostarica/?ref=search#' target='_blank'>Facebook</a>
                <a href='https://www.instagram.com/mopt_cr/#' target='_blank'>Instagram</a>
                <a href='https://www.tiktok.com/@el_mopt' target='_blank'>TikTok</a>
            </div>
            <p class="footer-texto">Central Telefónica: (506)2523-2000.<br></p>
        </div>
    </footer>

    <script src="../assets/js/inscripciones.js"></script>
</body>

</html>