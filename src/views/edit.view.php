<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDICCION - <?php echo strtoupper($_GET['class'])?> </title>
    <link rel="icon" href="./public/icon.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../../src/assets/css/index.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- Implemento el controlador del navegador para la navegacion de usuario -->
    <?php require_once(URL_CONTROLLER . 'nav.controller.php') ?>
    <div class="home">
        <p class="text">
            SECCION DE EDITAR
            <?php echo strtoupper($_GET['class']) ?>
        </p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?class=' . $_GET['class'] . '&id=' . $_GET['id']?>" class="formularioEditAnadir"
            enctype="multipart/form-data">
            <?php
            foreach (get_class_methods(get_class($object)) as $metodo) { // Recorro los metodos de la clase
                // Compruebo si el metodo es un get
                if (substr($metodo, 0, 3) === 'get') {
                    // Elimino "get" y convierto la primera letra a minúscula para obtener el nombre de la propiedad para mostrarla en el formulario
                    $propiedad = lcfirst(substr($metodo, 3));

                    // Compruebo que tipo es , para controlar , numeros , fechas etc...
                    switch ($propiedad) {
                        case 'id':
                            ?>
                            <input type="hidden" name="id" value="<?php echo $object->$metodo() ?>">
                            <?php
                            break;
                        case 'imagen':
                            ?>
                            <label for="<?php echo $propiedad ?>">
                                <?php echo ucfirst($propiedad) ?>
                            </label>
                            <img src="<?php echo '../.' . URL_IMG . ucfirst($_GET['class']) . 's/' . $object->$metodo() ?>"
                                alt="<?php echo $object->$metodo() ?>" width="100px" height="100px">
                            <input type="file" name="<?php echo $propiedad ?>" id="<?php echo $propiedad ?>"
                                value="<?php echo $object->$metodo() ?>">
                            <?php
                            break;
                        case 'estado':
                            ?>
                            <label for="<?php echo $propiedad ?>">
                                <?php echo ucfirst($propiedad) ?>
                            </label>
                            <select name="<?php echo $propiedad ?>" id="<?php echo $propiedad ?>">
                                <option value="1" <?php echo ($object->$metodo() == 1 ? 'selected' : ''); ?>>Activo</option>
                                <option value="0" <?php echo ($object->$metodo() == 0 ? 'selected' : ''); ?>>Inactivo</option>
                            </select>
                            <?php
                            break;
                        case 'anio':
                            //Formateamos la fecha a tipo date de html con el metodo format()
                            $fecha = new DateTime($object->$metodo());
                            $fecha = $fecha->format('Y-m-d');
                            ?>
                            <label for="<?php echo $propiedad ?>">
                                <?php echo ucfirst($propiedad) ?>
                            </label>
                            <input type="date" name="<?php echo $propiedad ?>" id="<?php echo $propiedad ?>"
                                value="<?php echo $fecha ?>">
                            <?php
                            break;
                        case 'duracion':
                        case 'paginas':
                            ?>
                            <label for="<?php echo $propiedad ?>">
                                <?php echo ucfirst($propiedad) ?>
                            </label>
                            <input type="number" name="<?php echo $propiedad ?>" id="<?php echo $propiedad ?>"
                                value="<?php echo $object->$metodo() ?>">
                            <?php
                            break;
                        default:
                            ?>
                            <label for="<?php echo $propiedad ?>">
                                <?php echo ucfirst($propiedad) ?>
                            </label>
                            <input type="text" name="<?php echo $propiedad ?>" id="<?php echo $propiedad ?>"
                                value="<?php echo $object->$metodo() ?>">
                            <?php
                            break;
                    }
                }
            }
            ?>
            <button type="submit" name="editar">Guardar</button>
        </form>
    </div>
</body>

</html>