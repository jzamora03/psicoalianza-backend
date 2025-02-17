# psicoalianza-backend

## Instrucciones de uso y descarga del proyecto

- Clonar o descargar el proyecto
- Abrir la terminal, si es en visual studio **CONTROL + Ñ** y poner "**composer install**"
- Crear un archivo nombrado "**database.sqlite**" en el folder de database 
- En la termina ponemos "**cp .env.example .env**" esto para crear el archivo necesario para configurar la base de datos (SI ASI LO DESEA)
- Configuramos la conexión a la base de datos en este caso SQLITE.<br>
**Si es al caso es necesario comentar o eliminar la conexión a MySQL.**<br>
**Copiamos el path de donde tenemos nuestro archivo database.sqlite**<br>
>>DB_CONNECTION=sqlite<br>
DB_DATABASE=C:\Users\jszc0\OneDrive\Escritorio\alianza-proyecto\database\database.sqlite #Cambiar a la ruta correcta del archivo database.sqlite por favor.
DB_FOREIGN_KEYS=true
- Luego hacemos la migración de la base de datos con php artisan migrate
- En dado caso que pida la key, simplemente ponemos en la termina **php artisan key:generate**
- Por ultimo levantamos el servidor de laravel con **php artisan serve**

## Después de ya correr el proyecto por favor:

- Crear los cargos en listas/cargos.
- Luego crear los países y después las ciudades.
- Luego creamos los empleados en Listas/Empleados
- Para asignarle un jefe es editando el empleado ya que la relación que cree es para mostrar en jefes los empleados creados
**TENER EN CUENTA QUE SI EL EMPLEADO ESTA COMO PRESIDETE NO APARECERA PARA ASIGNAR JEFES**
***Tambien se debe tener en cuenta que si una persona tiene el cargo de "Jefe" no aparecerá para asignarle a otra persona y tampoco se le podrá asignar 
jefe a alguien que tenga el rol de presidente**
