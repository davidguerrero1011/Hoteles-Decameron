<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🏨 Hoteles Decameron - Sistema de Gestión Hotelera

Bienvenido al sistema de gestión hotelera solicitado por el gerente de operaciones. Esta aplicación permite registrar hoteles, sus datos tributarios y configurar habitaciones según reglas definidas por tipo y acomodación.

---

## 🚀 Descripción del proyecto

El sistema permite:

- Registrar hoteles con nombre, dirección, ciudad, NIT y número de habitaciones.
- Asignar **tipos de habitación** con su respectiva **acomodación**, respetando estas reglas:

| Tipo de habitación | Acomodaciones válidas         |
|--------------------|-------------------------------|
| Estándar           | Sencilla, Doble               |
| Junior             | Triple, Cuádruple             |
| Suite              | Sencilla, Doble, Triple       |

- Validaciones clave:
  - No superar la cantidad de habitaciones declaradas por hotel.
  - No repetir hoteles.
  - No repetir combinaciones de tipo + acomodación en el mismo hotel.

---

## 🧰 Tecnologías utilizadas

- **Backend:** Laravel 10 (PHP 8+)
- **Frontend:** React 18 + Vite
- **Base de datos:** PostgreSQL
- **Diseño:** Bootstrap 5 (responsive)
- **Testing:** PHPUnit
- **CI/CD:** GitHub Actions
- **Despliegue:**  (Frontend)
- **Documentación API:** Postman (archivo incluido)

---

## 🧱 Arquitectura y diseño

### 🔁 Patrones aplicados

- **Repository**: para desacoplar el acceso a datos.
- **Service Layer**: para aislar la lógica de negocio.
- **Inversión de dependencias** con bindings en `AppServiceProvider`.
- **Principio de responsabilidad unica** Clases, Controladores, Servicios y Repositorios.
---

### 📦 Estructura de carpetas

app/
├── Http/Controllers/
│ └── HotelController.php
├── Services/
│ └── HotelService.php
├── Repositories/
│ ├── HotelRepositoryInterface.php
│ └── Eloquent/
│ └── HotelRepository.php


📘 Documentación incluida
    * Diagrama UML (en docs/uml_diagram.png)
    * Archivo postman_collection.json para probar los endpoints
    * Dump de la base de datos: database/dumps/hotel_manager_dump.sql


🧪 Pruebas
php artisan test


🖥️ Despliegue
    * Backend (API):
    * Frontend (React):


📦 Instalación local

    1. Clona el proyecto
        * Backend
            git clone https://github.com/davidguerrero1011/Hoteles-Decameron.git
            cd hotel-manager
        
        * Frontend
            git clone https://github.com/davidguerrero1011/Decameron.git
            cd decameron
    
    2. Configura el Backend (Laravel)

        cd backend
        * Linux
            cp .env.example .env

        * Windows
            copy .env.example .env
        
        composer install
        php artisan key:generate

        # Configura tu conexión PostgreSQL en .env
        php artisan migrate --seed
        php artisan serve

    3. Configura el Frontend (React)
        cd frontend

        * Linux
            cp .env.example .env
        
        * Windows
            copy .env.example .env
            
        npm install
        npm run dev

    
    👨‍💻 Autor
        Wilmar David Macias Guerrero
        Desarrollador Backend PHP - Laravel
        GitHub: @davidguerrero1011
        Correo: davidguerrero0709@gmail.com

📄 Licencia
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
