<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


## Lenguajes Usados

- PHP
- JS

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Frameworks usados

- Laravel [documentation](https://laravel.com/docs).

## Motor de Base de Datos

- MySql

## Módulos principales

Módulos de Composer utilizados
- [overtrue/laravel-like](https://github.com/overtrue/laravel-like)
- [twbs/bootstrap:4.0.0](https://github.com/twbs/bootstrap)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)

## Librerias utilizadas

- Bootstrap 4
- JQuery
- Ajax
- Popper
- Font-awesome

## Instrucciones
1) Crear una base de datos bajo el nombre "laravel" en MySql.

2) En la carpeta raiz del proyecto ejecutar los siguientes comandos
- php artisan serve (Una vez ejecutado acceder a la pagina por **localhost:8000**)

3) En otra consola ejecutar los siguientes comando, también en la carpeta raíz del proyecto:
- php artisan migrate (crea las tablas nesecarias de la aplicación)
- php artisan db:seed --class=UserSeeder (inyecta las tablas con los datos necesarios)

4) Listo para usar

## Comandos Opcionales
- php artisan db:seed --class=AdminSeeder (Inyecta un nuevo Administrador)
- php artisan db:seed --class=UsuarioSeeder (Inyecta un nuevo Usuario)

Las cuentas creadas con los comandos anteriores tienen como contraseña: **password**

Por default, crea dos usuarios:
- Admin.

E-mail: admin@admin.com

Password: Administrador
- Usuario.

E-mail: usu@usu.com

Password: Soyunusuario

## Aclaraciones

En total, son tres usuarios con permisos distintos:

- Invitado: solo puede ver las publicaciones, los comentarios y los likes del mismo.

- Usuario: ABM de las publicaciones. Baja y modificación solo de las publicaciones propias. Puede dar like y comentar publicaciones.

- Administrador: ABM de todas las publicaciones de los usuarios.

En el archivo **.env** que se encuetra en la raiz del proyecto, se configura al servidor que apunta:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

Es esta ejemplo de configuración, es necesario tener creada una base de datos bajo el nombre de "laravel"