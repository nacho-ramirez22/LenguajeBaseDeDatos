<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/stylesIndex.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <style>
        .image-container {
            position: relative;
            text-align: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
        }

        .caption {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo2.png" class="logo" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Página principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="paquete.php">Paquete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="comentario.php">Comentarios</a>
                        </li>
                        <?php
                        session_start();
                        if (isset($_SESSION['username'])) {
                            if ($_SESSION['id_rol'] == 2) {
                                echo
                                '
                                <li class="nav-item">
                                    <a class="nav-link " href="tour.php">Tour</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="actividades.php">Actividades</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="menu.php">Menu</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="provincia.php">Provincia</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="lugarSalida.php">Lugar de Salida</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="auditoria.php">Auditorias</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="facturas.php">Facturas</a>
                                </li>';
                            }
                            echo '<div class="d-flex align-items-center">';
                            echo '<p class="text-white mb-0"><strong>' . $_SESSION['username'] . '</strong></p>';
                            echo '<form action="logout.php" method="POST">';
                            echo '<button type="submit" class="btn btn-danger mx-2">Cerrar sesión</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                        ?>
                </div>
        </nav>
    </header>
    <div class="image-container">
        <img src="img/senderismo.png" class="d-block w-100" alt="Imagen 1">
        <div class="caption">
            <h2>¡BIENVENIDO A MOCHILEANDO CR!</h2>
        </div>
    </div>

    <footer class="bg-secondary text-white text-center p-3">
        <p>TOURS - 2024</p>
    </footer>
</body>

</html>