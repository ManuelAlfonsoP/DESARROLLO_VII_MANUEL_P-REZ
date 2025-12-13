creacion de la base de datos:
CREATE DATABASE techparts_db;


Uso de la base de datos para crear la tabla:
USE techparts_db;

CREATE TABLE productos (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(120) NOT NULL,
	categoria VARCHAR(120) NOT NULL,
	precio DECIMAL(10,2) NOT NULL,
	cantidad INT NOT NULL,
	fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Uso de la base de datos para introducir datos iniciales a la tabla:
USE techparts_db;

INSERT INTO productos (nombre, categoria, precio, cantidad) VALUES 
('Teclado', 'perifericos', 12.50, 20),
('Raton', 'perifericos', 7.25, 25),
('Audifonos Surround', 'perifericos', 35.50, 12),
('Alfombra', 'accesorios', 6.50, 40),
('Cable de 3.5mm - 2 metros', 'cables/conexiones', 10.25, 40);