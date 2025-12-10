CREATE DATABASE ecommerce
use ecommerce;
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio INT NOT NULL,
    vendedor INT NOT NULL,
    inventario INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    url_foto VARCHAR(255),  

    -- llave foranea de usuario, para saber quien creo el articulo
    CONSTRAINT fk_vendedor
        FOREIGN KEY (vendedor)
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

INSERT INTO `products` (`id`, `nombre`, `precio`, `created_at`, `vendedor`, `inventario`, `description`, `url_foto`) VALUES
(1, 'Producto 1 de prueba', 20, '2025-12-10 04:21:59', 'pruebita1', 20, 'inputeando datos directamente para probar la pagina', 'https://picsum.photos/seed/picsum/200/300'),
(2, 'Producto 2 de prueba', 25, '2025-12-10 04:21:59', 'Pruebita2', 30, 'inputeando datos de prueba 2', 'https://picsum.photos/seed/picsum/200/300');