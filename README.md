# Sistema de Control de Asistencia de Empleados
### Sistema de Asistencia de la Pollería Tío Gustón

Aplicación web para el registro y gestión de asistencia del personal, desarrollada en **PHP puro con arquitectura MVC desde cero**, **Programación Orientada a Objetos (POO)**, **PDO** y **MariaDB** como base de datos.

---

## 1. Descripción del Negocio

Pollería Tío Gustón es un restaurante especializado en la preparación y venta de pollo a la brasa, comprometido con ofrecer a nuestros clientes una experiencia gastronómica de calidad, sabor auténtico y atención personalizada. Contamos con ingredientes frescos seleccionados diariamente, recetas propias con un toque especial de especias y un ambiente familiar cálido que nos hace el lugar ideal para compartir momentos inolvidables. Desde nuestros inicios, hemos trabajado con dedicación para convertirnos en el sabor preferido de la comunidad, manteniendo siempre los más altos estándares de higiene y servicio.

---

## 2. Problema y Solución

### Problema Identificado

La Pollería Tío Gustón, como muchos restaurantes en crecimiento, enfrenta serias dificultades en la gestión del personal. Actualmente el control de asistencia de los empleados se realiza de forma manual, ya sea mediante cuadernos de registro o planillas en papel, lo que genera los siguientes problemas:

- Pérdida o deterioro de los registros físicos de asistencia.
- Dificultad para calcular tardanzas, faltas y horas trabajadas de forma precisa.
- Falta de acceso rápido al historial de asistencia de cada empleado.
- Imposibilidad de generar reportes para la toma de decisiones del administrador.
- Riesgo de manipulación o error humano en los registros.
- Registros incompletos o manipulados intencionalmente.
- Alto costo administrativo por procesar asistencias manualmente.
- Falta de trazabilidad y auditoría sobre las marcaciones.
- Tiempo excesivo invertido por el supervisor en consolidar la información mensualmente.

Esta situación provoca desorganización interna, posibles injusticias en el pago del personal y una gestión ineficiente de los recursos humanos del restaurante.

### Causas

- Ausencia de una herramienta digital centralizada para marcar asistencia.
- Los registros en papel se pierden, deterioran o se alteran fácilmente.
- No existe diferenciación de roles entre quién administra y quién solo consulta.
- Es imposible generar reportes históricos de forma automática.

### Efectos

- Pérdida económica por pago incorrecto de horas trabajadas.
- Incapacidad de detectar patrones de ausentismo a tiempo.
- Mayor carga operativa para el área de Recursos Humanos.

### Solución Propuesta

Como solución a esta problemática, se propone el desarrollo de un **Sistema Web de Control de Asistencia** para la Pollería Tío Gustón, desarrollado en PHP 8 con base de datos MariaDB/MySQL.

El sistema permitirá:

- - Registrar la hora de entrada y salida de cada empleado de forma digital y en tiempo real.
- - Clasificar automáticamente el estado de asistencia: **asistió**, **tardanza** o **falta**.
- - Gestionar el catálogo de empleados y sus cargos (Administrador, Cocinero, Cajero, Delivery, etc.).
- - Controlar el acceso al sistema mediante roles de usuario: **admin** y **superadmin**.
- - Generar reportes de asistencia por empleado, por fecha o por período.
- - Consultar el historial de asistencia desde cualquier dispositivo con navegador web.

Con este sistema, la Pollería Tío Gustón podrá modernizar su gestión de personal, reducir errores, ahorrar tiempo administrativo y tomar decisiones más informadas sobre su equipo de trabajo.

---

## 3. Preanálisis

### Necesidades Identificadas

1. Registrar quién entra y sale, con fecha y hora exacta.
2. Panel de control con el estado de asistencia del día.
3. Administrar el catálogo de empleados (crear, editar, eliminar).
4. Organizar empleados por cargo (Cocinero, Cajero, Delivery, etc.).
5. Consultar historial de asistencias filtrado por empleado y período.
6. Autenticar usuarios para proteger la información del sistema.
7. Diferenciar permisos entre **admin** y **superadmin**.

### Estudio de Viabilidad

#### Viabilidad Técnica
- PHP 8+ disponible en prácticamente cualquier servidor web.
- MariaDB es un gestor gratuito, robusto y ampliamente documentado.
- Apache con `mod_rewrite` disponible en XAMPP para desarrollo local.
- La POO permite estructurar el sistema con clases, herencia y encapsulamiento.

#### Viabilidad Económica
- Stack completamente open source y gratuito (PHP, MariaDB, Apache, Git).
- Entorno de desarrollo levantable localmente con XAMPP sin costo.
- No se requieren licencias de software adicionales.

#### Viabilidad Operacional
- Los usuarios solo necesitan un navegador web para acceder.
- Administrable de forma remota una vez desplegado.
- La separación en módulos facilita la capacitación del personal.

### Alcance del Sistema

#### Dentro del alcance
- Autenticación con sesiones PHP y roles (admin / superadmin).
- Módulo de empleados: CRUD completo.
- Módulo de cargos: gestión de los puestos del restaurante.
- Módulo de asistencia: registro de entrada/salida e historial.
- Dashboard con resumen de asistencias del día.
- Layouts reutilizables (header, footer, navbar) — principio DRY.

#### Fuera del alcance
- Integración con dispositivos biométricos.
- Módulo de nómina o cálculo de salarios.
- Aplicación móvil nativa (iOS / Android).
- Notificaciones por correo o SMS.
- Integración con sistemas ERP externos.

---

## 4. Análisis de Requisitos

### 4.1 Requisitos Funcionales

El sistema de control de asistencia de la Pollería Tío Gustón deberá cumplir con las siguientes funcionalidades:

**RF01 — Gestión de empleados**
- El sistema permitirá registrar, editar y eliminar empleados de la pollería.
- Cada empleado tendrá: nombre, apellido, DNI, celular, género, correo y cargo asignado.

**RF02 — Gestión de cargos**
- El sistema permitirá administrar los cargos del restaurante: Administrador, Supervisor, Cajero, Cocinero, Vendedor, Ayudante de cocina y Delivery.

**RF03 — Registro de asistencia**
- El sistema registrará la hora de entrada y salida de cada empleado.
- Clasificará automáticamente el estado: `asistió`, `tardanza` o `falta`.
- Cada registro estará vinculado a un empleado y a una fecha específica.

**RF04 — Gestión de usuarios y autenticación**
- El sistema contará con inicio de sesión seguro mediante nombre de usuario y contraseña.
- Existirán dos roles: `admin` y `superadmin`, con diferentes niveles de acceso.

**RF05 — Consulta de historial**
- El sistema permitirá consultar el historial de asistencias filtrado por empleado, fecha o período.

**RF06 — Reportes**
- El sistema generará reportes de asistencia que muestren: faltas, tardanzas y asistencias por empleado y por rango de fechas.

### 4.2 Requisitos No Funcionales

**RNF01 — Usabilidad**
- La interfaz será intuitiva y responsiva, adaptable a computadoras y dispositivos móviles.

**RNF02 — Seguridad**
- Las contraseñas de los usuarios serán almacenadas con hash seguro (bcrypt).
- Se usarán prepared statements con PDO para prevenir inyecciones SQL.
- El acceso al sistema estará protegido por sesiones PHP.

**RNF03 — Rendimiento**
- El sistema deberá responder en menos de 2 segundos ante cualquier consulta o registro de asistencia.

**RNF04 — Disponibilidad**
- El sistema estará disponible durante el horario de operación de la Pollería Tío Gustón.

**RNF05 — Mantenibilidad**
- El código estará organizado bajo el patrón MVC desde cero, facilitando futuras mejoras sin afectar otras partes del sistema.

**RNF06 — Portabilidad**
- El sistema funcionará en cualquier servidor con PHP 8+ y MariaDB/MySQL, ya sea local (XAMPP) o en hosting compartido.

---

## 5. Stack Tecnológico

| Capa | Tecnología |
|---|---|
| **Backend** | PHP 8+ — POO (Programación Orientada a Objetos) — MVC desde cero |
| **Base de datos** | MariaDB / MySQL — PDO (PHP Data Objects) con prepared statements |
| **Frontend** | HTML5, CSS3, JavaScript — Vistas PHP con layouts reutilizables |
| **Servidor web** | Apache — Reescritura de URLs vía `.htaccess` |
| **Control de versiones** | Git + GitHub |
| **Diseño UI/UX** | Figma |
| **Gestión de tareas** | Trello |
| **Configuración** | Variables de entorno (`.env`) para credenciales de la BD |

---

## 6. Arquitectura del Proyecto

El sistema de la Pollería Tío Gustón aplica **POO** y el patrón **MVC** implementado desde cero, sin frameworks externos.

### Los 4 Pilares de POO Aplicados al Proyecto

| Pilar | Aplicación en el sistema |
|---|---|
| **Encapsulamiento** | Cada modelo (`Empleado`, `Asistencia`, `Cargo`, `Usuario`) protege sus atributos mediante métodos getter/setter |
| **Abstracción** | La clase `Database` abstrae la conexión PDO y las consultas a la BD de la pollería |
| **Herencia** | Los controladores heredan de un `BaseController` con métodos comunes (render, redirect, auth) |
| **Polimorfismo** | Los modelos implementan métodos comunes como `save()`, `find()`, `delete()` con comportamiento propio |

### Flujo de una Petición

```
Navegador
   │
   ▼
.htaccess  ──────────────────►  Redirige todo a public/index.php
   │
   ▼
Router  ──────────────────────►  Analiza la URL y determina Controlador + Método
   │
   ▼
Controlador  ────────────────►  Llama al Modelo correspondiente
(AuthController, EmpleadoController,
 CargoController, AsistenciaController)
   │
   ▼
Modelo  ──────────────────────►  Consulta la BD Polleria_Tio_Guston via PDO
(Usuario, Empleado, Cargo, Asistencia)
   │
   ▼
Vista  ───────────────────────►  Renderiza el HTML al usuario
(layouts/main.php + vistas específicas)
```

### Estructura del Proyecto

```
Polleria_Tio_Guston/
├── app/
│   ├── controllers/
│   │   ├── AuthController.php        # Login / logout
│   │   ├── EmpleadoController.php    # CRUD de empleados
│   │   ├── CargoController.php       # CRUD de cargos
│   │   └── AsistenciaController.php  # Registro y consulta de asistencia
│   ├── models/
│   │   ├── Usuario.php
│   │   ├── Empleado.php
│   │   ├── Cargo.php
│   │   └── Asistencia.php
│   └── views/
│       ├── layouts/
│       │   └── main.php              # Layout principal del sistema
│       ├── empleados/
│       ├── cargos/
│       ├── asistencia/
│       └── auth/
│           └── login.php
├── config/
│   └── Database.php                  # Conexión PDO a Polleria_Tio_Guston
├── public/
│   ├── index.php                     # Front Controller
│   ├── .htaccess
│   ├── css/
│   └── js/
├── .env                              # Credenciales de la BD (no subir a GitHub)
├── .env.example
└── README.md
```

---

## 7. Instalación

### Requisitos Previos

- PHP 8+
- Servidor web local (XAMPP / WAMP) o hosting con Apache
- MariaDB / MySQL
- Git (opcional, para clonar el repositorio)

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/ojitoslanda/employee-attendance-system.git
cd employee-attendance-system

# 2. Configurar variables de entorno
cp .env.example .env
# Editar .env con tus credenciales de base de datos

# 3. Importar la base de datos en phpMyAdmin
# Importar el archivo: Polleria_Tio_Guston.sql

# 4. Apuntar el servidor web a la carpeta public/
# En XAMPP: mover el proyecto a htdocs/
# En WAMP:  mover el proyecto a www/
```

Acceder desde el navegador a:
```
http://localhost/Polleria_Tio_Guston/public/
```

Credenciales de acceso inicial:

| Rol | Usuario | Contraseña |
|---|---|---|
| superadmin | Roronoa | admin123 |
| admin | Sanji | admin456 |

> Cambiar las contraseñas después del primer acceso.

---

## 8. Base de Datos

### Diagrama Entidad-Relación (DER)

![Diagrama Entidad-Relacional](https://cdn.phototourl.com/free/2026-06-11-5d893e54-2c0b-4fd7-854a-5f2a6d719a17.png)

### Modelo Relacional (MR)

![Modelo Relacional](https://cdn.phototourl.com/free/2026-06-11-cde85949-bccd-426b-ad70-3e244a43e3a4.png)

### Cardinalidades

**cargo → empleado (1:N)**
Un cargo puede estar asignado a muchos empleados.
Un empleado solo puede tener un cargo.
```
cargo (1) -----< empleado (N)
```

**empleado → asistencia (1:N)**
Un empleado puede tener muchos registros de asistencia (uno por día).
Cada registro de asistencia pertenece a un solo empleado.
```
empleado (1) -----< asistencia (N)
```

**usuario** — entidad independiente.
Representa las cuentas de acceso al sistema (administradores), no a los empleados del restaurante.

### Script SQL

```sql
-- ============================================================
--  BASE DE DATOS: Polleria Tio Guston
-- ============================================================

CREATE DATABASE Polleria_Tio_Guston;
USE Polleria_Tio_Guston;

-- ============================================================
--  TABLAS
-- ============================================================

CREATE TABLE cargo (
    id_cargo     INT         AUTO_INCREMENT PRIMARY KEY,
    nombre_cargo VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------

CREATE TABLE empleado (
    id_empleado    INT          AUTO_INCREMENT PRIMARY KEY,
    nombre         VARCHAR(100) NOT NULL,
    apellido       VARCHAR(100) NOT NULL,
    dni            VARCHAR(8)   NOT NULL UNIQUE,
    celular        VARCHAR(20),
    genero         ENUM('masculino', 'femenino', 'otro') NOT NULL DEFAULT 'masculino',
    correo         VARCHAR(100) NOT NULL UNIQUE,
    id_cargo       INT          NOT NULL,
    fecha_registro TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cargo) REFERENCES cargo(id_cargo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------

CREATE TABLE usuario (
    id_usuario     INT          AUTO_INCREMENT PRIMARY KEY,
    roles          ENUM('admin', 'superadmin') DEFAULT 'admin',
    nombre_usuario VARCHAR(150) NOT NULL,
    clave          VARCHAR(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------

CREATE TABLE asistencia (
    id_asistencia INT       AUTO_INCREMENT PRIMARY KEY,
    fecha         DATE      NOT NULL,
    hora_entrada  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    hora_salida   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado        ENUM('asistio', 'tardanza', 'falto') NOT NULL DEFAULT 'falto',
    id_empleado   INT       NOT NULL,
    FOREIGN KEY (id_empleado) REFERENCES empleado(id_empleado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
--  DATOS DE PRUEBA
-- ============================================================

INSERT INTO cargo (nombre_cargo) VALUES
    ('Administrador'),
    ('Supervisor'),
    ('Cajero'),
    ('Cocinero'),
    ('Vendedor'),
    ('Ayudante de cocina'),
    ('Delivery');

INSERT INTO empleado (nombre, apellido, dni, celular, genero, correo, id_cargo) VALUES
    ('Juan Carlos',      'Perez Gomez',      '12345678', '987654321', 'masculino', 'juan.perez@polleria.com',       1),
    ('Maria Elena',      'Rodriguez Lopez',  '23456789', '987654322', 'femenino',  'maria.rodriguez@polleria.com',  2),
    ('Carlos Andres',    'Sanchez Torres',   '34567890', '987654323', 'masculino', 'carlos.sanchez@polleria.com',   3),
    ('Ana Lucia',        'Martinez Rios',    '45678901', '987654324', 'femenino',  'ana.martinez@polleria.com',     4),
    ('Roberto Carlos',   'Flores Mendoza',   '56789012', '987654325', 'masculino', 'roberto.flores@polleria.com',   5),
    ('Patricia Isabel',  'Diaz Castro',      '67890123', '987654326', 'femenino',  'patricia.diaz@polleria.com',    4),
    ('Fernando Jose',    'Torres Vera',      '78901234', '987654327', 'masculino', 'fernando.torres@polleria.com',  6),
    ('Carmen Rosa',      'Ramirez Olivos',   '89012345', '987654328', 'femenino',  'carmen.ramirez@polleria.com',   5),
    ('Javier Alejandro', 'Gutierrez Prada',  '90123456', '987654329', 'masculino', 'javier.gutierrez@polleria.com', 7),
    ('Luis Alberto',     'Hernandez Cuba',   '01234567', '987654330', 'masculino', 'luis.hernandez@polleria.com',   3);

INSERT INTO usuario (roles, nombre_usuario, clave) VALUES
    ('superadmin', 'Roronoa', 'admin123'),
    ('admin',      'Sanji',   'admin456');

-- ============================================================
--  VERIFICACIÓN
-- ============================================================

SELECT * FROM cargo;
SELECT * FROM empleado;
```

---

## 9. Diseño UI/UX

El diseño de interfaces fue prototipado en Figma antes del desarrollo:

[Ver prototipo en Figma](https://www.figma.com/design/tCp01HDp9aw4ZK2l2dIRlU/SistemaDeAsistencia?node-id=119-3&p=f&t=mw94LWMpBFkMuaTz-0)

---

## 10. Gestión del Proyecto

La planificación y seguimiento de tareas se realiza en **Trello**, organizando el trabajo por sprints:

- Tablero Trello: *(agregar enlace al tablero)*

Columnas del tablero:
- `Por hacer` — tareas pendientes
- `En progreso` — tareas en desarrollo
- `En revisión` — tareas en prueba
- `Completado` — tareas finalizadas

---

## 11. Autores

Desarrollado por el equipo de la Pollería Tío Gustón.

> Sistema desarrollado con fines académicos y de gestión interna.
