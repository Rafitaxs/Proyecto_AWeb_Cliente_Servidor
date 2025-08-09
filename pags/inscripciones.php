<?php
include '../app/config/db.php';

$conn = Database::connect();

$sql = "SELECT ID_Inscripcion, Nombre, Apellido, Cedula, TipoLicencia
        FROM inscripcion
        ORDER BY ID_Inscripcion ASC";
$result = $conn->query($sql);
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
</head>

<body>
    <header>
        <nav class="navegacion">
            <a class="navegacion__enlace--activo" href="inicio.html">Inicio</a>
            <a href="../pags/contacto.html">Contacto</a>
            <a href="../pags/inicioSesion.php">Registrarse</a>
            <a href="../pags/miPerfil.php">Perfil</a>
            <a href="../pags/inscripciones.php">Inscripciones</a>
        </nav>
    </header>

    <div class="contenedor">
        <section id="admin-citas">
            <h2>Registro de Inscripciones</h2>
            <button class="btn-agregar">Agregar</button>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Tipo Licencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                    <?php while($fila = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="ID"><?= $fila['ID_Inscripcion'] ?></td>
                        <td data-label="Nombre"><?= $fila['Nombre'] ?></td>
                        <td data-label="Apellido"><?= $fila['Apellido'] ?></td>
                        <td data-label="Cédula"><?= $fila['Cedula'] ?></td>
                        <td data-label="Tipo Licencia"><?= $fila['TipoLicencia'] ?></td>
                        <td data-label="Acciones">
                            <button data-id="<?= $fila['ID_Inscripcion'] ?>" class="btn-modificar">Modificar</button>
                            <button data-id="<?= $fila['ID_Inscripcion'] ?>" class="btn-eliminar">Eliminar</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6">No hay inscripciones registradas</td>
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