<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugares de Salida</title>
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
                            <a class="nav-link active" href="lugarSalida.php">Lugar de Salida</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auditoria.php">Auditorias</a>
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
        <h2>Obtener Lugar de Salida</h2>
        <form action="ls_funcion.php" method="post">
            <div class="mb-3">
                <label for="id_lugar_salida" class="form-label">ID Lugar de Salida:</label>
                <input type="text" class="form-control" id="id_lugar_salida" name="id_lugar_salida">
            </div>
            <button type="submit" class="btn btn-primary">Obtener Lugar de Salida</button>
        </form><br>
        <?php
        $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

        if (!$conn) {
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        }

        $query = 'SELECT * FROM vista_lugarSalida';

        $statement = oci_parse($conn, $query);

        oci_execute($statement);

        echo "<h2>Lugares de Salida:</h2>";
        echo "<ul class='list-group'>";
        while ($row = oci_fetch_assoc($statement)) {
            echo "<li class='list-group-item'>
              <strong>Provincia:</strong> " . $row['PROVINCIA'] . "  <strong>Lugar de salida:</strong> " . $row['LUGARSALIDA'] . "
              <a href='eliminar_lugarSalida.php?id=" . $row['ID_LS'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
              <a href='editar_lugarSalida.php?id=" . $row['ID_LS'] . "' class='btn btn-secondary btn-sm'>Editar</a></li>";
        }
        echo "</ul>";

        oci_free_statement($statement);
        oci_close($conn);
        ?>
        <div class="row">
            <div class="col-12 text-center">
                <h2>Agregar Lugar de Salida</h2>
                <form action="agregar_lugarSalida.php" method="POST">
                    <div class="form-group">
                        <label for="provincia">Provincia:</label>
                        <select class="form-control" id="provincia" name="provincia" required>
                            <option value="">Seleccione una provincia</option>
                            <?php
                            $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

                            if (!$conn) {
                                $m = oci_error();
                                echo $m['message'], "\n";
                                exit;
                            }

                            $query = 'SELECT * FROM vista_provincia';
                            $statement = oci_parse($conn, $query);
                            oci_execute($statement);

                            while ($row = oci_fetch_assoc($statement)) {
                                echo "<option value='" . $row['ID_PROVINCIA'] . "'>" . $row['PROVINCIA'] . "</option>";
                            }

                            oci_free_statement($statement);
                            oci_close($conn);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Lugar de Salida:</label>
                        <input type="text" class="form-control" id="LugarSalida" name="LugarSalida" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Lugar de Salida</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-secondary text-white text-center p-3">
        <p>TOURS - 2024</p>
    </footer>
</body>

</html>