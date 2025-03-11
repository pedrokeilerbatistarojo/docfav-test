-- Crear usuario 'docfav-api'
CREATE USER 'docfav-api'@'%' IDENTIFIED BY '!ChangeMe!';

-- Crear base de datos 'docfav-api' y asignar privilegios
CREATE DATABASE IF NOT EXISTS `docfav-api`;
GRANT ALL PRIVILEGES ON `docfav-api`.* TO 'docfav-api'@'%';

