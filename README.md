# Documentación del Proyecto SkillGrade 2.0

## Introducción
SkillGrade 2.0 es una plataforma diseñada para ayudar a los usuarios a mejorar diferentes habilidades a través de ejercicios interactivos. Estas habilidades incluyen reflejos, tecleo, precisión, visualización y juegos mentales. Además, el sistema ofrece funcionalidades avanzadas como inicio de sesión, tablas de clasificaciones y configuración de dificultades. 🎯🎮✨

---

## Tecnologías Utilizadas

- **Frontend**:
  - HTML5
  - CSS3 (Bootstrap para el diseño responsivo)
  - JavaScript
  - Remix Icons (para íconos visuales)
  - Google Fonts (para personalización tipográfica)

- **Backend**:
  - PHP (para el manejo de lógica del servidor y procesamiento de formularios)

- **Base de Datos**:
  - MySQL (para almacenar usuarios, puntajes y configuraciones)

- **Servidor Local**:
  - XAMPP (para pruebas locales con Apache y MySQL)

---

## Estructura del Proyecto

### Carpetas Principales

- `/` - Raíz del proyecto
  - `index.php` - Página principal
  - `login.php` - Inicio de sesión
  - `register.php` - Registro de usuarios
  - `profile.php` - Perfil del usuario
  - `edit_profile.php` - Edición de perfil

- `/js/` - Archivos JavaScript
  - `reflejos.js` - Lógica para el ejercicio de reflejos
  - `tecleo.js` - Lógica para el ejercicio de tecleo
  - `precision.js` - Lógica para el ejercicio de precisión
  - `visualizacion.js` - Lógica para el ejercicio de visualización
  - `juegos_mentales.js` - Lógica para los juegos mentales

- `/css/` - Archivos CSS personalizados
  - `styles.css` - Estilos personalizados adicionales

- `/php/` - Lógica del servidor
  - `db_config.php` - Configuración de conexión a la base de datos
  - `save_reflejos_score.php` - Guardado de puntajes de reflejos
  - `save_tecleo_score.php` - Guardado de puntajes de tecleo
  - `save_precision_score.php` - Guardado de puntajes de precisión
  - `save_visualizacion_score.php` - Guardado de puntajes de visualización
  - `save_juegos_mentales_score.php` - Guardado de puntajes de juegos mentales

---

## Funcionalidades

### 1. Sistema de Autenticación
- **Registro de Usuario**:
  - Los nuevos usuarios pueden registrarse proporcionando nombre de usuario, correo electrónico y contraseña.

- **Inicio de Sesión**:
  - Los usuarios registrados pueden iniciar sesión.
  - Acceso restringido a la página principal y funcionalidades hasta que se inicie sesión.

- **Edición de Perfil**:
  - Permite a los usuarios actualizar su nombre de usuario y correo electrónico.

### 2. Ejercicios
- Cada habilidad cuenta con **dos o más ejercicios** interactivos:
  - **Reflejos**: Haz clic en un objetivo que aparece de manera aleatoria en el área de juego. 🎯
  - **Tecleo**: Escribe las palabras que se acercan al centro antes de que lleguen. ✍️
  - **Precisión**: Haz clic en el centro de un objetivo en movimiento. 🎯
  - **Visualización**: Memoriza los colores mostrados en bloques que cambian de posición aleatoria. 🎨
  - **Juegos Mentales**: Completa retos lógicos o matemáticos contrarreloj. 🧠

- **Sistema de Dificultades**:
  - Cada ejercicio permite seleccionar un nivel de dificultad (“Fácil”, “Medio”, “Difícil”).
  - La dificultad afecta variables como tiempo límite, velocidad y cantidad de elementos en el juego.

### 3. Tablas de Clasificación
- Los puntajes se almacenan en la base de datos y se muestran en una tabla visible por cada habilidad.
- **Criterios**:
  - Ordenados de mayor a menor puntaje.
  - Mostrar los 10 mejores puntajes globales por ejercicio.

### 4. Perfil del Usuario
- Visualiza información personal y los puntajes obtenidos en cada habilidad.
- Posibilidad de editar datos personales desde esta sección.

---

## Base de Datos

### Estructura de Tablas Principales

#### Tabla: `users`
| Campo      | Tipo         | Descripción                      |
|------------|--------------|----------------------------------|
| `id`       | INT          | Identificador único de usuario  |
| `username` | VARCHAR(50)  | Nombre de usuario               |
| `email`    | VARCHAR(100) | Correo electrónico              |
| `password` | VARCHAR(255) | Contraseña encriptada          |

#### Tabla: `scores`
| Campo      | Tipo         | Descripción                               |
|------------|--------------|-------------------------------------------|
| `id`       | INT          | Identificador único del puntaje          |
| `user_id`  | INT          | Referencia al usuario                     |
| `category` | VARCHAR(50)  | Categoría del ejercicio (reflejos, etc.) |
| `score`    | INT          | Puntaje obtenido                          |
| `date`     | TIMESTAMP    | Fecha y hora del puntaje                  |

---

## Instalación

1. **Clonar el Repositorio**:
   ```bash
   git clone https://github.com/FeloMc1/Skillgrade.git
   ```

2. **Configurar Base de Datos**:
   - Importar el archivo `skillgrade.sql` a MySQL.
   - Editar el archivo `db_config.php` con las credenciales de la base de datos.
   [!note]
   Recuerda cambiar los parametros de la base de datos para tu conexion sql 
   
3. **Configurar el Servidor Local**:
   - Asegurarse de que XAMPP (o equivalente) esté ejecutando Apache y MySQL.
   - Colocar los archivos del proyecto en la carpeta `htdocs`.

4. **Acceder a la Aplicación**:
   - Abrir en el navegador: `http://localhost/skillgrade`

---

## Futuras Mejoras

- Implementar soporte para varios idiomas. 🌍
- Agregar métricas de progreso para cada usuario. 📊
- Mejorar la experiencia visual con animaciones y transiciones más avanzadas. ✨
- Integración con redes sociales para compartir logros. 🔗

---

## Contribuciones
Si deseas contribuir al desarrollo de SkillGrade 2.0, por favor crea un **pull request** en el repositorio oficial o contacta al administrador del proyecto. 🙌

---

© 2025 SkillGrade 2.0. Todos los derechos reservados. 🎉

