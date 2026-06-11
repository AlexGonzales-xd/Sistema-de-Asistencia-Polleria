<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Los assets usan rutas absolutas con BASE_URL para que funcionen sin importar la URL actual -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/landing.css">
</head>

<body>
    <!-- Fade overlay para transición de botón Ver demo -->
    <div id="fadeOverlay"></div>

    <!-- Menú móvil (overlay) fuera del nav para que position:fixed funcione siempre -->
    <?php include __DIR__ . '/../layouts/header-home.php'; ?>

    <!-- Sección principal con video de fondo -->
    <section class="stage">

        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?php echo BASE_URL; ?>/public/video/donde.mp4" type="video/mp4">
        </video>

        <!-- Navbar -->
        <nav class="navbar" id="navbar">
            <a class="brand" href="#">EMPRESA</a>

            <button class="menu-btn" id="menuBtn" aria-label="Abrir menú">
                <i class="bi bi-list"></i>
            </button>
        </nav>

        <!-- Contenido hero -->
        <div class="hero-content">
            <button class="cta-btn demo-trigger" id="verDemo">Ver demo</button>
        </div>

        <!-- Scroll indicator -->
        <div class="scroll-indicator" id="scrollIndicator">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>

    </section>

    <!-- Sección proyectos -->
    <section class="projects-section">

        <div class="project-card">
            <div class="project-img-wrap">
                <img src="<?php echo BASE_URL; ?>/public/image/registro_asistencia.png" alt="Registro con DNI" class="project-img">
            </div>
            <h3 class="project-title">Registro de asistencia</h3>
            <p class="project-desc">Cómo registrar mi asistencia con mi dni Para registrar tu asistencia con tu DNI, sigue estos pasos:
                1:Accede al sistema de registro de asistencia que tu empresa haya implementado.
                Selecciona la opción de asistencia y elige el día a registrar.
                2:Ingresa tu nombre y DNI en el campo correspondiente.
                3:Marca la hora de ingreso y salida según tu horario laboral.
                4:Confirma la asistencia y guarda el registro en tu dispositivo.
                5:Recuerda que el registro de asistencia es un derecho y un deber para todos los empleados, y no debe ser un proceso complicado.
                Si necesitas más información o asistencia,consulta con tu supervisor o el departamento de recursos humanos de tu empresa.</p>
            <a href="<?php echo BASE_URL; ?>/asistencias" class="project-link">Ver demo <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="project-card">
            <div class="project-img-wrap">
                <img src="<?php echo BASE_URL; ?>/public/image/panel_principal.png" alt="Panel de Control" class="project-img project-img--admin">
            </div>
            <h3 class="project-title">Panel de Control</h3>
            <p class="project-desc">
                Accesos directos a Inicio, Empleados, Cargos, Asistencia y Usuarios.Filtros de Búsqueda: Permite segmentar los datos de la tabla por fecha específica y por el estado del registro.Contadores en Tiempo Real: Bloques superiores que cuantifican el total de empleados, los asistidos, las tardanzas y las faltas del día.Tabla de Datos Detallada: Muestra el perfil del trabajador (nombre, avatar y DNI), su puesto (ej. Ayudante de cocina), fecha, horas marcadas y una etiqueta visual de estado (como "Tardanza").</p>
            <a href="<?php echo BASE_URL; ?>/dashboard" class="project-link">Ver demo <i class="bi bi-arrow-right"></i></a>
        </div>

    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../layouts/footer-home.php'; ?>
    <script src="<?php echo BASE_URL; ?>/public/js/landing.js"></script>
</body>

</html>