# Sistema de Control de Asistencia de Empleados
### Employee Attendance System
Aplicación web para el registro y gestión de asistencia del personal, desarrollada en **PHP puro con arquitectura MVC desde cero**, **Programación Orientada a Objetos (POO)**, **PDO** y **MariaDB** como base de datos.

## 1. Descripción del Negocio

Las organizaciones modernas necesitan gestionar la asistencia de su personal de forma precisa y centralizada (Solo de un turno). Este sistema reemplaza los registros manuales en papel o planillas físicas, eliminando problemas como:

- Registros incompletos o manipulados
- Alto costo administrativo por procesar asistencias manualmente
- Imposibilidad de generar reportes históricos de forma automática
- Falta de trazabilidad y auditoría sobre las marcaciones
- Dependencia de personal para consolidar información

## 2. Problema y Solución

### Problema Identificado
Las empresas carecen de un sistema digital accesible para registrar, monitorear y gestionar la asistencia de sus empleados. El control manual genera imprecisiones, pérdidas de información y dificulta la toma de decisiones basadas en datos confiables.

### Causas
- Ausencia de una herramienta digital centralizada para marcar asistencia
- Los registros en papel se pierden, deterioran o se alteran fácilmente
- No existe diferenciación de roles entre quién administra y quién solo consulta
- Es imposible generar reportes históricos de forma automática

### Efectos
- Pérdida económica por pago incorrecto de horas trabajadas
- Incapacidad de detectar patrones de ausentismo a tiempo
- Mayor carga operativa para el área de Recursos Humanos

### Solución Propuesta

Desarrollar una aplicación web con **PHP + POO + MVC** que permita:

- Autenticar usuarios con roles diferenciados (administrador / empleado)
- Registrar asistencia con fecha y hora exactas usando PDO y MariaDB
- Gestionar el catálogo de empleados y departamentos (CRUD completo)
- Consultar y filtrar el historial de asistencias por empleado y fecha
- Visualizar un dashboard con el estado de asistencia del día en curso
- 
## 3. Preanálisis

### Necesidades Identificadas

1. Registrar quién entra y sale, con fecha y hora exacta
2. Panel de control con el estado de asistencia del día
3. Administrar el catálogo de empleados (crear, editar, eliminar)
4. Organizar empleados por departamentos
5. Consultar historial de asistencias filtrado por empleado y período
6. Autenticar usuarios para proteger la información del sistema
7. Diferenciar permisos entre administrador y empleado

### Estudio de Viabilidad

#### Viabilidad Técnica
- PHP 8+ disponible en prácticamente cualquier servidor web
- MariaDB es un gestor gratuito, robusto y ampliamente documentado
- Apache con `mod_rewrite` disponible en XAMPP para desarrollo local
- La POO permite estructurar el sistema con clases, herencia y encapsulamiento
- El patrón MVC está documentado en [`CONCEPTS.md`](./CONCEPTS.md)

#### Viabilidad Económica
- Stack completamente open source y gratuito (PHP, MariaDB, Apache, Git)
- Entorno de desarrollo levantable localmente con XAMPP sin costo
- No se requieren licencias de software adicionales

#### Viabilidad Operacional
- Los usuarios solo necesitan un navegador web para acceder
- Administrable de forma remota una vez desplegado
- La separación en módulos facilita la capacitación del personal

### Alcance del Sistema

#### Dentro del alcance
- Autenticación con sesiones PHP y roles (administrador / empleado)
- Módulo de empleados: CRUD completo
- Módulo de departamentos: gestión de áreas
- Módulo de asistencia: registro de entrada/salida e historial
- Dashboard con resumen de asistencias del día
- Layouts reutilizables (header, footer, navbar) — principio DRY

#### Fuera del alcance
- Integración con dispositivos biométricos
- Módulo de nómina o cálculo de salarios
- Aplicación móvil nativa (iOS / Android)
- Notificaciones por correo o SMS
- Integración con sistemas ERP externos

---

## 4. Análisis de Requisitos

### 4.1 Requisitos Funcionales
Falta
### 4.2 Requisitos No Funcionales
Falta
## Stack Tecnológico

| Capa | Tecnología |
|---|---|
| **Backend** | PHP 8+ — POO (Programación Orientada a Objetos) — MVC desde cero |
| **Base de datos** | MariaDB — PDO (PHP Data Objects) con prepared statements |
| **Frontend** | HTML5, CSS3, JavaScript — Vistas PHP con layouts reutilizables |
| **Servidor web** | Apache — Reescritura de URLs vía `.htaccess` |
| **Control de versiones** | Git + GitHub |
| **Configuración** | Variables de entorno (`.env`) para credenciales |
---

## Arquitectura del Proyecto

El sistema aplica **POO** y **MVC** implementado desde cero. Los 4 pilares de POO en el proyecto:

### Flujo de una Petición


### Estructura del Proyecto

## Instalación

### Requisitos previos
- PHP 8+
- Servidor web local o hosting
- MariaDB / MySQL

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/ojitoslanda/employee-attendance-system.git
cd employee-attendance-system

# 2. Configurar variables de entorno
cp .env.example .env
# Editar .env con tus credenciales de base de datos

# 3. Crear la base de datos


# 4. Apuntar el servidor web a la carpeta public/

```

## TRELLO
Falta integrar

### DIAGRAMA DE FIGMA UI/UX
https://www.figma.com/design/tCp01HDp9aw4ZK2l2dIRlU/SistemaDeAsistencia?node-id=119-3&p=f&t=mw94LWMpBFkMuaTz-0
## Base de datos
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
    id_cargo     INT          AUTO_INCREMENT PRIMARY KEY,
    nombre_cargo VARCHAR(50)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------

CREATE TABLE empleado (
    id_empleado      INT          AUTO_INCREMENT PRIMARY KEY,
    nombre           VARCHAR(100) NOT NULL,
    apellido         VARCHAR(100) NOT NULL,
    dni              VARCHAR(8)   NOT NULL UNIQUE,
    celular          VARCHAR(20),
    genero           ENUM('masculino', 'femenino', 'otro') NOT NULL DEFAULT 'masculino',
    correo           VARCHAR(100) NOT NULL UNIQUE,
    id_cargo         INT          NOT NULL,
    fecha_registro   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
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

-- Cargos
INSERT INTO cargo (nombre_cargo) VALUES
    ('Administrador'),
    ('Supervisor'),
    ('Cajero'),
    ('Cocinero'),
    ('Vendedor'),
    ('Ayudante de cocina'),
    ('Delivery');

-- Empleados
INSERT INTO empleado (nombre, apellido, dni, celular, genero, correo, id_cargo) VALUES
    ('Juan Carlos',     'Perez Gomez',       '12345678', '987654321', 'masculino', 'juan.perez@polleria.com',       1),
    ('Maria Elena',     'Rodriguez Lopez',   '23456789', '987654322', 'femenino',  'maria.rodriguez@polleria.com',  2),
    ('Carlos Andres',   'Sanchez Torres',    '34567890', '987654323', 'masculino', 'carlos.sanchez@polleria.com',   3),
    ('Ana Lucia',       'Martinez Rios',     '45678901', '987654324', 'femenino',  'ana.martinez@polleria.com',     4),
    ('Roberto Carlos',  'Flores Mendoza',    '56789012', '987654325', 'masculino', 'roberto.flores@polleria.com',   5),
    ('Patricia Isabel', 'Diaz Castro',       '67890123', '987654326', 'femenino',  'patricia.diaz@polleria.com',    4),
    ('Fernando Jose',   'Torres Vera',       '78901234', '987654327', 'masculino', 'fernando.torres@polleria.com',  6),
    ('Carmen Rosa',     'Ramirez Olivos',    '89012345', '987654328', 'femenino',  'carmen.ramirez@polleria.com',   5),
    ('Javier Alejandro','Gutierrez Prada',   '90123456', '987654329', 'masculino', 'javier.gutierrez@polleria.com', 7),
    ('Luis Alberto',    'Hernandez Cuba',    '01234567', '987654330', 'masculino', 'luis.hernandez@polleria.com',   3);

-- Usuarios
INSERT INTO usuario (roles, nombre_usuario, clave) VALUES
    ('superadmin', 'Roronoa', 'admin123'),
    ('admin',      'Sanji',   'admin456'),
    ('admin',      'Sanji',   'ana2024');

-- ============================================================
--  VERIFICACIÓN
-- ============================================================

SELECT * FROM cargo;
SELECT * FROM empleado;
```

### Diagrama Entidad-Relacion (DER)
Falta integrar

 
### Modelo Relacional (MR)
![MODELO_RELACIONAL](https://raw.githubusercontent.com/ojitoslanda/testing/refs/heads/master/img/db.png)

### Cardinalidades

Las cardinalidades describen cuántos registros de una tabla se relacionan con cuántos de otra.

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

**usuario**
La tabla usuario es independiente. No se relaciona con empleado ni con asistencia.
Representa las cuentas de acceso al sistema (administradores), no a los empleados.




