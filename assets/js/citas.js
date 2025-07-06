document.addEventListener('DOMContentLoaded', () => {
  const formAgendar = document.getElementById('form-agendar');
  const formCupos = document.getElementById('form-cupos');
  const citasTbody = document.querySelector('#admin-citas tbody');

  // Cargar datos
  let citas = JSON.parse(localStorage.getItem('citas')) || [];
  let caps = JSON.parse(localStorage.getItem('caps')) || {};

  // Tabla de citas
  function renderCitas() {
    citasTbody.innerHTML = '';
    citas.forEach(cita => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${cita.id}</td>
        <td>${cita.nombre}</td>
        <td>${cita.email}</td>
        <td>${cita.sede}</td>
        <td>${cita.fecha_inscripcion}</td>
        <td>${cita.estado}</td>
        <td>
          <button data-id="${cita.id}" class="btn-confirmar">Confirmar</button>
          <button data-id="${cita.id}" class="btn-rechazar">Rechazar</button>
        </td>
      `;
      citasTbody.appendChild(tr);
    });
  }

  // Guarda cambios
  function saveData() {
    localStorage.setItem('citas', JSON.stringify(citas));
    localStorage.setItem('caps', JSON.stringify(caps));
  }

  // Formulario de agendar cita
  formAgendar.addEventListener('submit', event => {
    event.preventDefault();
    const nombre = formAgendar.nombre.value.trim();
    const email = formAgendar.email.value.trim();
    const sede = formAgendar.sede.value;
    const fecha = formAgendar.fecha.value; // formato YYYY-MM-DD

    // Cita duplicada en mismo día
    const existeMismaFecha = citas.some(cita => cita.email === email && cita.fecha_inscripcion === fecha);
    if (existeMismaFecha) {
      alert('Ya tienes una cita agendada para esa fecha.');
      return;
    }

    // Validar cupos por sede y fecha
    const maxCupos = caps[sede] || Infinity;
    const citasEnFechaYSede = citas.filter(cita => cita.sede === sede && cita.fecha_inscripcion === fecha).length;
    if (citasEnFechaYSede >= maxCupos) {
      alert('No hay cupos disponibles para esa sede en la fecha seleccionada.');
      return;
    }

    // Generar nuevo ID
    const nuevoId = citas.length > 0 ? Math.max(...citas.map(c => c.id)) + 1 : 1;
    const nuevaCita = {
      id: nuevoId,
      nombre,
      email,
      sede,
      fecha_inscripcion: fecha,
      estado: 'Pendiente'
    };

    citas.push(nuevaCita);
    saveData();
    renderCitas();
    formAgendar.reset();
  });

  // Formulario de gestión de cupos
  formCupos.addEventListener('submit', event => {
    event.preventDefault();
    const sede = formCupos['sede'].value;
    const maxCupos = parseInt(formCupos['max_cupos'].value, 10);
    if (sede && maxCupos > 0) {
      caps[sede] = maxCupos;
      saveData();
      alert(`Cupos actualizados: ${maxCupos} para ${sede}`);
      formCupos.reset();
    }
  });

  // Inicializar tabla
  renderCitas();
});