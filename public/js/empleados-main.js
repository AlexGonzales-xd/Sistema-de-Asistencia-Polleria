document.addEventListener("DOMContentLoaded", () => {

    // ====== ELIMINAR EMPLEADO ======
    const botonEliminar = document.querySelectorAll(".btn-eliminar");
    botonEliminar.forEach(function (elementos) {
        elementos.addEventListener("click", function () {
            let id_empleadito = elementos.dataset.id;
            fetch(BASE_URL + "/empleados/eliminar_empleado", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id_empleadito=" + id_empleadito,
            }).then(function (respuesta) {
                return respuesta.json();
            }).then(function (datos) {
                if (datos.eliminar) {
                    alert("Usuario eliminado correctamente...");
                    location.reload();
                } else {
                    alert("Usuario no eliminado...");
                    location.reload();
                }
            });
        });
    });

    // ====== MODAL EDITAR EMPLEADO ======
    const overlay   = document.getElementById("modalEditarOverlay");
    const btnCerrar = document.getElementById("modalCerrar");
    const btnGuardar = document.querySelector(".btn-guardar-modal");

    document.querySelectorAll(".btn-editar").forEach(function (btn) {
        btn.addEventListener("click", function () {
            document.getElementById("edit-id").value       = btn.dataset.id;
            document.getElementById("edit-nombre").value   = btn.dataset.nombre;
            document.getElementById("edit-apellido").value = btn.dataset.apellido;
            document.getElementById("edit-dni").value      = btn.dataset.dni;
            document.getElementById("edit-celular").value  = btn.dataset.celular;
            document.getElementById("edit-correo").value   = btn.dataset.correo;
            document.getElementById("edit-cargo").value    = btn.dataset.id_cargo;
            overlay.classList.add("active");
        });
    });

    btnCerrar.addEventListener("click", function () {
        overlay.classList.remove("active");
    });

    overlay.addEventListener("click", function (e) {
        if (e.target === overlay) {
            overlay.classList.remove("active");
        }
    });

    // ====== GUARDAR EDICIÓN ======
    btnGuardar.addEventListener("click", function () {
        const body = new URLSearchParams({
            id_empleado: document.getElementById("edit-id").value,
            nombre:      document.getElementById("edit-nombre").value,
            apellido:    document.getElementById("edit-apellido").value,
            dni:         document.getElementById("edit-dni").value,
            celular:     document.getElementById("edit-celular").value,
            correo:      document.getElementById("edit-correo").value,
            id_cargo:    document.getElementById("edit-cargo").value,
        });

        fetch(BASE_URL + "/empleados/editar_empleado", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: body.toString(),
        })
        .then(function (respuesta) { return respuesta.json(); })
        .then(function (datos) {
            if (datos.ok) {
                alert("Empleado actualizado correctamente.");
                location.reload();
            } else {
                alert("Error: " + datos.mensaje);
            }
        });
    });

});
