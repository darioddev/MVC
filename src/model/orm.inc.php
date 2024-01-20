<?php
require_once(URL_MODEL . 'conection.inc.php'); // Incluyo el archivo que contiene la clase Connection
require_once(URL_CONFIG . 'database.inc.php'); // Incluyo el archivo que contiene la configuracion de la base de datos
require_once(URL_LIB . 'db.functions.inc.php'); // Incluyo el archivo que contiene las funciones de la base de datos
require_once(URL_DB . 'database.functions.php'); // Incluyo el archivo que contiene la clase que se comunica con la base de datos
?>

<?php
class ORM
{


    /**
     * 
     * Insertamos un objeto en la base de datos
     * Usamos PDO y sentencias preparadas
     * @param mixed $datos
     * @return bool
     */
    public function persist($datos): bool
    {
        try {
            // Abrimos conexion
            Connection::openConnection();

            // Asignamos el id al objeto
            $datos->setId(Connection::getNextAutoIncrement(get_class($datos)));

            // Iniciamos la transaccion
            Connection::getConnection()->beginTransaction();

            // Definimos los nombres de las propiedades específicas de cada tipo de dato
            $propiedadesEspecificas = getPropiedadesEspecificas($datos);

            // Creamos la consulta preparada con los campos y los placeholders
            $query = createQueryInsert(
                get_class($datos),
                createCampos(array_keys($propiedadesEspecificas['Todos']), $propiedadesEspecificas[get_class($datos)]),
                createPlaceholders($propiedadesEspecificas[get_class($datos)])
            );
            // Preparamos la sentencia
            $sentencia = Connection::getConnection()->prepare($query);

            // Recorremos el array de atributos y asignamos los valores a la sentencia
            $index = 1;
            foreach ($propiedadesEspecificas['Todos'] as $valor) {
                $sentencia->bindValue($index, $valor);
                $index++;
            }
            //Recorremos el array de atributos específicos y mediante el getter obtenemos el valor y lo asignamos a la sentencia
            foreach ($propiedadesEspecificas[get_class($datos)] as $valor) {
                $sentencia->bindValue($index, $datos->{'get' . ucfirst($valor)}());
                $index++;
            }

            // Ejecutamos la sentencia
            $sentencia->execute();
            // Commit
            Connection::getConnection()->commit();
            return true;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        } finally {
            // Cerramos la conexion
            Connection::closeConnection();
        }

    }


    /** 
     * Obtenemos todos los objetos de la tabla
     * Usamos PDO y sentencias preparadas
     * @param string $table - Nombre de la tabla
     * @return array
     */
    public function findAll(string $table): array
    {
        try {
            // Abrimos conexion
            Connection::openConnection();
            // Preparamos la sentencia
            $sentencia = Connection::getConnection()->prepare("SELECT * FROM " . $table);
            // Ejecutamos la sentencia
            $sentencia->execute();
            // Obtenemos el resultado
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            // Si hay algun error retornamos un array vacio
            return [];
        } finally {
            // Cerramos la conexion
            Connection::closeConnection();
        }
    }

    /**
     * Obtenemos un objeto de la tabla
     * Usamos PDO y sentencias preparadas
     * @param string $table - Nombre de la tabla
     * @param int $id - Id del objeto
     * @return object|null
     */
    public function find(string $table, int $id): object|null
    {
        try {
            // Abrimos conexion
            Connection::openConnection();
            // Preparamos la sentencia
            $sentencia = Connection::getConnection()->prepare("SELECT * FROM " . $table . " WHERE id = ?");
            // Asignamos el parametro
            $sentencia->bindParam(1, $id);
            // Ejecutamos la sentencia
            $sentencia->execute();
            // Devolvemos el objeto
            return createObject($table, $sentencia->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $error) {
            return null; // Cambiado a null para indicar que no se encontró el objeto
        } finally {
            // Cerramos la conexion
            Connection::closeConnection();
        }
    }

    /**
     * Actualizamos el estado de un objeto en la base de datos
     * Usamos PDO y sentencias preparadas
     * @param object $object - Objeto a actualizar
     * @return bool - Devuelve true si se actualizó correctamente, false si no.
     */
    public function updateState(object $object): bool
    {
        try {
            // Abrimos conexion
            Connection::openConnection();
            // Iniciamos la transaccion
            Connection::getConnection()->beginTransaction();

            // Creamos un array con los atributos del objeto
            $atributos = [
                'estado' => $object->getEstado(),
                'id' => $object->getId(),
            ];

            // Eliminamos por estado
            $sentencia = Connection::getConnection()
                ->prepare("UPDATE " . get_class($object) . " SET estado = ? WHERE id = ?");
            // Asignamos el parametro
            $sentencia->bindParam(1, $atributos['estado'], PDO::PARAM_BOOL);
            $sentencia->bindParam(2, $atributos['id'], PDO::PARAM_INT);
            // Ejecutamos la sentencia
            $sentencia->execute();
            // Commit 
            Connection::getConnection()->commit();
            // Devolvemos true
            return true;
        } catch (PDOException $error) {
            Connection::getConnection()->rollBack();
            echo $error->getMessage();
            return false;
        } finally {
            // Cerramos la conexion
            Connection::closeConnection();
        }
    }

    /**
     * Actualizamos un objeto en la base de datos
     * Usamos PDO y sentencias preparadas
     * @param object $object - Objeto a actualizar
     * @return bool - Devuelve true si se actualizó correctamente, false si no.
     */
    public function flush(object $object): bool
    {
        try {
            // Abrimos conexion
            Connection::openConnection();
            // Iniciamos la transaccion
            Connection::getConnection()->beginTransaction();

            $atributos = getAtributos($object); // Creamos un array con los atributos del objeto
            $id = $object->getId(); // Obtenemos el id del objeto
            $columnas = createPlaceholdersUpdate(array_keys($atributos)); // Creamos los placeholders para la sentencia
            $query = createQueryUpdate(get_class($object), $columnas); // Creamos la query para la sentencia

            // Preparamos la sentencia
            $sentencia = Connection::getConnection()->prepare($query);


            $index = 1; // Inicializamos el index a 1 para asignar los valores a la sentencia

            // Recorremos el array de atributos y asignamos los valores a la sentencia
            foreach ($atributos as $valor) {
                $sentencia->bindValue($index, $valor); // Asignamos el valor a la sentencia al index actual
                $index++; // Incrementamos el index para asignar el siguiente valor
            }

            // Vincular el ID al final
            $sentencia->bindValue($index, $id, PDO::PARAM_INT);

            // Ejecutamos la sentencia.
            $sentencia->execute();

            // Commit
            Connection::getConnection()->commit();

            return true;
        } catch (PDOException $error) {
            Connection::getConnection()->rollBack();
            echo $error->getMessage();
            return false;
        } finally {
            Connection::closeConnection();
        }
    }


}
?>