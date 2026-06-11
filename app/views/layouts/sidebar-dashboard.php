<!--El archivo .htacces tiene este linea RewriteRule ^(.+)$ app/index.php?url=$1 [QSA,L] -->
<!--Detectamos en qué pagina estamos para marcar el link activo del siderbar(inicio,producto,...)-->
<?php
$rutaActual  = explode('/', trim($_GET['url'] ?? 'dashboard', '/'))[0] ?: 'dashboard';
$esSuperAdmin = ($_SESSION['usuario']['roles'] ?? '') === 'superadmin';


?>

<!-- TOPBAR (solo visible en móvil) -->
<div class="topbar">
    <div class="title-business">
        <span><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></span>
    </div>
    <div class="btn-menu">
        <button class="hamburger" aria-label="Abrir menú">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>

<!-- OVERLAY -->
<div class="overlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-logo"><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></div>
    <ul>
        <!-- ================ START DASHBOARD ================ -->
        <li>
            <a href="<?php echo BASE_URL; ?>/dashboard"
                class="<?php echo $rutaActual === 'dashboard' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>
        </li>
        <!-- ================ END DASHBOARD ================ -->
        <?php if ($esSuperAdmin): ?>
            
        <!-- ================ START EMPLEADOS ================ -->
        <li class="<?php echo $rutaActual === 'empleados' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'empleados' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Empleados</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/empleados"
                    class="<?php echo $rutaActual === 'empleados' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-users"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/empleados/registro">
                    <i class="fa-solid fa-edit"></i>
                    Registrar
                </a>
            </div>
        </li>
        <!-- ================ END EMPLEADOS ================ -->

        <!-- ================ START CARGOS ================ -->
        <li class="<?php echo $rutaActual === 'cargos' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'cargos' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-briefcase"></i>
                <span>Cargos</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/cargos/reportes"
                    class="<?php echo $rutaActual === '/cargos/reportes' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-clipboard-list"></i>
                    Reporte
                </a>
            </div>
        </li>
        <!-- ================ END CARGOS ================ -->
        <?php endif; ?>

        <!-- ================ START ASISTENCIA ================ -->
        <li class="<?php echo $rutaActual === 'asistencias' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'asistencias' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Asistencia</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/asistencias/reportes"
                    class="<?php echo $rutaActual === 'asistencias' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-clock"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/asistencias/ejemplo_hoja"
                    class="<?php echo $rutaActual === 'asistencias/ejemplo_hoja' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-file-alt"></i>
                    Asistencia de hoy
                </a>
            </div>

        </li>
        <!-- ================ END ASISTENCIA ================ -->

            <?php if ($esSuperAdmin): ?>
            <!-- ================ START USUARIOS ================ -->
            <li>
                <a href="<?php echo BASE_URL; ?>/usuarios" class="<?php echo $rutaActual === 'usuario' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-user-cog"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <!-- ================ END USUARIOS ================ -->
            <?php endif; ?>
        <li class="nav-logout">
            <a href="<?php echo BASE_URL; ?>/logout" id="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesión</span>
            </a>
        </li>
    </ul>
</aside>


<script src="<?php echo BASE_URL; ?>/public/js/dropdown.js"></script>