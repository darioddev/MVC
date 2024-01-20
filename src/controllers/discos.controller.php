<?php
require_once('../config/const.inc.php'); // Incluyo el archivo que contiene las constantes
require_once(URL_MODEL . 'orm.inc.php'); // Incluyo el archivo que contiene la clase ORM
require_once(URL_MODEL . 'disco.inc.php'); // Incluyo el archivo que contiene la clase Disco   
require_once(URL_LIB . 'pag.functions.inc.php'); // Incluyo el archivo que contiene la funcion que genera la paginacion
?>
<?php
$orm = new ORM(); // Creo una instancia de la clase ORM
$discos = $orm->findAll('Disco'); // Obtengo un array asociativo de los discos mediante el ORM , con el metodo findAll()
$redirect = '/' . explode("/", $_SERVER["REQUEST_URI"])[1] . '/'; // Obtengo la ruta de la url

// Compruebo si alguno de los botones de la tabla ha sido pulsado
if (isset($_POST['action'])) {
    $disco = DatabaseFunctions::findId($orm, $_POST['id'], 'Disco'); // Obtengo el disco mediante el ORM , con el metodo findId()
    $urlEdit = $redirect . 'Editar/Disco/' . $_POST['id']; //Url de redirrecion a editar , con el id del disco
    DatabaseFunctions::updateStateClass($orm, $_POST['action'], $disco, $redirect . "Discos", $urlEdit); // Actualizo el estado del disco mediante el ORM , con el metodo updateStateClass()
}

// Obtengo del array los elementos que tengan estado de boolean true
$discosActivos = array_filter($discos, function ($disco) {
    return $disco['estado'] == true;
});

// Obtengo del array los elementos que tengan estado de boolean false
$discosInactivos = array_filter($discos, function ($disco) {
    return $disco['estado'] == false;
});

$totalPaginas = ceil(count($discos) / ELEMENTOS_POR_PAGINA); // Numero total de las paginas
$paginaActual = isset($_GET['page']) ? $_GET['page'] : 1; // Obtengo la pagina actual

mostrarElementosPagina($discos, $totalPaginas, $paginaActual); // Muestro los elementos de la pagina actual
?>
<?php
$heads = ["TITULO", "AÑO", "GENERO", "IMAGEN", "ESTADO", "ARTISTA", "DURACION", "ISWC", "ACCIONES"]; // Cabecera de la tabla 
$rutaCSS = (isset($_GET['page'])) ? "../src/assets/css/index.css" : "./src/assets/css/index.css"; // Ruta del css
$URL = (isset($_GET['page']) ? "." . URL_IMG : URL_IMG); // Ruta de la imagen
// Incluyo el archivo que contiene la funcion que genera la vista
require_once(URL_VIEWS . 'discos.view.php');
?>