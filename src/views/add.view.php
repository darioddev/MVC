<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AÑADIR
        <?php echo strtoupper($class) ?>- MVC
    </title>
    <link rel="icon" href="./public/icon.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" href="../src/assets/css/index.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- Implemento el controlador del navegador para la navegacion de usuario -->
    <?php require_once(URL_CONTROLLER . 'nav.controller.php') ?>
    <div class="home">
        <p class="text"> SECCION PARA INSERTAR
            <?php echo (strtolower($class) == "pelicula") ? "UNA NUEVA " . strtoupper($class) : " UN NUEVO " . strtoupper($class) ?>
        </p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?class=' . $_GET['class']?>" class="formularioEditAnadir" enctype="multipart/form-data">
            <?php
            foreach ($propiedades as $value) {
                $value = strtolower($value);
                ?>
                <label for="<?php echo $value ?>">Introduce :
                    <?php echo ucfirst($value) ?>
                </label>
                <?php
                switch ($value) {
                    case 'imagen':
                        ?>
                        <input type="file" name="<?php echo $value ?>" id="<?php echo $value ?>" required>
                        <?php
                        break;
                    case 'estado':
                        ?>
                        <select name="<?php echo $value ?>" id="<?php echo $value ?>" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        <?php
                        break;
                    case 'anio':
                        ?>
                        <input type="date" name="<?php echo $value ?>" id="<?php echo $value ?>" required>
                        <?php
                        break;
                    case 'duracion':
                    case 'paginas':
                        ?>
                        <input type="number" name="<?php echo $value ?>" id="<?php echo $value ?>" required>
                        <?php
                        break;
                    default:
                        ?>
                        <input type="text" name="<?php echo $value ?>" id="<?php echo $value ?>" required>
                        <?php
                        break;
                }
                ?>
                <?php
            }
            ?>
            <button type="submit" name="addModel">Añadir</button>
        </form>
</body>

</html>