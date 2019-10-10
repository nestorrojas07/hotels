

## Crud Listar Hoteles
requerimientos: 
php  > 7.0
composer
git 
npm

Framework usado:
Laravel para Backend
Vue JS para el front

guia de instalacion
crear la base de datos


2. clonar el repositorio en su carpeta de trabajo  git clone git@github.com:nestorrojas07/hotels.git


3 En el $HOME del proyecto ejecutar:
composer install 
composer run post-root-package-install
composer run post-create-project-cmd
4 configure el archivo .env en la raiz de su proyecto para el entorno de producción.

5 ejecutar las migraciones 
php artisan migrate 
 
y luego confirmar

6. ejecutar los seeder
 php artisan db:seed --class='DatabaseSeeder'
confirmar el seeder


7. ejecutar npm
npm -i
Esto instalara los paquetes para el front
8. minificar los json
npm run production

9. Lanzar el servidor php $HOMEPROJECT
php artisan serve --host=0.0.0.0 --port=8000

10. abrir el navegador http://localhost:8000/register y registrase

11. A disfrutar la app

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
