<?php
session_start();
$isAdmin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

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
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="../assets/css/citas.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <header>
        <?php include '../componentes/header.html'; ?>
    </header>

    <main>
        <section id="user-schedule">
            <h2>Agendar Cita</h2>
            <form id="form-agendar" action="">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="sede">Sede</label>
                    <select id="sede" name="sede" required>
                        <option value="">-- Selecciona una sede --</option>
                        <option value="sede-1">Sede 1</option>
                        <option value="sede-2">Sede 2</option>
                        <option value="sede-3">Sede 3</option>
                        <option value="sede-4">Sede 4</option>
                        <option value="sede-5">Sede 5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha de inscripción</label>
                    <input type="date" id="fecha" name="fecha_inscripcion" required>
                </div>
                <div id="confirmacion-cita" class="confirmacion-cita"
                    style="display:none; border: 1px solid #4caf50; padding: 1rem; margin-top: 1rem; background-color: #e8f5e9; color: #2e7d32;">
                    <h3>¡Cita agendada correctamente!</h3>
                    <p>Se envió la información de la cita a su correo electrónico.</p>
                    <div id="info-cita"></div>
                    <button id="cerrar-confirmacion">Cerrar</button>
                </div>

                <button type="submit">Agendar Cita</button>
            </form>
        </section>

        <section id="posicion-fila">
            <h2>Consultar posición en la fila</h2>
            <form id="form-posicion" action="">
                <div class="form-group"></div>
                <input type="number" id="id-cita-consulta" name="id_cita" placeholder="Ejemplo: 123" min="1" required>
                <button type="submit">Consultar posición</button>

            </form>
            <div id="resultado-posicion"></div>
        </section>

        <?php if ($isAdmin): ?>
            <section id="admin-cupos">
                <h2>Gestión de Cupos por Sede</h2>
                <form id="form-cupos" action="actualizar_cupos.php" method="POST">
                    <div class="form-group">
                        <label for="sede-cupo">Sede</label>
                        <select id="sede-cupo" name="sede" required>
                            <option value="">-- Selecciona una sede --</option>
                            <option value="sede-1">Sede 1</option>
                            <option value="sede-2">Sede 2</option>
                            <option value="sede-3">Sede 3</option>
                            <option value="sede-4">Sede 4</option>
                            <option value="sede-5">Sede 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="max-cupos">Número máximo de cupos</label>
                        <input type="number" id="max-cupos" name="max_cupos" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="cupos-disponibles">Cupos Disponibles</label>
                        <input type="number" id="cupos-disponibles" name="cupos_disponibles" min="0" required>
                    </div>
                    <button type="submit">Actualizar cupos</button>
                </form>
            </section>
        <?php endif; ?>

        <div style="text-align:center; margin-top: 2rem;">
            <a href="../pags/verCitas.php" class="btn-ver-citas">Ver todas las citas</a>
        </div>
    </main>

    <footer class="footer">
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
    <script src="../assets/js/citas.js"></script>
    <script src="../assets/js/consultaPosicion.js"></script>
</body>

</html>