# proteccion-pruebas

# antes de subir el repositorio

# 1 cambiar el entorno de desarrollador a produccion del backend
    # modificar el archvio .env APP_ENV=prod APP_DEBUG=0

# 2 compilar el frontend y prepara para el entorno de produccion "ng build --prod"
    # carpeta dist/proteccionbackend la carpeta compilada de angular

# 3 subir al repositorio github

# una ves este listo el repositorio en produccion

# 1 instalacion del sistema operativo o montar el servidor web en cloud

# 2 instalacion del servicio web (apache2 , ngnx, xaamp)

# 3 se instala php 7.2

# 4 configuracion del entorno web
    # modificar el archivo de configuracion apache /etc/apache2/apache2.conf
    # crear un nuevo archivo de host virtual en /etc/apache2/sites-available
    # habilitar los sitios virtuales con el comando a2ensite "nombre del archivo"
# 5 se descargar el repositorio "git clone"

# 6 se descargar los complementos de symfony con el comando "composer update" "vendors"

# 7 se configura el direccionamiento de la carpeta backend y el directorio de la aplicacion backend en el servidor web (apache , ngnx, xaamp)
    # permisos de acceso al public/index.php "chmod 755"

# 8 se configura el direccionamiento de la carpeta frontend y el directorio de la aplicacion frontend en el servidor web (apache , ngnx, xaamp)
    # permisos de acceso al index.html "chmod 755"
