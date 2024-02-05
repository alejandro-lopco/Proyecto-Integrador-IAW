/*
    Script para la creaciónd de la base de datos de la tienda
    El diagrama ER se puede encontrar en el archivo "ER.png"
*/
DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
-- Creación de tablas
USE tienda;
CREATE TABLE usuarios (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    nombreLogin VARCHAR(18) NOT NULL,
    passLogin VARCHAR(18) NOT NULL,
    userName VARCHAR(25) NOT NULL,
    userApe VARCHAR(25) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    dir VARCHAR(200) )
ENGINE=INNODB
DEFAULT CHARSET=utf8mb4;
CREATE TABLE proveedores (
    idProveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tlf VARCHAR(20) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    dir VARCHAR(200) NOT NULL,
    mail VARCHAR(100) NOT NULL )
ENGINE=INNODB
DEFAULT CHARSET=utf8mb4;
CREATE TABLE productos (
    idProducto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    categoria VARCHAR(25) DEFAULT 'Sneaker',
    stock INT NOT NULL,
    idProveedor INT,
    imagenURL VARCHAR(255),
    FOREIGN KEY (idProveedor) REFERENCES proveedores(idProveedor)
    ON DELETE CASCADE 
    ON UPDATE CASCADE )
ENGINE=INNODB
DEFAULT CHARSET=utf8mb4;
CREATE TABLE pedidos (
    idPedido INT AUTO_INCREMENT PRIMARY KEY,
    cantidad INT NOT NULL,
    fechaEntrega DATE NOT NULL,
    idProducto INT NOT NULL,
    idUser INT NOT NULL,
    precioUnitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto)
    ON DELETE CASCADE 
    ON UPDATE CASCADE ,
    FOREIGN KEY (idUser) REFERENCES usuarios(idUser)
    ON DELETE CASCADE 
    ON UPDATE CASCADE )
ENGINE=INNODB
DEFAULT CHARSET=utf8mb4;
