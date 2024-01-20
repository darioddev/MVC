<?php
require_once('../config/const.inc.php'); // Incluyo el archivo que contiene las constantes
$arrBasename = explode("/", $_SERVER["REQUEST_URI"]);
//... nos quedamos los dos primeros parámetros que son la raíz de nuestra aplicación
$ruta = "/" . $arrBasename[1] . "/";
?>
<?php 
    require_once(URL_VIEWS . 'nav.inc.php'); // Incluyo el archivo que contiene la funcion que genera la vista
?>

