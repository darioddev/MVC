<?php

/**
 * Funcion que formatea una fecha
 * @param DateTime $dateTime - Fecha a formatear
 * @param string $format - Formato de la fecha
 * @return string - Fecha formateada
 */
function formatDateTime(DateTime $dateTime, string $format = 'Y-m-d H:i:s'): string
{
    return $dateTime->format($format);
}
/**
 * Funcion que crea los placeholders para sentencias preparadas
 * @param array $array - Campos de la tabla
 * @param int $numero - Numero de placeholders
 * @return string - Placeholders de la tabla
 */
function createPlaceholders(array $array, int $numero = 6): string
{
    return implode(',', array_fill(0, count($array) + $numero, '?'));
}

/**
 * Funcion que crea los campos para sentencias preparadas
 * @param array $array - Campos de la tabla
 * @param array $array2 - Campos especificos de la tabla
 * @return string - Campos de la tabla
 */
function createCampos(array $array, array $array2): string
{
    return implode(',', array_merge($array, $array2));
}
/**
 * Funcion que crea una query para sentencias preparadas
 * @param string $table - Nombre de la tabla
 * @param string $campos - Campos de la tabla
 * @param string $placeholders - Placeholders de la tabla
 * @return string - Query
 */
function createQueryInsert(string $table, string $campos, string $placeholders): string
{
    return "INSERT INTO " . $table . " (" . $campos . ") VALUES (" . $placeholders . ")";
}

/**
 * Funcion que obtiene las propiedades especificas de cada clase
 * @param object|null $datos - Objeto de la clase
 * @return array - Propiedades especificas de cada clase
 */
function getPropiedadesEspecificas(object $datos): array
{
    return [
        'Disco' => ['artista', 'duracion', 'iswc'],
        'Pelicula' => ['director', 'reparto', 'duracion', 'isan'],
        'Libro' => ['autor', 'paginas', 'isbn'],
        'Todos' => [
            'Titulo' => $datos->getTitulo(),
            'Anio' => $datos->getAnio(),
            'Publicacion' => $datos->getPublicacion(),
            'Genero' => $datos->getGenero(),
            'Imagen' => (is_null($datos->getImagen())) ? '' : $datos->getImagen(),
            'Estado' => $datos->getEstado()
        ],
    ];
}

/**
 * Funcion que crea los campos para sentencias preparadas
 * @param array $array - Campos de la tabla
 * @return string - Campos de la tabla
 */
function createPlaceholdersUpdate(array $array): string
{
    return implode(' = ?, ', $array) . ' = ?';
}

/**
 * 
 * Funcion que crea una query para sentencias preparadas
 * @param string $table - Nombre de la tabla
 * @param string $campos - Campos de la tabla
 */
function createQueryUpdate(string $table, string $campos): string
{
    return "UPDATE " . $table . " SET " . $campos . " WHERE id = ?";
}


/**
 * Funcion que devuelve un array asociativo clave - valor con los atributos del objeto
 * @param object $object - Objeto del que queremos obtener los atributos y el valor de estos
 * @return array - Array con los atributos del objeto
 */
function getAtributos(object $object): array
{
    // Creamos un objecto de ReflectionClass
    $reflectionClass = new ReflectionClass($object);
    // Obtenemos las propiedades del objeto
    $properties = $reflectionClass->getProperties();
    // Creamos un array con los atributos del objeto
    $atributos = getPropiedadesEspecificas($object);
    // Recorremos las propiedades del objeto
    foreach ($properties as $property) {
        // Obtenemos el nombre de la propiedad
        $nombrePropiedad = $property->getName();
        // Obtenemos el valor de la propiedad
        $valorPropiedad = $object->{'get' . ucfirst($nombrePropiedad)}();
        // Asignamos el valor al array
        $atributos['Todos'][$nombrePropiedad] = $valorPropiedad;
    }
    return $atributos['Todos'];
}

function createObject(string $table , array $atributos): object
{
    // Creamos un objeto del modelo
    $modelo = new $table();
    // Recorremos el resultado de la sentencia y asignamos los valores al objeto modelo 
    foreach ($atributos as $key => $value) {
        $modelo->{'set' . ucfirst($key)}($value);
    }
    return $modelo;
}


?>