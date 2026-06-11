document.addEventListener("DOMContentLoaded", () => {
    // Hamburger / Sidebar toggle (móvil) 
    const hamburger = document.querySelector(".hamburger");
    const sidebar   = document.querySelector(".sidebar");
    const overlay   = document.querySelector(".overlay");

    function openSidebar() {
        sidebar.classList.add("open");
        overlay.classList.add("show");
    }

    function closeSidebar() {
        sidebar.classList.remove("open");
        overlay.classList.remove("show");
    }

    hamburger.addEventListener("click", openSidebar);
    overlay.addEventListener("click", closeSidebar);

    //  Cerrar sesión
    document.getElementById("btn-logout").addEventListener("click", (e) => {
        e.preventDefault();
        if (confirm("¿Seguro que deseas cerrar sesión?")) {
            // Redirigimos a la URL que tiene el href del botón (/logout)
            // El Router se encarga de destruir la sesión y mandar al login
            window.location.href = e.currentTarget.href;
        }
    });

});