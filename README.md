# Prueba tecnica TECNOLOGIAS SINERGIA

![Laravel](https://img.shields.io/badge/Laravel-12.x-ff2d20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php)
![Composer](https://img.shields.io/badge/Composer-2.x-885630?style=for-the-badge&logo=composer)
![Docker](https://img.shields.io/badge/Docker-Configured-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

---

## 🧩 Descripción general

**Sinergia** es una aplicación desarrollada con el framework **Laravel**, bajo el patrón **MVC (Modelo - Vista - Controlador)**,  
que permite la gestión completa de **pacientes**, **usuarios**, **departamentos**, **municipios**, **géneros** y **tipos de documento**.  

El sistema cuenta con autenticación mediante **token JWT**, consumo de API REST y un panel administrativo **responsive** con **Bootstrap 5**.

🔗 **Visualización en línea:**  
👉 [https://ingedev94.com/laravel/public](https://ingedev94.com/laravel/public)

---

## ⚙️ Tecnologías utilizadas

| Categoría | Tecnología | Descripción |
|------------|-------------|--------------|
| Backend | **Laravel 12.x** | Framework PHP moderno y seguro |
| Lenguaje | **PHP 8.2** | Lenguaje principal de desarrollo |
| Frontend | **Bootstrap 5** | Interfaz responsive y moderna |
| Base de datos | **MySQL 8.x** | Almacenamiento relacional |
| Contenedor | **Docker** | Entorno de desarrollo y despliegue |
| Gestor de dependencias | **Composer 2.x** | Manejo de paquetes y autoloading |
| Autenticación | **JWT (JSON Web Token)** | Seguridad en el consumo de API |

---

## 🧱 Arquitectura del proyecto

El proyecto sigue el **patrón de diseño MVC**, organizado de la siguiente forma:

/app
├── Http/
│ ├── Controllers/ → Lógica de controladores
│ ├── Middleware/ → Validaciones y seguridad
│
├── Models/ → Modelos Eloquent ORM
/resources
├── views/ → Vistas Blade (interfaz del usuario)
/routes
├── api.php → Rutas API protegidas por token
├── web.php → Rutas web (frontend)
/database
├── migrations/ → Estructura de tablas
├── seeders/ → Datos iniciales de ejemplo

---

## 🐳 Docker configurado

El proyecto incluye **Docker Compose** preconfigurado para desarrollo.  
Solo necesitas clonar el repositorio y ejecutar:

```bash
docker-compose up -d

Esto levantará automáticamente:

Contenedor de PHP + Laravel

Servidor MySQL configurado

Servicio de phpMyAdmin (opcional)

Configuración persistente del entorno

El archivo docker-compose.yml ya contiene toda la configuración necesaria.
No es necesario editar rutas ni puertos adicionales.
```
# 🔐 Datos de acceso

user : admin@sinergia.com
Password: 123Sinergia.


#Toda la información genera es de prueba por lo tanto no implica ninguna filtración o mala seguridad para la compañia o el proyecto.

Igualmente encontrara el archivo con toda la documentación tecnica.

Desarrollador CARLOS ALEJANDRO MALDONADO LOPEZ
