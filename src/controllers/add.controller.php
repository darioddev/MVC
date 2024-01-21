<?php
require_once('../config/const.inc.php'); // Incluyo el archivo que contiene las constantes
require_once(URL_LIB . 'db.functions.inc.php'); // Incluyo el archivo que contiene las funciones de la base de datos
require_once(URL_MODEL . strtolower($_GET['class']) . '.inc.php'); // Incluyo el modelo que me pasan por parametro
require_once(URL_MODEL . 'orm.inc.php'); // Incluyo el archivo que contiene la clase ORM
require_once(URL_LIB . 'image.functions.inc.php'); // Incluyo el archivo que contiene la funcion que gestiona las imagenes

?>
<?php
$orm = new ORM(); // Creo una instancia de la clase ORM
$class = $_GET['class']; // Obtengo la clase que me pasan por parametro

// Juntamos las propiedades de la clase padre y de la clase hija
// mediante la funcion array_merge() , que une dos o mas arrays llamando a la funcion getPropiedadesEspecificas()
// obteniendo un array con las propiedades de la clase padre y de la clase hija
$propiedades = array_merge(
    // Obtenemos las propiedades de la clase padre que en este caso son las claves del array asociativo
    array_keys(getPropiedadesEspecificas(new $class)['Todos']),
    // Obtengo el array con los nombres de las propiedades de la clase hija , mediante la clase recibida por parametro
    getPropiedadesEspecificas(new $class)[ucfirst($class)]
);

//Compruebo si alguno de los botones del formulario ha sido pulsado
if (isset($_POST["addModel"])) {
    // Creo un objeto de la clase recibida por parametro
    $object = new $class();

    $imagen = handleImageUpload($class, 'imagen' , '../../' . URL_IMG); //Llamo al metodo de imagenes para subir la imagen

    if (!$imagen) { // Si la imagen no se ha subido correctamente
        // Redirijo a la pagina de home
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    //Recorro el array del objecto de la clase y mediante el setter asigno los valores al objeto
    foreach ($_POST as $key => $value) {
        if ($key != 'addModel') {
            $object->{'set' . ucfirst($key)}($value);
        }
    }
    $object->setImagen($imagen); // Inserto la imagen en el objeto
    $orm->persist($object); // Inserto el objeto en la base de datos

    // Redirijo a la pagina de la clase 
    $redirect = '/' . explode("/", $_SERVER["REQUEST_URI"])[1] . '/' . $class . 's';
    header("Location: " . $redirect); // Redirijo a la url obtenida por parametro
}
?>
<?php require_once(URL_VIEWS . 'add.view.php'); //Incluyo la vista ?>