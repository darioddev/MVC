<?php
require_once('../config/const.inc.php'); // Incluyo el archivo que contiene las constantes
require_once(URL_MODEL . strtolower($_GET['class']) . '.inc.php'); // Inlcuyo el modelo que me pasan por parametro en la url
require_once(URL_MODEL . 'orm.inc.php'); // Incluyo el archivo que contiene la clase ORM
require_once(URL_LIB . 'image.functions.inc.php'); // Incluyo el archivo que contiene la funcion que gestiona las imagenes
?>

<?php
$orm = new ORM(); // Creo una instancia de la clase ORM
// Obtengo un array asociativo de la clase que me llega por la url mediante el ORM , con el metodo findId()
$object = DatabaseFunctions::findId($orm, $_GET['id'], $_GET['class']);
?>

<?php
// Si no hay ningun id || class en la url , redirijo a la pagina de home
if (!isset($_GET['id']) || !isset($_GET['class'])) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
// Compruebo si alguno de los botones del formulario ha sido pulsado
if (isset($_POST["editar"])) {
    // Actualizo el objeto con los datos del formulario llamando al metodo update() de la clase DatabaseFunctions
    DatabaseFunctions::update($orm, $object, $_POST, '../../' . URL_IMG);
    $home = '/' . explode("/", $_SERVER["REQUEST_URI"])[1] . '/'; // Obtengo la ruta de la url de la raiz
    // Redirijo a la pagina de home , la s es debido a que en la url de la pagina de home , se añade una s al final de la clase , por ejemplo libros -> libros
    header("Location: " . $home . $_GET['class'] . 's');
    exit();
}
?>
<?php
// Incluyo el archivo que contiene la funcion que genera la vista
require_once(URL_VIEWS . 'edit.view.php');
?>
