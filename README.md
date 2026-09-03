# BioSample | Gestión de Muestras Biológicas

Aplicación web desarrollada en **PHP puro (sin frameworks)** y **Programación Orientada a Objetos (POO)** como parte de las actividades diagnósticas del programa de Análisis y Desarrollo de Software.

## Características Principales
- **Registro de Muestras:** Formulario completo para registrar muestras biológicas y asociarlas a un tipo y responsable.
- **POO y Relaciones:** Implementación de clases independientes (`MuestraBiologica`, `TipoMuestra`, `Responsable`, `GestorMuestras`) aplicando encapsulamiento y composición.
- **Filtros y Búsquedas:** Permite buscar por código, procedencia o responsable, además de filtrar por estado.
- **Manejo de Sesiones:** Persistencia temporal de los registros utilizando `$_SESSION`.
- **Interfaz Moderna:** Diseño responsivo construido con **Bootstrap 5** y Bootstrap Icons.

## Estructura del Proyecto
- `index.php`: Panel principal con listado, búsqueda y filtros.
- `registrar.php`: Formulario de captura y procesamiento por método POST con validaciones.
- `detalle.php`: Vista de detalle individual de cada muestra mediante GET.
- `classes/`: Clases lógicas y de entidad del sistema.
- `includes/`: Cabeceras y pies de página reutilizables (`include`/`require`).
