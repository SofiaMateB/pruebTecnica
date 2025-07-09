# Sistema de Gestión de Alquiler de Vehículos
Prueba técnica para Desarrollador PHP Senior. Esta solución implementa una API RESTful usando **Laravel**, conectada a **SQL Server**, totalmente contenida y orquestada con **Docker**.
## 🐳 Configuración Docker
### `Dockerfile`
Incluye PHP 8.2, Apache, Composer y soporte para SQL Server (`pdo_sqlsrv`, `sqlsrv`).  
Se encuentra en la raíz del proyecto.

### `docker-compose.yml`
Orquesta:
- `laravel_app`: contenedor Laravel con Apache
- `db`: contenedor con SQL Server 2019
- `db-init`: inicializador opcional para script SQL (solo si `init-db.sql` crea la base de datos mediante un script)

##  Instrucciones de Ejecución
1. **Clonar el repositorio**
git clone https://github.com/SofiaMateB/pruebTecnica.git

2. **Copiar el archivo de entorno**
cp .env.example .env

3. **Levantar el entorno con Docker**
docker-compose up -d --build

4.**Acceder al contenedor Laravel y ejecutar las migraciones y seeders**
docker exec -it laravel_app bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed

5.**Permisos de carpeta (si falla el log o storage)**
chmod -R 777 storage bootstrap/cache


 **Endpoints de la API**
 Disponibilidad de Vehículos
 **Retorna vehículos no reservados en ese rango.**
 
 
 GET /api/vehicles/available?start_date=2025-07-09&end_date=2025-07-12
 
 **Reserva un vehículo**
 POST /api/vehicles/{id}/reserve
 **Json de prueba**
 {
  "CustomerID": 1,
  "EmployeeID": 1,
  "BranchID": 1,
  "start_date": "2025-07-15",
  "end_date": "2025-07-18",
  "dailyRate": 50
}


**Algoritmos**
**Calcula tarifa dinámica ajustada por demanda, antigüedad, kilometraje y mantenimiento**

GET /api/vehicles/{id}/recommended-rate?start_date=2025-07-10&end_date=2025-07-15

**Sugerencia del vehículo más cercano en caso de no disponibilidad**

GET /api/vehicles/optimized-suggestion?type=SUV&start_date=2025-07-15&end_date=2025-07-20


**Pruebas Unitarias**
**Para ejcutar las pruebas se ejecuta el siguiente comando**
php artisan test


