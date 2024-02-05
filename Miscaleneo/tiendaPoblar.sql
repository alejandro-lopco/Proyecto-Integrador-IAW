/*
    Este sql va a ser para poblar la base de datos con informacion
    real sobre los productos . 
*/
-- Poblar la tabla proveedores con datos ficticios
USE tienda;
INSERT INTO proveedores (nombre, tlf, pais, dir, mail)
VALUES
('Nike', '+123456789', 'Estados Unidos', '5400 E Harris Ave, Las Vegas, NV 89110, Estados Unidos', 'nikeus@mail.com'),
('Snkrs', '+987654321', 'España', 'Av. Río Guadalquivir, s/n, 28906 Getafe, Madrid', 'snkrsspain@mail.com'),
('Shen Zhen Jia Yu Electronic Co', '+1122334455', 'China', '156-1 Wanxing Rd, 156, Babu District, Hezhou, Guangxi, China, 542801', 'pShenzhen@mail.com');
-- Poblar la tabla usuarios
INSERT INTO usuarios (nombreLogin, passLogin, userName, userApe, mail, dir)
VALUES
('cliente', 'cliente123', 'Pedro', 'Garcia', 'upedrogar777@mail.com', 'C. de S. Cipriano, 67, Vicálvaro, 28032 Madrid'),
('empleado', 'empleado123', 'Alvaro', 'Miron', 'alvaromi555@mail.com', 'C. de Minerva, 35, Vicálvaro, 28032 Madrid'),
('administrador', 'admin123', 'Ivan', 'Barchin', 'ivanbar123@mail.com', 'Av. de Daroca, 321, Vicálvaro, 28032 Madrid');
-- Poblar la tabla productos con datos ficticios
INSERT INTO productos (nombre, precio, categoria, stock, idProveedor, imagenURL)
VALUES
('Jordan 4 UNC', 389.99, 'Deportivas', 50, 1, 'jordan4unc.jpg'),
('Jordan 4 Black Cat', 899.99, 'Deportivas', 30, 1, 'jordan4blackcat.jpg'),
('Jordan 4 SB', 399.99, 'Deportivas', 20, 1, 'jordan4sb.jpg'),
('Jordan 1 Lost N Found', 339.99, 'Deportivas', 40, 1, 'jordan1lost.jpg'),
('Jordan 1 UNC', 449.99, 'Deportivas', 25, 1, 'jordan1unc.jpg'),
('Jordan 1 Shadow', 339.99, 'Deportivas', 15, 1, 'jordan1shadow.jpg'),
('Airmax 95 OG Crystal Blue', 799.99, 'Casuales', 35, 1, 'airmax95.jpg'),
('Airmax Tailwind Skepta', 399.99, 'Skate', 28, 1, 'airmaxtailwind.jpg'),
('Nike Dunk Court Purple', 199.99, 'Skate', 22, 1, 'nikedunkpurple.jpeg'),
('Nike Dunk Blue Lobster', 1999.99, 'Skate', 1, 1, 'nikedunklobster.jpg'),
('Nike Air Force 1 Nocta', 249.99, 'Casuales', 33, 1, 'airforce1nocta.jpg'),
('Nike Dunk Powepuff Girls Blue', 349.99, 'Skate', 12, 1, 'nikedunkpowerpuff.jpg');
-- Poblar la tabla pedidos
-- Poblar la tabla pedidos con datos ficticios
INSERT INTO pedidos (cantidad, fechaEntrega, idProducto, idUser, precioUnitario)
VALUES
(1, '2024-02-10', 1, 1, 389.99),
(2, '2024-02-12', 2, 2, 1799.98),
(3, '2024-02-15', 3, 3, 749.97),
(4, '2024-02-18', 4, 1, 3199.96);