document.addEventListener("DOMContentLoaded", () => {

  // RELOJ EN TIEMPO REAL
  const reloj = document.getElementById("reloj");
  function actualizarReloj() {
    reloj.textContent = new Date().toLocaleTimeString("es-PE", { hour12: false });
  }
  actualizarReloj();
  setInterval(actualizarReloj, 1000);

  // ELEMENTOS DEL DOM
  const inputdni = document.getElementById("codigo");
  const name_employer = document.getElementById("empleado-nombre");
  const msj = document.getElementById("msj");

  // Siempre mantener el foco en el input
  inputdni.addEventListener("input", function () {
    if (inputdni.value.length === 8) {
      let dninuevo = inputdni.value;
      inputdni.value = "";
      buscarEmpleado(dninuevo);
    }
  });

  document.addEventListener("click", function () {
    inputdni.focus();
  });

  // Busca el empleado por DNI
  function buscarEmpleado(dni_parametro) {
    fetch(BASE_URL + "/asistencias/buscar", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "dni=" + dni_parametro,
    })
      .then(res => res.json())
      .then(datos => {
        if (datos.encontrado) {
          name_employer.textContent = datos.empleado.nombre + " " + datos.empleado.apellido;
          registrarAsistenciaEmpleado(datos.empleado.id_empleado);
        } else {
          name_employer.textContent = "Empleado no encontrado";
          mostrarMensaje("Este empleado no pertenece a la empresa", "error");
        }
      });
  }

  // Registra entrada o salida según el estado del empleado hoy
  function registrarAsistenciaEmpleado(idEmpleado) {
    fetch(BASE_URL + "/asistencias/registradito", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id_empleadito=" + idEmpleado,
    })
      .then(res => res.json())
      .then(datos => {
        if (datos.accion === "entrada") {
          mostrarMensaje("✅ " + datos.mensaje, "entrada");
        } else if (datos.accion === "salida") {
          mostrarMensaje("🚪 " + datos.mensaje, "salida");
        } else if (datos.accion === "completo") {
          mostrarMensaje("⚠️ " + datos.mensaje, "completo");
        }

        // Limpiar pantalla después de 5 segundos
        setTimeout(function () {
          name_employer.textContent = "— — —";
          msj.textContent = "";
          msj.className = "mensaje";
        }, 5000);
      });
  }

  // Muestra el mensaje con color según la acción
  function mostrarMensaje(texto, tipo) {
    msj.textContent = texto;
    msj.className = "mensaje msj-" + tipo;
  }

});