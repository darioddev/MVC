<?php
/**
 *  Clase abstracta para la conexion a la base de datos
 */

abstract class Connection
{
    // Atributo para la conexion
    private static $connection;

    /**
     * Metodo para abrir la conexion
     * @return void
     */

    public static function openConnection(): void
    {
        if (!isset(self::$connection)) {
            try {
                self::$connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->exec("SET CHARACTER SET " . DB_CHARSET);
            } catch (PDOException $e) {
                exit();
            }
        }
    }

    /**
     *  Metodo para cerrar la conexion
     * @return void
     */

    public static function closeConnection(): void
    {
        if (isset(self::$connection)) {
            self::$connection = null;
        }
    }

    /**
     * Metodo para obtener la conexion
     * @return mixed
     */

    public static function getConnection(): mixed
    {
        return self::$connection;
    }

    /**
     * Metodo para obtener el ultimo id insertado
     * @return mixed
     */
    public static function getNextAutoIncrement(string $tableName , string $db_name = DB_NAME): mixed
    {
        try {
            // Preparar la consulta
            $stmt = self::getConnection()->prepare("SELECT AUTO_INCREMENT FROM information_schema.TABLES 
                                                    WHERE TABLE_SCHEMA = :db_name AND TABLE_NAME = :table_name");
            // Asignar valores a los parámetros
            $stmt->bindParam(':db_name' , $db_name , PDO::PARAM_STR);
            $stmt->bindParam(':table_name', $tableName , PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();
            // Obtener el valor AUTO_INCREMENT
            return $stmt->fetch(PDO::FETCH_ASSOC)['AUTO_INCREMENT'];
        } catch (PDOException $e) {
            return false;
        }
    }

}
?>