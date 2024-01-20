<?php
// Función de comparación para ordenar por fecha
function compareByDate($a, $b)
{
    // Convertir las fechas a timestamps
    $timestampA = strtotime($a['anio']);
    $timestampB = strtotime($b['anio']);

    // Comparar timestamps
    return $timestampB - $timestampA;
}
?>