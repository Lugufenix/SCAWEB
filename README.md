# SCAWEB
Formulario de Registro de Actividades HERRAMIENTAS WEB.

Requerimentos
------------------
1.Sistema operativo Windows de 32 bits.
2.Espacio de memoria minimo de 10MB.
3.XAMPP (Apache y Mysql).


Instalación
-------------------
Desarrollo de un sistema en base a un archivo ccv escogido de la página "Species+" como parte de un proyecto de un curso sobre bases de datos.

Equipo: Los Troyanos

Integrantes:

Martínez Martos Arturo Cesar
Beltrán Villanueva Ibzán
Marquez Valdez Luis
Como instalar el sistema:

PREPARAR LOS ARCHIVOS

1.Descargar "XAMPP" desde https://www.apachefriends.org/es/index.html, será necesario para levantar los servicios requeridos al usar php y bases de datos.
2.Descargar los archivos de este repositorio
3.Una vez descargdos, mover el archivo .rar a la siguiente dirección: c:/xampp/htdocs/
4.Descomprimir el archivo .rar
5.Ubicar el archivo "dbSCAWEB.sql" que esta en la carpeta "BD" dentro de la carpeta que resulto descomprimida.
6.Copiar el archivo a C:/xampp/mysql/bin
7.LEVANTAR LOS SERVICIOS Y LA BASE DE DATOS <--Importante-->
8.Abrir el "Control Panel" de XAMMP
9.Darle click a los servicios de Apache y Mysql "start"
10.Hecho lo anterior prodeceremos a oprimir las teclas "Inicio" + "R"
11.Se abrira una pequeña ventana, escribir "cmd" en ella y pulsar enter
12.Con esto se abrirá la consola de la PC, escribir lo siguiente: "cd c:/xampp/mysql/bin"
13.jecutar la siguiente lista de comandos :
14.mysql -u root
15.Escribir: CREATE DATABASE SCAWEB;
16.Escribir: exit
17. Volvera a la carpeta raíz, escriba lo siguiente: "mysql -u root SCAWEB < BaseDatos.sql", con esto quedará levantada la base de datos y estará lista para usarse.
18. Escribir "exit"
19. USAR EL SISTEMA.

20. Entrar en C:/xampp/htdocs/BD-Species/Templates
21. Abrir el archivo "main.html" en su navegador favorito
22. Borrar toda la ruta anterior a BD-Species/Templates/main.html y reemplazarlo por "localhost"
23. ¡Listo! Podra usar su sistema







