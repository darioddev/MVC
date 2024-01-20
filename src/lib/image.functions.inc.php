<?php
/**
 * Función que controla la subida de imagenes
 * @param string $class - Clase de la imagen , esto sirve para saber donde guardar la imagen
 * @param string $fieldName - Nombre del campo del formulario obtenido
 * @param array $allowedExtensions - Extensiones permitidas por defecto webp, jpg y png
 * @param string $destination - Destino de la imagen por defecto URL_IMG
 * @return bool|string - Devuelve true si se subió correctamente, false si no.
 * 
 */

function handleImageUpload($class, $fieldName, $destination = URL_IMG , $allowedExtensions = ['webp', 'jpg', 'png'] ): bool|string
{
    if (!empty($_FILES) && isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES[$fieldName];

        // Verificar la extensión del archivo si es necesario
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array($fileExtension, $allowedExtensions)) {
            return false;
        }

        // Mover el archivo a la ubicación deseada
        $route = $destination . ucfirst($class) . 's/';

        // Generar un nombre único para el archivo
        $nombreArchivo = uniqid() . '.' . $fileExtension;
        $rutaCompleta = $route . $nombreArchivo;

        if (!move_uploaded_file($file['tmp_name'], $rutaCompleta)) {
            echo "Error : No se pudo mover el archivo";
            return false;
        }

        return $nombreArchivo;
    }

    return false;
}

?>