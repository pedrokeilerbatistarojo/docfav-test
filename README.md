# Docfav Prueba Técnica

## Instalación y Ejecución
1. Clonar el repositorio:
   ```sh
   git clone <repo-url>
   cd <repo-name>
   ```
2. Construir y levantar los contenedores con Docker:
   ```sh
   make build
   make up
   ```
3. Ejecutar migraciones de base de datos:
   ```sh
   make migrate
   ```
4. Probar la API:
   ```sh
   curl -X POST http://localhost:8080/register -H "Content-Type: application/json" -d '{"name": "John Doe", "email": "john@example.com", "password": "SecurePass123!"}'
   ```

## Pruebas
Para ejecutar las pruebas unitarias y de integración:
```sh
make test
