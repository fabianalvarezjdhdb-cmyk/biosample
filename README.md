# BioSample

## Integrantes
- Camilo Sánchez
- Liviston Palacios
- Fabián Álvarez

## Problema que intenta resolver
En los laboratorios de investigación y diagnóstico, el control y la trazabilidad de las muestras biológicas (como sangre, tejidos, cultivos y muestras genéticas) suelen gestionarse de manera manual o dispersa. Esto genera riesgos de pérdida de información, errores en la identificación de procedencias, dificultad en el seguimiento de estados (almacenada, en proceso, analizada, descartada) y pérdida de tiempo al buscar registros específicos por parte del personal responsable.

## Funcionalidades implementadas
- **Registro de muestras:** Formulario web seguro para ingresar nuevas muestras asociándolas a un tipo y a un responsable.
- **Listado general e interactivo:** Visualización tabular de todas las muestras almacenadas en el sistema.
- **Búsqueda y filtros avanzados:** Permite filtrar las muestras de forma dinámica por estado y realizar búsquedas de texto por código, procedencia o nombre del responsable.
- **Consulta de detalles individuales:** Vista detallada de cada muestra mediante paso de parámetros por `GET`.
- **Persistencia en sesión:** Mantenimiento de los datos de las muestras durante toda la navegación mediante `$_SESSION`.
- **Manejo de errores y validaciones:** Alertas visuales para campos obligatorios y validación de códigos duplicados.

## Clases creadas y responsabilidad de cada una
- **`MuestraBiologica`**: Representa la entidad central de la muestra. Almacena atributos como código, procedencia, fecha, estado y se relaciona por composición con el tipo y el responsable.
- **`TipoMuestra`**: Modela las categorías científicas disponibles para clasificar cada muestra biológica.
- **`Responsable`**: Define al investigador o laboratorista a cargo de la muestra (incluyendo cédula, nombre completo y laboratorio).
- **`GestorMuestras`**: Clase lógica encargada de administrar el ciclo de vida del arreglo en sesión (`$_SESSION`), agregando, buscando, filtrando y validando los registros.

## Regla o cálculo principal implementado
El sistema evalúa de manera lógica el estado actual de cada muestra y determina de forma automatizada la clase de diseño visual (insignias de color con `match` en PHP) y valida que no se dupliquen códigos únicos de muestras al momento de procesar el formulario de registro por método `POST`.

## Framework CSS utilizado
- **Bootstrap 5.3.3**: Utilizado para estructurar interfaces responsivas, tarjetas (`cards`), tablas fluidas, barras de navegación oscuras, alertas de validación e insignias de estado con un diseño moderno.

## Instrucciones breves para ejecutar el proyecto
1. Clonar el repositorio en tu entorno local dentro de la carpeta del servidor web (por ejemplo, `htdocs` de XAMPP):
   ```bash
   git clone [https://github.com/fabianalvarezjdhdb-cmyk/biosample.git](https://github.com/fabianalvarezjdhdb-cmyk/biosample.git)
