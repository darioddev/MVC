<?php
require_once('../config/const.inc.php'); // Incluyo el archivo que contiene las constantes
require_once(URL_MODEL . 'orm.inc.php'); // Incluyo el archivo que contiene la clase ORM
require_once(URL_MODEL . 'libro.inc.php'); // Incluyo el archivo que contiene la clase Libro
require_once(URL_MODEL . 'pelicula.inc.php'); // Incluyo el archivo que contiene la clase Pelicula
require_once(URL_MODEL . 'disco.inc.php'); // Incluyo el archivo que contiene la clase Disco
require_once(URL_LIB .'data.functions.inc.php'); // Incluyo el archivo que contiene la funcion que compara las fechas
$orm = new ORM(); // Creo una instancia de la clase ORM
?>

<?php

// Obtengo un array asociativo de los libros mediante el ORM , con el metodo findAll()
$dataModel = [
    'Libros' => $orm->findAll("Libro"),
    'Peliculas' => $orm->findAll("Pelicula"),
    'Discos' => $orm->findAll("Disco")
];

// Ordeno los arrays por fecha
usort($dataModel['Libros'], 'compareByDate');
usort($dataModel['Peliculas'], 'compareByDate');
usort($dataModel['Discos'], 'compareByDate');
?>

<?php 
    // Creo variables para almacenar las rutas de las imagenes mas recientes y el titulo 
    $libroImg = URL_IMG . 'Libros/' . $dataModel['Libros'][0]['imagen'];
    $libroTitle = $dataModel['Libros'][0]['titulo'];

    $peliculaImg = URL_IMG . 'Peliculas/' . $dataModel['Peliculas'][0]['imagen'];
    $peliculaTitle = $dataModel['Peliculas'][0]['titulo'];

    $discoImg = URL_IMG . 'Discos/' . $dataModel['Discos'][0]['imagen'];
    $discoTitle = $dataModel['Discos'][0]['titulo'];
?>

<?php
require_once(URL_VIEWS . 'home.view.php');
?>
