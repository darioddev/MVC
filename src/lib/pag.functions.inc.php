<?php
/**
 * Manipula el array de elementos mediante referencia para mostrar solo los elementos de la página actual.
 *
 * @param array $array El array de elementos.
 * @param int $totalPaginas El número total de páginas.
 * @param int $paginaActual La página actual.
 */
function mostrarElementosPagina(&$array, $totalPaginas, $paginaActual)
{
    $index = ($paginaActual - 1) * ELEMENTOS_POR_PAGINA; // Obtengo el indice de los elementos a mostrar
    $array = array_slice($array, $index, ELEMENTOS_POR_PAGINA); // Obtengo los discos que se van a mostrar en la pagina actual
}

?>