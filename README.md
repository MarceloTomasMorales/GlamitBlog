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

## Librerias utilizadas

- Bootstrap 4
- JQuery
- Ajax
- Popper
- Font-awesome

## Instrucciones
En la carpeta raiz del proyecto ejecutar el siguiente comando
- php artisan migrate (crea las tablas nesecarias de la aplicacion)
- php artisan db:seed --class=UserSeeder (inyecta las tablas con los datos necesarios)

## Opcional
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

- Usuario: ABM de las publicaciones. Baja y modificacion solo de las publicaciones propias. Puede dar like y comentar publicaciones.

- Administrador: ABM de todas las publicaciones de los usuarios.
