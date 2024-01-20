<?php
// Ver la ruta actual

// Ruta de la carpeta src , donde se encuentran los archivos php de la aplicación
// Bajo al padre debido a que el index.php es un controlador que se encuentra en la carpeta controllers
define('URL_SRC', '../');
define('URL_PUBLIC', './public/');

// Rutas para subdirectorios dentro de src
define('URL_VIEWS', URL_SRC . 'views/');  // Ruta de las vistas
define('URL_LIB', URL_SRC . 'lib/');  // Ruta de las librerías
define('URL_MODEL', URL_SRC . 'model/');  // Ruta de los modelos
define('URL_CONTROLLER', URL_SRC . 'controllers/');  // Ruta de los controladores
define('URL_CONFIG', URL_SRC . 'config/');  // Ruta de los archivos de configuración
define('URL_DB', URL_SRC . 'db/');  // Ruta de la base de datos

define('URL_IMG', URL_PUBLIC . 'images/');  // Ruta de las imágenes
define('ELEMENTOS_POR_PAGINA', 5);  // Número de elementos por página

?>