.PHONY: build up down migrate test

# Construir los contenedores
build:
	docker-compose build

# Levantar los contenedores en segundo plano
up:
	docker-compose up -d

# Detener y eliminar los contenedores
down:
	docker-compose down

# Ejecutar migraciones de base de datos con Doctrine
migrate:
	docker-compose exec docfav-test-app-backend-1 php vendor/bin/doctrine orm:schema-tool:update --force

# Ejecutar pruebas con PHPUnit
test:
	docker-compose exec docfav-test-app-backend-1 php vendor/bin/phpunit tests
