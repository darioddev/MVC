<?php
require_once('../config/const.inc.php'); // Incluyo el archivo que contiene las constantes
require_once(URL_MODEL . 'orm.inc.php'); // Incluyo el archivo que contiene la clase ORM
require_once(URL_MODEL . 'pelicula.inc.php'); // Incluyo el archivo que contiene la clase Pelicula
require_once(URL_LIB . 'pag.functions.inc.php'); // Incluyo el archivo que contiene la funcion que genera la paginacion
?>

<?php
$orm = new ORM(); // Creo una instancia de la clase ORM
$peliculas = $orm->findAll('Pelicula'); // Obtengo un array asociativo de las peliculas mediante el ORM , con el metodo findAll()
$redirect = '/' . explode("/", $_SERVER["REQUEST_URI"])[1] . '/'; // Obtengo la ruta de la url
// Compruebo si alguno de los botones de la tabla ha sido pulsado
if (isset($_POST['action'])) {
    $pelicula = DatabaseFunctions::findId($orm, $_POST['id'], 'Pelicula'); // Obtengo la pelicula mediante el ORM , con el metodo findId()
    $urlEdit = $redirect . 'Editar/Pelicula/' . $_POST['id']; //Url de redirrecion a editar , con el id de la pelicula
    DatabaseFunctions::updateStateClass($orm, $_POST['action'], $pelicula, $redirect . 'Peliculas' , $urlEdit); // Actualizo el estado de la pelicula mediante el ORM , con el metodo updateStateClass()
}

// Obtengo del array los elementos que tengan estado de boolean true
$peliculasActivas = array_filter($peliculas, function ($pelicula) {
    return $pelicula['estado'] == true;
});

// Obtengo del array los elementos que tengan estado de boolean false
$peliculasInactivas = array_filter($peliculas, function ($pelicula) {
    return $pelicula['estado'] == false;
});


$totalPaginas = ceil(count($peliculas) / ELEMENTOS_POR_PAGINA); // Numero total de las paginas
$paginaActual = isset($_GET['page']) ? $_GET['page'] : 1; // Obtengo la pagina actual

mostrarElementosPagina($peliculas, $totalPaginas, $paginaActual); // Muestro los elementos de la pagina actual
?>

<?php
/* Valores que se mostraran en la tabla que pintaremos en la vista*/
$heads = ["TITULO", "AÑO", "GENERO", "IMAGEN", "ESTADO", "DIRECTOR", "REPARTO", "DURACION", "ISAN", "ACCIONES"] // Cabecera de la tabla
    ?>
<?php
// Incluyo el archivo que contiene la funcion que genera la vista
$rutaCSS = (isset($_GET['page'])) ? "../src/assets/css/index.css" : "./src/assets/css/index.css";
// Comprobamos si existe la variable page en la url , esto es debido a que dependera de donde este situado para mostrar las imagenes
$URL = (isset($_GET['page']) ? "." . URL_IMG : URL_IMG); // Ruta de la imagen
require_once(URL_VIEWS . 'peliculas.view.php'); // Incluyo el archivo que contiene la funcion que genera la vista
?>