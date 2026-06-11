document.addEventListener("DOMContentLoaded", () => {

    const overlay = document.getElementById("modal-overlay");
    const modalTitulo = document.getElementById("modal-titulo");
    const inputId = document.getElementById("input-id");
    const inputNombre = document.getElementById("input-nombre");
    const inputClave = document.getElementById("input-clave");
    const inputRol = document.getElementById("input-rol");
    const modalError = document.getElementById("modal-error");
    const claveHint = document.getElementById("clave-hint");

    let modoEditar = false;

    // Abrir modal para NUEVO usuario
    document.getElementById("btn-nuevo-usuario").addEventListener("click", () => {
        modoEditar = false;
        modalTitulo.textContent = "Nuevo Usuario";
        inputId.value = "";
        inputNombre.value = "";
        inputClave.value = "";
        inputRol.value = "admin";
        modalError.textContent = "";
        claveHint.style.display = "none";
        overlay.classList.add("activo");
        inputNombre.focus();
    });

    // Abrir modal para EDITAR usuario
    document.querySelectorAll(".btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {
            modoEditar = true;
            modalTitulo.textContent = "Editar Usuario";
            inputId.value = btn.dataset.id;
            inputNombre.value = btn.dataset.nombre;
            inputClave.value = "";
            inputRol.value = btn.dataset.rol;
            modalError.textContent = "";
            claveHint.style.display = "inline";
            overlay.classList.add("activo");
            inputNombre.focus();
        });
    });

    // Cerrar modal
    function cerrarModal() {
        overlay.classList.remove("activo");
    }
    document.getElementById("modal-cerrar").addEventListener("click", cerrarModal);
    document.getElementById("btn-cancelar").addEventListener("click", cerrarModal);
    overlay.addEventListener("click", e => { if (e.target === overlay) cerrarModal(); });

    // Guardar (crear o editar)
    document.getElementById("btn-guardar").addEventListener("click", () => {
        const nombre = inputNombre.value.trim();
        const clave = inputClave.value.trim();
        const rol = inputRol.value;

        if (!nombre) {
            modalError.textContent = "El nombre de usuario es obligatorio.";
            return;
        }
        if (!modoEditar && !clave) {
            modalError.textContent = "La contraseña es obligatoria para nuevos usuarios.";
            return;
        }

        const url = modoEditar
            ? BASE_URL + "/usuarios/editar"
            : BASE_URL + "/usuarios/crear";

        const body = modoEditar
            ? `id_usuario=${inputId.value}&nombre_usuario=${encodeURIComponent(nombre)}&clave=${encodeURIComponent(clave)}&roles=${rol}`
            : `nombre_usuario=${encodeURIComponent(nombre)}&clave=${encodeURIComponent(clave)}&roles=${rol}`;

        fetch(url, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: body,
        })
            .then(res => res.json())
            .then(datos => {
                if (datos.ok) {
                    location.reload();
                } else {
                    modalError.textContent = datos.mensaje;
                }
            });
    });

    // Eliminar usuario
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", () => {
            const nombre = btn.dataset.nombre;
            const id = btn.dataset.id;
            if (!confirm(`¿Seguro que deseas eliminar al usuario "${nombre}"?`)) return;

            fetch(BASE_URL + "/usuarios/eliminar", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id_usuario=${id}`,
            })
                .then(res => res.json())
                .then(datos => {
                    if (datos.ok) location.reload();
                });
        });
    });

});