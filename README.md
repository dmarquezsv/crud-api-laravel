# 🚀 Elaboración de una API REST con Laravel 8 y Sanctum

Este proyecto consiste en una API REST elaborada con Laravel 8 y Sanctum, que permite realizar operaciones CRUD en dos tablas: usuarios y productos. Las peticiones a la API pueden realizarse mediante herramientas como POSTMAN o INSOMNIA, y el proyecto funciona de manera local, a través del puerto correspondiente de la máquina.

Además de las operaciones CRUD básicas, se han implementado diferentes módulos de autenticación y seguridad, tanto para usuarios públicos como autenticados a través de Sanctum. Entre los módulos disponibles se encuentran:

# 🌐 Nivel público
- Crear usuarios
- Autenticación
- Recuperar cuenta
- Restablecer contraseña

# 🔒 Nivel autenticación Sanctum
- Perfil de usuario
- Actualizar usuario
- Eliminar usuario
- Cerrar sesión
- Crear producto
- Mostrar producto
- Mostrar producto por ID
- Actualizar producto
- Eliminar producto

### Dependencias/Requisitos previos
Para instalar el sistema, es necesario contar con PHP,composer y mysql , se puede utilizar XAMPP para ello.

## Instalación / Primeros pasos

1 - Abrir la terminal de Git Bash y clonar el repositorio con el siguiente comando:
```shell
git clone git clone https://github.com/dmarquezsv/crud-api-laravel.git
cd crud-api-laravel/
```
2 - Ejecutar el comando composer install para instalar las dependencias del proyecto.
```shell
composer install
code .
```
3 - Crear una base de datos llamada sql_backend_developer, con codificación utf8mb4_general_ci.
<br><br>
4- Configurar las credenciales de la base de datos en el archivo .env. Los valores por defecto son:

```shell
DB_USERNAME=root
DB_PASSWORD=
```
5 - Ejecutar el comando php artisan migrate para crear las tablas en la base de datos.

```shell
php artisan migrate
```
6 - Finalmente, ejecutar el proyecto con el comando php artisan serve. El servidor de desarrollo de Laravel estará disponible en la siguiente dirección:
```shell
php artisan serve
http://localhost:8000
```
7 - Para comprobar el funcionamiento del proyecto, se puede crear un usuario a través de INSOMNIA o POSTMAN, utilizando la siguiente URL y el formato de JSON correspondiente:
<br>
Consulta
```shell
POST http://localhost:8000/api/v1/admin/users/register
```

Body

```shell
{ 
    "name": "Daniel Marquez",
    "phone": "22114238",
    "birthdate": "1999-02-20",
    "username": "dmarquezsv",
    "email": "demo@gmail.com",
    "password": "12345678",
    "password_confirmation": "12345678"
}
```
Si todo está en orden, se debería obtener una respuesta HTTP 200 con el siguiente JSON:
```shell
{
    "status": 1,
    "msg": "Usuario creado exitosamente!"
}
```

Para obtener más información sobre la documentación de la API, puede revisar el manual adjuntado en el proyecto como tambien la colección de consulta.




