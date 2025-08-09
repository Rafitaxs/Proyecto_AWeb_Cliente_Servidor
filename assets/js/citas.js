document.addEventListener('DOMContentLoaded', () => {
  const formAgendar = document.getElementById('form-agendar');
  const formCupos = document.getElementById('form-cupos');
  const citasTbody = document.querySelector('#admin-citas tbody');

  let citas = JSON.parse(localStorage.getItem('citas')) || [];
  let caps = JSON.parse(localStorage.getItem('caps')) || {};

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

  function saveData() {
    localStorage.setItem('citas', JSON.stringify(citas));
    localStorage.setItem('caps', JSON.stringify(caps));
  }

  function validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  function validarFecha(fechaStr) {
    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0);
    const fecha = new Date(fechaStr);
    return fecha >= hoy;
  }

  formAgendar.addEventListener('submit', event => {
    event.preventDefault();

    const nombre = formAgendar.nombre.value.trim();
    const email = formAgendar.email.value.trim();
    const sede = formAgendar.sede.value;
    const fecha = formAgendar.fecha.value;

    if (!nombre) {
      alert('El nombre es obligatorio.');
      return;
    }

    if (!email) {
      alert('El correo electrónico es obligatorio.');
      return;
    }

    if (!validarEmail(email)) {
      alert('El correo electrónico no tiene un formato válido.');
      return;
    }

    if (!sede) {
      alert('Por favor selecciona una sede.');
      return;
    }

    if (!fecha) {
      alert('Por favor selecciona una fecha.');
      return;
    }

    if (!validarFecha(fecha)) {
      alert('La fecha no puede ser anterior a hoy.');
      return;
    }

    const data = new URLSearchParams();
    data.append('nombre', nombre);
    data.append('email', email);
    data.append('sede', sede);
    data.append('fecha_inscripcion', fecha);

    fetch('agendar_cita.php', {
      method: 'POST',
      body: data,
    })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        if (data.status === 'success') {
          formAgendar.reset();
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Error al agendar la cita');
      });
  });


  formCupos.addEventListener('submit', event => {
    event.preventDefault();
    const sede = formCupos['sede'].value;
    const max_cupos = formCupos['max_cupos'].value.trim();
    const cupos_disponibles = formCupos['cupos_disponibles'].value.trim();

    if (!sede) {
      alert('Por favor selecciona una sede.');
      return;
    }

    if (!max_cupos) {
      alert('Por favor ingresa el número máximo de cupos.');
      return;
    }

    if (!cupos_disponibles) {
      alert('Por favor ingresa el número de cupos disponibles.');
      return;
    }

    const maxCuposNum = Number(max_cupos);
    const cuposDisponiblesNum = Number(cupos_disponibles);

    if (isNaN(maxCuposNum) || maxCuposNum <= 0 || !Number.isInteger(maxCuposNum)) {
      alert('El número máximo de cupos debe ser un entero positivo.');
      return;
    }

    if (isNaN(cuposDisponiblesNum) || cuposDisponiblesNum < 0 || !Number.isInteger(cuposDisponiblesNum)) {
      alert('Los cupos disponibles deben ser un entero no negativo.');
      return;
    }

    if (cuposDisponiblesNum > maxCuposNum) {
      alert('Los cupos disponibles no pueden ser mayores que el máximo de cupos.');
      return;
    }

    fetch('actualizar_cupos.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `sede=${encodeURIComponent(sede)}&max_cupos=${encodeURIComponent(maxCuposNum)}&cupos_disponibles=${encodeURIComponent(cuposDisponiblesNum)}`
    })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        if (data.status === 'success') {
          formCupos.reset();
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al actualizar los cupos');
      });
  });


  // Inicializar tabla
  renderCitas();
});
