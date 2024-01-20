<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - MVC </title>
    <link rel="icon" href="./public/icon.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" href="./src/assets/css/index.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- Implemento el controlador del navegador para la navegacion de usuario -->
    <?php require_once(URL_CONTROLLER . 'nav.controller.php') ?>
    <section class="home">
        <div class="text">
            Home
        </div>

        <section class="user-statsAD">
            <div class="stats-cardAD">
                <h2 class="stats-card-titleAD">Número de Películas</h2>
                <i class="fas fa-film icon arrow-upAD fa-3x"></i>
                <p class="stats-card-valueAD">
                    <?php echo count($dataModel['Peliculas']); ?>
                </p>
            </div>
            <div class="stats-cardAD">
                <h2 class="stats-card-titleAD">Número de Discos</h2>
                <i class="fas fa-compact-disc icon arrow-downAD fa-3x"></i>
                <p class="stats-card-valueAD">
                    <?php echo count($dataModel['Discos']); ?>
                </p>
            </div>
            <div class="stats-cardAD">
                <h2 class="stats-card-titleAD">Número de Libros</h2>
                <i class="fas fa-book icon arrow-upAD fa-3x"></i>
                <p class="stats-card-valueAD">
                    <?php echo count($dataModel['Peliculas']); ?>
                </p>
            </div>

        </section>

        <section class="custom-highlightsAD">
            <!-- Establezcno cartas con su imagen y su titulo , obtenida por una array en el controladodr ordenadolas.-->
            <div class="custom-book-cardAD">
                <img src="<?php echo $libroImg; ?>" alt="<?php echo $libroTitle . "más reciente" ?>">
                <h2 class="custom-book-card-titleAD">
                    Libro Más Reciente
                </h2>
                <p class="custom-book-card-authorAD">
                    <?php echo $libroTitle; ?>
                </p>
            </div>
            <div class="custom-book-cardAD">
                <img src="<?php echo $discoImg; ?>" alt="<?php echo $discoTitle . "más reciente" ?>">
                <h2 class="custom-book-card-titleAD">
                    Disco Más Reciente
                </h2>
                <p class="custom-book-card-authorAD">
                    <?php echo $discoTitle; ?>
                </p>
            </div>
            <div class="custom-book-cardAD">
                <img src="<?php echo $peliculaImg; ?>" alt="<?php echo $peliculaTitle . "más reciente" ?>">
                <h2 class="custom-book-card-titleAD">
                    Película Más Reciente
                </h2>
                <p class="custom-book-card-authorAD">
                    <?php echo $peliculaTitle; ?>
                </p>
            </div>
        </section>

    </section>
</body>

</html>