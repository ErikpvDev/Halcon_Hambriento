<h1>SPRINT 01</h1>

El objetivo del Sprint 1 fue construir la base esencial del sistema que soportará todo el desarrollo posterior. En esta etapa se definieron los elementos estructurales del proyecto, se creó la base de datos inicial y se implementó el sistema de autenticación con roles, asegurando accesos diferenciados según el tipo de usuario (cliente, camarero, encargado).

Tras crear la estructura basica de toda la página(cabeceras, menus, hojas de estilo,etc..), haciendo una base reutilizable y facilmente modificable.

--- Bases de datos ---

En este sprint se diseño la base de datos que usará el proyecto. Se implementaron tablas para los usuarios, productos,categorias, mesas, pedidos y todas las necesarias.


--- Sistemas de autentificacion y roles ---

Se implemento una interfaz de inicio de sesión y registro.

Una redirección automática según el rol tras el login y variables de sesión.

Un facil cierre de sesión. 


--- Interfaz inicial por rol ---

Cada rol tiene su inicio separado, aun falta implementar las funciones de cada uno, aunque el rol "encargado" ya tiene un panel administrativo.


--- Funciones iniciales del encargado --- 

Gestión de categorías:

    - creación

    - edición

    - eliminación

Gestión de productos:

    - creación

    - edición

    - gestión de stock


--- Resultado --- 

El proyecto dispone de una base sólida para seguir con los siguientes sprints.

Los accesos están controlados.

La base de datos es funcional y puede soportar el flujo de trabajo de un restaurante.

El encargado puede empezar a cargar los productos y las categorias que el sistema usará.
