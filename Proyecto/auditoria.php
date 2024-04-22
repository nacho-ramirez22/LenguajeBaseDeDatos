<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoria</title>
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
                            <a class="nav-link" href="tour.php">Tour</a>
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
                            <a class="nav-link active" href="auditoria.php">Auditorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="facturas.php">Facturas</a>
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

        $query = 'SELECT * FROM AuditoriaPaquetes ';

        $statement = oci_parse($conn, $query);

        oci_execute($statement);

        echo "<h2>Auditoria de Paquetes:</h2>";
        echo "<ul class='list-group'>";
        while ($row = oci_fetch_assoc($statement)) {
            echo "<li class='list-group-item'>";
            echo "<b>Tipo de Operación:</b> " . $row['TIPO_OPERACION'] . " ";
            echo "<b>Fecha de Operación:</b> " . $row['FECHA_OPERACION'] . "   ";
            echo "<button class='btn btn-primary btn-sm' onclick='mostrarDetalles(this)'>Detalles</button>";
            echo "<div style='display: none;'>";
            echo "<b>ID de la Provincia:</b> " . $row['ID_PROVINCIA'] . "<br>";
            echo "<b>ID del Menú:</b> " . $row['ID_MENU'] . "<br>";
            echo "<b>ID del Tour:</b> " . $row['ID_TOUR'] . "<br>";
            echo "<b>ID de la Actividad:</b> " . $row['ID_ACTIVIDAD'] . "<br>";
            echo "<b>ID del lugar de Salida:</b> " . $row['ID_LS'] . "<br>";
            echo "<b>Destino:</b> " . $row['DESTINO'] . "<br>";
            echo "<b>Fecha:</b> " . $row['FECHA'] . "<br>";
            echo "<b>Precio:</b> " . $row['PRECIO'] . "<br>";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul>";

        oci_free_statement($statement);
        oci_close($conn);
        ?>

        <?php
        $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

        if (!$conn) {
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        }

        $query = 'SELECT * FROM vista_rol';

        $statement = oci_parse($conn, $query);

        oci_execute($statement);

        echo "<h2>Usuarios Administradores:</h2>";
        echo "<ul class='list-group'>";
        while ($row = oci_fetch_assoc($statement)) {
            echo "<li class='list-group-item'>";
            echo "<b>Usuario:</b> " . $row['USUARIO'] . " ";
            echo "<b>Rol:</b> " . $row['ROL'] . "   ";
            echo "</li>";
        }
        echo "</ul>";

        oci_free_statement($statement);
        oci_close($conn);
        ?>
        <div class="container mt-5">
            <form action="cantidadUsuarios.php" method="POST">
                <button type="submit" class="btn btn-primary">Ver cantidad Usuarios</button>
            </form><br>
        </div>
        <script>
            function mostrarDetalles(button) {
                var detalles = button.nextElementSibling;
                if (detalles.style.display === "none") {
                    detalles.style.display = "block";
                    button.textContent = "Ocultar Detalles";
                } else {
                    detalles.style.display = "none";
                    button.textContent = "Detalles";
                }
            }
        </script>

    </div>
    <footer class="bg-secondary text-white text-center p-3">
        <p>TOURS - 2024</p>
    </footer>
</body>

</html>