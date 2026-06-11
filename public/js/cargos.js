/* cargos.js — Lógica de modales y buscador */

/* ─── MODALES ───────────────────────────────────── */
function abrirModalNuevo() {
    document.getElementById('modalNuevo').classList.add('show');
}

function abrirModalEditar(id, nombre) {
    document.getElementById('edit_id').value = id;
    document.getElementById('nombre_editar').value = nombre;
    document.getElementById('modalEditar').classList.add('show');
}

function confirmarEliminar(id, nombre) {
    document.getElementById('eliminar_id').value = id;
    document.getElementById('nombre-a-eliminar').textContent = nombre;
    document.getElementById('modalEliminar').classList.add('show');
}

function cerrarModal(idModal) {
    document.getElementById(idModal).classList.remove('show');
}

/* Cerrar modal al hacer clic fuera */
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.remove('show');
        }
    });
});

/* Cerrar con Escape */
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.show').forEach(m => {
            m.classList.remove('show');
        });
    }
});

/* ─── BUSCADOR ──────────────────────────────────── */
function filtrarTabla() {
    const texto = document.getElementById('buscador').value.toLowerCase();
    const filas = document.querySelectorAll('#tablaCargos tbody tr');
    let visibles = 0;

    filas.forEach(fila => {
        if (fila.classList.contains('td-empty')) return;
        const nombre = fila.querySelector('.td-nombre')?.textContent.toLowerCase() || '';
        const id     = fila.querySelector('.td-id')?.textContent.toLowerCase() || '';
        const coincide = nombre.includes(texto) || id.includes(texto);
        fila.style.display = coincide ? '' : 'none';
        if (coincide) visibles++;
    });

    const badge = document.getElementById('total-badge');
    if (badge) badge.textContent = visibles + ' cargos';
}