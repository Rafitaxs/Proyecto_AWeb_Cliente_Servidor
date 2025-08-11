document.getElementById('form-posicion').addEventListener('submit', function(e) {
    e.preventDefault();
    const idCita = document.getElementById('id-cita-consulta').value;
    fetch('../app/controllers/CitaController.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id_cita=' + encodeURIComponent(idCita)
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('resultado-posicion').innerText = data;
    });
});