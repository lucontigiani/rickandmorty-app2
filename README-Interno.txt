# Rick & Morty Explorer (Laravel)

Trabajo Práctico Obligatorio N.º 2 — Desarrollo de Aplicaciones Web, TUTI, UTN FRSF.

Aplicación web para explorar personajes, episodios y ubicaciones de Rick and Morty,
construida sobre la base de datos del TP1. Los usuarios registrados pueden crear listas
personalizadas.

# Guía de prueba para tu compañero

Antes de mandársela, un paso previo tuyo: como el repositorio es **privado**, tu compañero tiene que tener acceso. En GitHub: repositorio → **Settings** → **Collaborators** → **Add people**, y poné su usuario. Le llega una invitación por mail que debe aceptar.

Después le podés pasar este mensaje tal cual:

---

## Probar el proyecto Rick & Morty Explorer

**Objetivo:** instalar el proyecto desde cero, como lo haría quien lo corrige, y avisarme si algo falla. Usá una carpeta nueva y una base de datos nueva, así no se mezcla con nada tuyo.

### Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL o MariaDB encendido (por ejemplo, el de XAMPP)

Comprobalo con `php -v`, `composer -V`, `node -v` y `npm -v`. Los cuatro tienen que mostrar una versión.

### 1. Clonar e instalar

```bash
git clone https://github.com/TU_USUARIO/rickandmorty-app2.git
cd rickandmorty-app2
composer install
npm install
```

### 2. Configuración

Crear el archivo `.env` a partir del de ejemplo y generar la clave:

```bash
cp .env.example .env          # Windows (cmd): copy .env.example .env
php artisan key:generate
```

Abrir `.env` y comprobar que estas líneas coincidan con tu MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rickandmorty_app2
DB_USERNAME=root
DB_PASSWORD=
```

Con XAMPP, el usuario es `root` y la contraseña está vacía. Si tu MySQL tiene contraseña, ponela ahí.

### 3. Crear la base de datos vacía

En MySQL Workbench, phpMyAdmin o la terminal de MySQL:

```sql
CREATE DATABASE rickandmorty_app2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Crear las tablas y cargar los datos

```bash
php artisan migrate --seed
```

Tienen que aparecer todas las migraciones con `DONE` y al final `RickAndMortySeeder ... DONE`. No hace falta internet para este paso.

### 5. Compilar estilos y arrancar

```bash
npm run build
php artisan serve
```

Abrir `http://localhost:8000`.

### 6. Qué probar

Marcá cada punto como bien o mal:

**Sin iniciar sesión**
- [ ] El inicio muestra los totales de personajes, episodios y ubicaciones (826 personajes).
- [ ] `/personajes`: 20 por página, paginación, búsqueda por nombre y filtro por estado.
- [ ] El detalle de un personaje muestra origen, ubicación y episodios, y el origen y la ubicación son enlaces.
- [ ] `/episodios` y `/ubicaciones`: listado paginado, filtros y detalle con enlaces entre sí.
- [ ] No aparecen botones de "Agregar a lista" ni "Mis listas".
- [ ] `/listas` redirige a `/login`.

**Con sesión**
- [ ] Registrar un usuario nuevo en `/register`; después del registro se llega al inicio.
- [ ] Cerrar sesión y volver a ingresar.
- [ ] Crear una lista de personajes y una de episodios.
- [ ] Crear otra con el mismo nombre: debe mostrar un error de validación.
- [ ] Desde el detalle de un personaje, agregarlo a una lista; agregarlo dos veces no lo duplica.
- [ ] En un personaje solo aparecen las listas de personajes (y en un episodio, las de episodios).
- [ ] Abrir la lista, entrar a un elemento desde ella y quitarlo.
- [ ] Editar el nombre de una lista y eliminar una lista.

**Seguridad**
- [ ] Con un segundo usuario (ventana privada), abrir la lista de otro usuario por URL (por ejemplo `/listas/1`): debe dar **404**.

### 7. Qué me tenés que informar

Para cada fallo: qué hiciste, qué esperabas, qué pasó, y el **mensaje de error completo** (de la terminal o de la pantalla). Una captura ayuda.

Si algo falla en la instalación, decime en qué paso y qué versión de PHP y de Composer tenés.

---

## Problemas que puede encontrar

| Síntoma | Causa probable |
|---|---|
| `could not find driver` | Falta la extensión `pdo_mysql` de PHP |
| Error de conexión a la base | MySQL apagado, base inexistente o datos del `.env` distintos |
| `No application encryption key` | Falta `php artisan key:generate` |
| Página sin estilos | Falta `npm run build` |
| `file_get_contents ... datos.sql` | El archivo de datos no está en el repositorio |
| `composer install` falla por la versión de PHP | PHP menor a 8.2 |

## Si usa Laravel Herd

Puede clonar el proyecto dentro de su carpeta de Herd y no hace falta `php artisan serve`: el sitio queda en `http://rickandmorty-app2.test`. El resto de los pasos es igual.

## Qué hacer con lo que encuentre

Cada fallo es información útil: algo que en tu equipo funciona por estar instalado o configurado a mano, y que en un equipo limpio no. Pasámelo y lo corregimos antes de la entrega, y de paso lo anotamos en el informe como evidencia de que el proyecto se probó en otro entorno.