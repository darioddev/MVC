<?php
require_once('../config/const.inc.php'); // Incluyo el archivo que contiene las constantes
require_once(URL_MODEL . 'orm.inc.php'); // Incluyo el archivo que contiene la clase ORM
require_once(URL_MODEL . 'libro.inc.php'); // Incluyo el archivo que contiene la clase Libro
require_once(URL_LIB . 'pag.functions.inc.php'); // Incluyo el archivo que contiene la funcion que genera la paginacion
?>

<?php
$orm = new ORM(); // Creo una instancia de la clase ORM
$libros = $orm->findAll('Libro'); // Obtengo un array asociativo de los libros mediante el ORM , con el metodo findAll()
$redirect = '/' . explode("/", $_SERVER["REQUEST_URI"])[1] . '/'; // Obtengo la ruta de la url

// Compruebo si alguno de los botones de la tabla ha sido pulsado
if (isset($_POST['action'])) {
    $libro = DatabaseFunctions::findId($orm, $_POST['id'], 'Libro'); // Obtengo el libro mediante el ORM , con el metodo findId()
    $urlEdit = $redirect . 'Editar/Libro/' . $_POST['id']; //Url de redirrecion a editar , con el id del libro
    DatabaseFunctions::updateStateClass($orm, $_POST['action'], $libro, $redirect. "Libros" , $urlEdit); // Actualizo el estado del libro mediante el ORM , con el metodo updateStateClass()
}

// Obtengo del array los elementos que tengan estado de boolean true
$librosActivos = array_filter($libros, function ($libro) {
    return $libro['estado'] == true;
});

// Obtengo del array los elementos que tengan estado de boolean false
$librosInactivos = array_filter($libros, function ($libro) {
    return $libro['estado'] == false;
});

$totalPaginas = ceil(count($libros) / ELEMENTOS_POR_PAGINA); // Numero total de las paginas
$paginaActual = isset($_GET['page']) ? $_GET['page'] : 1; // Obtengo la pagina actual

mostrarElementosPagina($libros, $totalPaginas, $paginaActual); // Muestro los elementos de la pagina actual
?>

<?php
$heads = ["TITULO", "AÑO", "GENERO", "IMAGEN", "ESTADO", "AUTOR", "EDITORIAL", "ISBN", "ACCIONES"]; // Cabecera de la tabla
$rutaCSS = (isset($_GET['page'])) ? "../src/assets/css/index.css" : "./src/assets/css/index.css"; // Ruta del css
$URL = (isset($_GET['page']) ? "." . URL_IMG : URL_IMG); // Ruta de la imagen
?>

<?php
require_once(URL_VIEWS . 'libros.view.php'); // Incluyo el archivo que contiene la funcion que genera la vista
?>