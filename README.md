<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<h3>
  🚀 Sobre el proyecto
</h3> 

<p> 
Elaboración de una API REST usando PHP con Laravel 8 utilizando SANCTUM. Se elaboró dos tablas, uno para usuarios y productos, ambos con CRUD.  Por lo tanto, podrá realizar las peticiones a la API atreves POSTMAN o INSOMNIA. El proyecto solo funciona de forma local. Como resultado, las peticiones serán atreves del localhost con el puerto correspondiente de su máquina.
<br><br>
Así mismo tiene un apartado en la web para mostrar el consumo del API, pero no está completo.
</p>

<h4>Módulos implementados:</h4>
<h5>Nivel Publico</h5>
<ul>   
<li>Crear Usuarios</li>
<li>Autenticación</li>
<li>Recuperar cuenta</li>
<li>Restablecer Contraseña</li>
</ul>

<h5>Nivel Autenticación SACTUM</h5>
<ul>   
<li>Perfil de usuario</li>
<li>Actualizar usuario</li>
<li>Eliminar usuario</li>
<li>Cerrar sesión</li>
<li>Crear producto</li>
<li>Mostrar producto</li>
<li>Mostrar producto por id</li>
<li>Actualizar producto</li>
<li>Eliminar producto</li>
</ul>

<h3>
  🚀 Instalación proyecto
</h3> 
<br>
<p>1. Abrir una terminal en su ordenador <br>
    git clone https://github.com/dmarquezsv/backend_developer.git
</p>

<P>2. Buscamos la carpeta <b>backend_developer</b></P>


<P>3. Una vez dentro del proyecto ejecutamos <b>composer install</b></P>


<P>4.Creamos la base de datos <b>sql_backend_developer</b>  Tipo <b>utf8mb4_general_ci</b></P>


<P>5.	Credenciales de base de datos:<br>
a.	DB_USERNAME : root<br>
b.	DB_PASSWORD: sin contraseña<br>
</P>

<P>6.	Luego corremos el comando <b>php artisan migrate</b></P>

<P>7.	Por último, ejecutamos el proyecto <b>php artisan serve</b></P>

<P>8.	Verificamos donde se ejecutando el proyecto<br>
    a.	Starting Laravel development server: http://127.0.0.1:8000<br>
    La cual equivale al http://localhost:8000
</P>

<p>
9.	Creamos un usuario para comprobar si todo se encuentra en orden en insomia
Utilizamos el método crear usuario
</p>
<p> POST: http://localhost:8000/api/v1/admin/users/register </p>

```shell
 { 
    "name" : "Daniel Marquez",
	"phone": "22114238",
	"birthdate": "1999-02-20",
	"username":"dmarquezsv",
	"email":"demo@gmail.com",
	"password":"12345678",
	"password_confirmation":"12345678"

 }
```
<p>RESPUESTA 200</p>

```shell
 {
	"status": 1,
	"msg": "Usuario creado exitosamente!"
}

```
<p>Finalmente, para comprobar puede iniciar sesión con el usuario creado. <br>
Documentación del api se adjuntó en el correo electrónico.
</p>





