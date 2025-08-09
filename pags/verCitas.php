<?php
include '../app/config/db.php';
$conn = Database::connect();

$sql = "SELECT * FROM citas ORDER BY fecha_inscripcion ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Citas</title>
    <!-- <link rel="stylesheet" href="../assets/css/inscripciones.css"> -->
    <link rel="stylesheet" href="../assets/css/citas.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>
    <header>
        <nav class="navegacion">
            <a href="../pags/citas.html" class="navegacion__enlace--activo">Agendar Cita</a>
        </nav>
    </header>

    <div class="contenedor">
        <section id="admin-citas">
            <h2>Listado de Citas</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Sede</th>
                        <th>Fecha Inscripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($fila = $result->fetch_assoc()): ?>
                        <tr>
                            <td data-label="ID"><?= $fila['id'] ?></td>
                            <td data-label="Nombre"><?= $fila['nombre'] ?></td>
                            <td data-label="Email"><?= $fila['email'] ?></td>
                            <td data-label="Sede"><?= $fila['sede'] ?></td>
                            <td data-label="Fecha"><?= $fila['fecha_inscripcion'] ?></td>
                            <td data-label="Estado">
                                <?php if($fila['estado'] == 'pendiente'): ?>
                                    <span class="estado-pendiente">Pendiente</span>
                                <?php elseif($fila['estado'] == 'confirmado'): ?>
                                    <span class="estado-confirmado">Confirmado</span>
                                <?php else: ?>
                                    <span class="estado-rechazado">Rechazado</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="POST" action="procesarCita.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                    <input type="hidden" name="accion" value="confirmar">
                                    <button class="btn-confirmar" type="submit">Confirmar</button>
                                </form>
                                <form method="POST" action="procesarCita.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                    <input type="hidden" name="accion" value="rechazar">
                                    <button class="btn-rechazar" type="submit">Rechazar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay citas registradas</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
