<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIBROS - MVC </title>
    <link rel="icon" href="./public/icon.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rutaCSS ?>">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- Implemento el controlador del navegador para la navegacion de usuario -->
    <?php require_once(URL_CONTROLLER . 'nav.controller.php') ?>
    <div class="home">
        <p class="text">SECCION DE LIBROS</p>
        <p class="mostrarParrafo">
            <?php echo count($librosActivos) ?> activos
        </p>
        <p class="mostrarParrafo">
            <?php echo count($librosInactivos) ?> activos
        </p>
        <!-- Paginacion -->
        <div class="pagination">
            <ul>
                <?php
                for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                    <li><a href="<?php echo $ruta . "Libros/" . $i ?>">
                            <?php echo $i ?>
                        </a></li>
                <?php } ?>

            </ul>
        </div>

        <!-- Enlace a la pagina de añadir-->
        <div class="btnContent">
            <a href="<?php echo $redirect . 'Anadir/Libro' ?>" class="btn btn-primary">Añadir </a>
        </div>


        <!-- Tabla de libros -->
        <table class="table">
            <thead>
                <tr>
                    <?php
                    foreach ($heads as $head) {
                        ?>
                        <th>
                            <?php echo $head ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($libros as $libro) {
                    ?>
                    <tr>
                        <?php
                        foreach ($libro as $propiedad => $value) {
                            switch (strtolower($propiedad)) {
                                case "estado":
                                    $value = $value ? "Activo" : "Inactivo";
                                    ?>
                                    <td class="table-state">
                                        <span>
                                            <?php echo $value ?>
                                        </span>
                                    </td>
                                    <?php
                                    break;
                                case "imagen":
                                    ?>

                                    <td><img src="<?php echo $URL . "Libros" . "/" . $value ?>" alt="" width="300px" height="500px">
                                    </td>
                                    <?php
                                    break;
                                case "anio":
                                    // Formateamos la fecha
                                    $value = new DateTime($value);
                                    ?>
                                    <td>
                                        <?php echo $value->format('Y') ?>
                                    </td>
                                    <?php
                                    break;
                                case "publicacion":
                                case "id":
                                    break;
                                default:
                                    ?>
                                    <td>
                                        <?php echo $value ?>
                                    </td>
                                    <?php
                                    break;
                            }
                        }
                        ?>
                        <td class="option-table">
                            <ul>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $libro["id"] ?>">
                                    <?php
                                    if ($libro['estado']) {
                                        ?>
                                        <button type="submit" name="action" value="delete" class="btnEliminar">
                                            Eliminar
                                        </button>
                                        <button type=" submit" name="action" value="edit" class="btnEditar">Editar</button>

                                        <?php
                                    } else {
                                        ?>
                                        <button type="submit" name="action" value="enable" class="btnActivar">
                                            Activar
                                        </button>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </ul>
                        </td>
                        <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>