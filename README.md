# Recetas al mojo

Recetas al mojo es un proyecto destinado al CIFP Zonzamas para el Ciclo Superior de Cocina y Gastronomía, en cuanto a la gestión o elaboración
de recetas con un apartado para la reservación de ésteos en periodos o fechas pautadas.

El objetivo principal del proyecto es que el ciclo cuente con una plataforma donde pueda publicar sus elaboraciones al público en general, con el fin
de que éstos tengan una perspectiva respecto al desarrollo de la educación impartida por CIFP Zonzamas, además de contar con un servicio único y exclusivo
para que los usuarios que accedan a la plataforma puedan ser partícipes de los eventos que se publican en fechas pautadas respecto a los platos publicados en la propia página. 


## Pre-requisitos

Tener en cuenta. Debemos tener instalado:

- Php7.3
- Composer V2.0.8
- Nodejs: V15.6.0
- Mysql


## Preparando el entorno
### PASO 1: Instalación PHP (dependencias adicionales)

Actualizar la caché
```
sudo apt-get update
```
Instalación de paquetes requeridos
```
sudo apt-get upgrade
```
### PASO 2: Descargar e Instalar Composer

Utilizamos Curl para obtener e instalar composer
```
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

### PASO 3: Descargar las dependencias necesarias

· php-xml
```
sudo apt install php7.3-xml
```

· php-mbstring
```
sudo apt-get install php7.3-mbstring
```

· php-mysql
```
sudo apt-get install php7.3-mysql
```

### PASO 4: Instalación de Mysql
Link: https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04-es (Guía de Instalación)

#### Acceso a la Base de Datos
	
* Activar Servicio Mysql 
```
sudo service mysql start
```
* Ingresar como usuario root (sin contraseña)
```
sudo mysql
```
* Eliminar el usuario root
```
drop user root@localhost;
```
* Crear un nuevo usuario con una contraseña
```
CREATE USER 'root'@'localhost' IDENTIFIED BY '1234';
```
* Crear base de datos
```
CREATE DATABASE gourmets;
```
* Otogar todos los privilegios al usuario
```
GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;
```
* Limpiar cache
```
FLUSH PRIVILEGES;
```

PASO 5: Clonando el Proyecto

```
git clone https://github.com/joigrammer/gourmets-recipes/tree/measurement
```

Situarse en la Carpeta del Proyecto e Instalar las dependencias
```
composer update
```

Git por defecto ignora el archivo .env de la configuración del proyecto, pero tendrá un archivo llamado .env.example
donde tendría que realizar una copia del contenido de este archivo y crear un nuevo archivo .env para la respectiva configuración, 
luego, tendrá que ingresar las credenciales de la base de datos como la base de datos en sí como le indica el archivo .env.

Generamos una clave 
```
php artisan key:generate
```

Antes de ejecutar las migraciones comprobamos 
Ejecutamos las migraciones
```
php artisan migrate
```

Ejecutamos los seeders
```
php artisan db:seed
```

Levantamos el servidor

```
php artisan serve
```

## Accedemos al sistema
