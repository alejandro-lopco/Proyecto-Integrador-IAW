# Proyecto-Integrador-IAW
# Autores
- Alejandro López Corral
- Iván Barchín Barrasa
# Introducción
Para el proyecto final de este trimestre se nos ha propuesto avanzar y aumentar las capacidades y funcionalidades del proyecto anterior, el cual fue uno más de aclimatación al desarrollo web con herramientas como PhP y XAMPP. 
En este proyecto se implantará el uso de accesos a Bases de Datos como MariaDB, a continuación se indagará en detalle sobre la organización del equipo de desarrollo y las herramientas utilizadas.
# Funciones Vitales
-   Integración de base de datos (MariaDB/MySQL) con PhP.
    -   Se debe satisfacer y demostrar el uso de las operaciones CRUD.
    -   También se debe hacer de las funcionalidades de sesiones y cookies.
-   Opción multi idiomas.
-   División de usuarios comunes y administrativos.
    -   Las herramientas de administración del servicio deben tener la seguridad suficiente y estar bloqueadas.
# Funciones Adicionales
-   Estilo de página con movimiento y transformaciones de páginas.
-   Servicio de host en un Servidor HTTPS con las herramientas de Apache
# Casos de uso
-   Usuario Básico
    -   El usuario básico solo interactúa con la página mediante la interfaz web del Front-End. 
    -   Podrá navegar el catálogo de productos pero no podrá hacer ninguna compra ya que no tiene una cuenta registrada dentro del sistema.
-   Usuarios Registrado
    -   El usuario registrado tendrá acceso a las funcionalidades no previamente disponibles. 
    -   Cuando decida hacer una compra, la base de datos web recibirá una orden de actualizar el stock y generará una nueva entrada en la tabla de pedidos.
    -   Esto incluye el precio, stock, imagen y nombre. Además de eso tendrá acceso a un apartado restringido donde podrá ver todos los pedidos realizados. 
# Base de Datos Relacional
-   La base de datos se compone de 4 tablas
    -   Usuarios
    -   Productos
    -   Proveedores
    -   Pedidos
