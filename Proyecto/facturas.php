<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paquetes</title>
    <link rel="stylesheet" href="css/stylesIndex.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
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
                            <a class="nav-link " href="index.php">Página principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="paquete.php">Paquete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="comentario.php">Comentarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="tour.php">Tour</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="actividades.php">Actividades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menu.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="provincia.php">Provincia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lugarSalida.php">Lugar de Salida</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auditoria.php">Auditorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="facturas.php">Facturas</a>
                        </li>
                    </ul>
                </div>
                <?php
                session_start();
                if (isset($_SESSION['username'])) {
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
    <div class="container mt-5">
        <?php
        $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

        if (!$conn) {
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        }

        $query = 'SELECT * FROM vista_factura';

        $statement = oci_parse($conn, $query);

        oci_execute($statement);

        echo "<h2>FACTURAS:</h2>";
        echo "<ul class='list-group'>";
        while ($row = oci_fetch_assoc($statement)) {
            echo "<li class='list-group-item'>
              <strong>ID FACTURA:</strong> " . $row['ID_FACTURA'] . " <strong>NOMBRE:</strong> " . $row['NOMBRE'] . " <strong>DESTINO:</strong> " . $row['DESTINO'] . " 
              <strong>FECHA:</strong> " . $row['FECHA'] . " <strong>PRECIO:</strong> " . $row['PRECIO'] . "</li>";
        }
        echo "</ul>";

        oci_free_statement($statement);
        oci_close($conn);
        ?>
    </div>
    <footer class="bg-secondary text-white text-center p-3">
        <p>TOURS - 2024</p>
    </footer>
</body>

</html>