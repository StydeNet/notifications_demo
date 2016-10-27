# Notifications Demo

Este repositorio es el resultado de las lecciones del [curso de Novedades en Laravel 5.3](https://styde.net/curso-de-novedades-en-laravel-5-3/) de [Styde.net](https://styde.net/) donde se explica cómo trabajar con el nuevo sistema de notificaciones de Laravel 5.3 usando el canal base de datos:

* [Notificaciones con el canal base de datos, parte 1](https://styde.net/uso-del-sistema-de-notificaciones-en-la-base-de-datos-en-laravel-5-3-parte-1/) - 24:23
* [Notificaciones con el canal base de datos, parte 2](https://styde.net/uso-de-sistema-de-notificaciones-en-la-base-de-datos-en-laravel-5-3-parte-2/) - 17:23

> Esta aplicación es una demostración del sistema de notificaciones de Laravel y se ofrece solo como una demostración con fines educativos.

## Instalación

Realiza los siguientes pasos:

1. Clonar o descargar este repositorio.
2. Instalar las dependencias de Composer con `composer install`.
3. Crea el archivo .env y agrega las credenciales de base de datos.
4. [Configura el envío de emails de prueba con Mailtrap.io](https://styde.net/como-enviar-emails-de-prueba-con-mailtrap-io-en-laravel/)
5. Generar una API key para la aplicación con `php artisan key:generate`
6. Ejecuta las migraciones y seeders con `php artisan migrate --seed`

## Uso

Este demo tiene 2 tipos de notificaciones:

* `App\Notifications\Follower` que envía una notificación a un usuario cuando tiene un nuevo seguidor.  
* `App\Notifications\PostCommented` que envía una notificación a los usuarios suscritos de un post en específico. Para efectos de este demo los usuarios suscritos a un post son los 5 primeros usuarios de la base de datos generados por el seeder.

Para probar el sistema de notificaciones:

1. Ejecuta `php artisan serve` y navega a [http://localhost:8000](http://localhost:8000)

2. Inicia sesión con email `admin@styde.net` y contraseña `secret`

4. Puedes generar notificaciones de tipo `Follower` con la URL [http://localhost:8000/follow/8/1](http://localhost:8000/follow/8/1) donde 8 es el `id` del usuario seguidor y 1 es el `id` del usuario seguido. 

5. Para generar una notificación  de tipo `PostCommented` visita [http://localhost:8000/comment/1](http://localhost:8000/comment/1) donde 1 es el `id` del post.  Esta notificación tarda en ejecutarse pues envia 1 email a cada usuario suscrito al post.

6. Revisa las notificaciones que ha recibido el usuario conectado en [http://localhost:8000/notifications](http://localhost:8000/notifications)


### [Styde](https://styde.net/)

Styde es una comunidad de desarrollo web en español. Con nosotros podrás aprender Laravel, PHP y otras tecnologías, desde tutoriales básicos gratuitos hasta cursos avanzados a bajo costo, de la mano de profesionales con años de experiencia.

### Otros cursos

**Laravel desde cero**
 -   [Primeros pasos con Laravel 5.*](https://styde.net/curso-primeros-pasos-con-laravel-5/)
 -   [Curso de Laravel 5.1](https://styde.net/curso-introductorio-laravel-5-1/)
 -   [Crea una aplicación con Laravel 5](https://styde.net/curso-crea-aplicaciones-con-laravel-5/)
 -   [Curso básico de Eloquent ORM](https://styde.net/curso-basico-de-eloquent-orm-con-laravel-5-1/)


**Laravel y PHP avanzado**
 -   [Curso de administración de servidores para PHP y Laravel](https://styde.net/curso-configuracion-administracion-de-servidores-php-laravel/)
 -   [Curso avanzado de Eloquent ORM](https://styde.net/curso-avanzado-de-eloquent-orm/)
 -   [Crea componentes para PHP](https://styde.net/curso-crea-componentes-para-php-y-laravel/)
 -   [Interfaces dinámicas con Laravel y jQuery](https://styde.net/curso-de-interfaces-dinamicas-con-laravel-y-jquery/)

**Otras tecnologías**
-   [Curso de Gulp](https://styde.net/curso-gulp-y-herramientas-de-automatizacion/)
-   [Curso de Vue.js](https://styde.net/curso-de-vue-js/)
-	[Curso de Sass](https://styde.net/curso-de-sass/)
-	[Curso básico de Swift](https://styde.net/curso-basico-de-swift/)

© 2016 [Styde.net](https://styde.net/)