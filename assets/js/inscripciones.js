document.querySelector('.btn-agregar').addEventListener('click', function () {
    window.location.href = 'form_inscripcion.php';
});

document.querySelectorAll('.btn-modificar').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        window.location.href = 'form_inscripcion.php?id=' + id;
    });
});

document.querySelectorAll('.btn-eliminar').forEach(btn => {
    btn.addEventListener('click', function () {
        if (confirm('¿Seguro que quieres eliminar esta inscripción?')) {
            const id = this.getAttribute('data-id');
            fetch('eliminar_inscripcion.php', {
                method: 'POST',
                body: new URLSearchParams({ id })
            }).then(() => location.reload());
        }
    });
});
