# Rick & Morty Explorer (Laravel)

Trabajo Práctico Obligatorio N.º 2 — Desarrollo de Aplicaciones Web, TUTI, UTN FRSF.

Aplicación web para explorar personajes, episodios y ubicaciones de Rick and Morty,
construida sobre la base de datos del TP1. Los usuarios registrados pueden crear listas
personalizadas.

## Estado actual

- [x] Explorador público de personajes y episodios (paginación, filtros, detalle)
- [x] Registro e inicio de sesión (Laravel Breeze)
- [x] Modelo de datos completo (migraciones) y carga inicial (seeder)
- [ ] Explorador de ubicaciones
- [ ] Gestión de listas personalizadas

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL o MariaDB (por ejemplo, el de XAMPP)

## Instalación

1. Clonar el repositorio e ingresar a la carpeta:

   ```bash
   git clone https://github.com/USUARIO/rickandmorty-app2.git
   cd rickandmorty-app2
   ```

2. Instalar dependencias:

   ```bash
   composer install
   npm install
   ```

3. Crear el archivo de configuración y la clave de la aplicación:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Crear una base de datos vacía en MySQL:

   ```sql
   CREATE DATABASE rickandmorty_app2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

5. Revisar en `.env` los datos de conexión (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
   Con XAMPP por defecto el usuario es `root` y la contraseña está vacía.

6. Crear las tablas y cargar los datos iniciales:

   ```bash
   php artisan migrate --seed
   ```

   Esto carga 826 personajes, sus episodios y ubicaciones desde
   `database/seeders/data/datos.sql` (datos del TP1). No requiere internet.

## Ejecución

Abrir dos terminales en la carpeta del proyecto:

```bash
npm run dev          # compila estilos; dejar corriendo
php artisan serve    # servidor en http://localhost:8000
```

Con Laravel Herd no hace falta `php artisan serve`: el sitio queda en
`http://<nombre-de-la-carpeta>.test`.

## Qué probar

| URL | Descripción |
|---|---|
| `/personajes` | Listado paginado con búsqueda por nombre y filtro por estado |
| `/personajes/{id}` | Detalle con origen, ubicación y episodios |
| `/episodios` | Listado paginado con filtro por temporada |
| `/episodios/{id}` | Detalle con los personajes que aparecen |
| `/register` y `/login` | Registro e inicio de sesión |

## Reiniciar la base de datos

```bash
php artisan migrate:fresh --seed
```

Borra todas las tablas, las recrea y vuelve a cargar los datos.

## Problemas frecuentes

- **Página sin estilos:** falta ejecutar `npm run dev`.
- **Error de conexión a la base:** MySQL apagado, o la base no existe, o el `.env` no coincide.
- **`Class ... not found` tras actualizar:** ejecutar `composer install`.