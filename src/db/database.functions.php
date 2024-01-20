<?php

/**
 * Clase con funciones que se comunica con la base de datos
 */
class DatabaseFunctions
{

    /**
     * Busca un objeto en la base de datos por su id
     * @param object $orm - Objeto ORM
     * @param int $id - Id del objeto a buscar
     * @param string $class - Nombre de la clase del objeto
     * @return object|null
     */
    public static function findId($orm, $id, $class): object|null
    {
        return $orm->find($class, $id);
    }


    /**
     * Actualiza el estado de una clase o redirreciona a la pagina de editar
     * @param object $orm - Objeto ORM
     * @param string $action - Accion a realizar
     * @param object $object - Objeto a actualizar
     * @param string $redirect - Url a la que redirigir
     * @return void
     */

    public static function updateStateClass($orm, $action, $object, $redirect, $redirectEdit = null): void
    {
        // Compruebo si alguno de los botones de la tabla ha sido pulsado
        // Si ha sido pulsado eliminar o activar , actualizo el estado del objeto
        if ($action == 'delete' || $action == 'enable') {
            // Actualizo el estado del objeto
            $object->setEstado($action == 'enable');
            // Actualizo el objeto en la base de datos
            $orm->updateState($object);
            header('Location: ' . $redirect); // Redirijo a la url obtenida por parametro
            exit();
        }
        // Si ha sido pulsado editar , redirijo a la pagina de editar con parametros get con el nombre
        // de la clase y el id del objeto
        if ($action == 'edit') {
            header('Location: ' . $redirectEdit);
            exit();
        }
    }


    /**
     * Actualiza un objeto en la base de datos con los datos del formulario post recibido
     * @param object $orm - Objeto ORM
     * @param object $object - Objeto a actualizar
     * @param array $post - Array con los datos del formulario
     * @param string $urlImg - Url de la imagen
     * @return void
     */
    public static function update($orm, &$object, $post, $urlImg = URL_IMG): void
    {

        // Almaceno en un array las propiedades del objeto con getPropiedadesEspecificas()
        $properties = array_merge(
            array_keys(getPropiedadesEspecificas($object)['Todos']),
            getPropiedadesEspecificas($object)[ucfirst(get_class($object))]
        );

        $imagen = handleImageUpload(get_class($object), 'imagen', $urlImg); //Llamo al metodo de imagenes para subir la imagen

        //Lo recorro y modifico el objeto con los datos del formulario
        foreach ($properties as $property) {
            if (strtolower($property) == 'imagen')
                continue; // Si la propiedad es imagen , continuo
            $metodo = 'set' . ucfirst($property); // Obtengo el nombre del metodo
            $object->$metodo($post[strtolower($property)]); // Modifico el objeto con los datos del formulario
        }
        //Evitar la perdida de la imagen
        if (!$imagen)
            $imagen = $object->getImagen();

        $object->setImagen($imagen); // Inserto la imagen en el objeto
        $orm->flush($object); // Actualizo el objeto en la base de datos
    }
}
?>