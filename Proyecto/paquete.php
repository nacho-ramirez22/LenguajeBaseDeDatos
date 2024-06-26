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
                            <a class="nav-link active" href="paquete.php">Paquete</a>
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

    <div class="container mt-5">
        <form action="funcion_paquetes_provincia.php" method="post">
            <div class="mb-3">
                <label for="provincia">Seleccione una provincia:</label>
                <select class="form-control" id="provincia" name="provincia">
                    <?php
                    $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");
                    if (!$conn) {
                        $m = oci_error();
                        echo $m['message'], "\n";
                        exit;
                    }
                    $query = 'SELECT ID_PROVINCIA, PROVINCIA FROM PROVINCIA';
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
            <button type="submit" class="btn btn-primary">Ver Paquetes por Provincia</button>
        </form><br>
        <form action="funcion_barato_provincia.php" method="post">
            <div class="mb-3">
                <label for="provincia">Seleccione una provincia:</label>
                <select class="form-control" id="provincia" name="provincia">
                    <?php
                    $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");
                    if (!$conn) {
                        $m = oci_error();
                        echo $m['message'], "\n";
                        exit;
                    }
                    $query = 'SELECT ID_PROVINCIA, PROVINCIA FROM PROVINCIA';
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
            <button type="submit" class="btn btn-primary">Destino Mas Barato</button>
        </form><br>
        <form action="provincia_con_mas_ventas.php" method="POST">
            <button type="submit" class="btn btn-primary">Obtener Provincia con mas ventas</button>
        </form><br>
        <form action="obtener_precio_maximo.php" method="POST">
            <button type="submit" class="btn btn-primary">Obtener Precio Máximo</button>
        </form><br>
        <form action="obtener_precio_minimo.php" method="POST">
            <button type="submit" class="btn btn-primary">Obtener Precio Minimo</button><br><br>
        </form><br>
        <form action="obtener_destino_popular.php" method="POST">
            <button type="submit" class="btn btn-primary">Obtener Destino Popular</button><br><br>
        </form><br>
        <h2>Paquetes por Fecha</h2>
        <form action="funcion_paquetesfecha.php" method="post">
            <div class="mb-3">
                <input type="DATE" class="form-control" id="fecha" name="fecha">
            </div>
            <button type="submit" class="btn btn-primary">Ver Paquetes</button>
        </form><br>

        <div class="container mt-5">
            <?php

            $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

            if (!$conn) {
                $m = oci_error();
                echo $m['message'], "\n";
                exit;
            }

            $query = 'SELECT * FROM vista_paquete';

            $statement = oci_parse($conn, $query);

            oci_execute($statement);

            echo "<h2>Paquetes:</h2>";
            echo "<ul class='list-group'>";
            while ($row = oci_fetch_assoc($statement)) {
                echo "<li class='list-group-item'>
            <strong>Destino:</strong> " . $row['DESTINO'] . " <strong>Provincia:</strong> " . $row['PROVINCIA'] . " <br>
            <strong>Tipo de Tour:</strong> " . $row['TIPO'] . "  <strong>Actividad:</strong> " . $row['NOMBRE_ACTIVIDAD'] . "<br>
            <strong>Comida:</strong> " . $row['COMIDA'] . "  <strong>Bebida:</strong> " . $row['BEBIDA'] . "<br>
            <strong>Lugar de Salida:</strong> " . $row['LUGARSALIDA'] . "  <strong>Fecha:</strong> " . $row['FECHA'] . " <br> <strong>Precio:</strong> " . $row['PRECIO'];

                if ($_SESSION['id_rol'] == 2) {
                    echo '<br>';
                    echo '<br>';
                    echo "<a href='eliminar_paquete.php?id=" . $row['ID_PAQUETE'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
              <a href='editar_paquete.php?id=" . $row['ID_PAQUETE'] . "' class='btn btn-secondary btn-sm'>Editar</a>";
                }
                echo '<br>';
                echo '<br>';
                echo "<a href='generar_factura.php?id_paquete=" . $row['ID_PAQUETE'] . "&id_usuario=" . $_SESSION['id_usuario'] . "' class='btn btn-success btn-sm'>Comprar Paquete</a></li>";
            }
            echo "</ul>";


            if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 2) {
            ?>
                <br><br><br>
                <div class="row">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>Agregar Paquete</h2>
                            <form action="Agregar_paquete.php" method="POST">
                                <div class="form-group">
                                    <label for="destino">Destino:</label>
                                    <input type="text" class="form-control" id="destino" name="destino" required>
                                </div>
                                <div class="form-group">
                                    <label for="provincia">Provincia:</label>
                                    <select class="form-control" id="provincia" name="provincia" required>
                                        <option value="">Seleccione una provincia</option>
                                        <?php
                                        $query = 'SELECT * FROM vista_provincia';
                                        $statement_provincia = oci_parse($conn, $query);
                                        oci_execute($statement_provincia);

                                        while ($row = oci_fetch_assoc($statement_provincia)) {
                                            echo "<option value='" . $row['ID_PROVINCIA'] . "'>" . $row['PROVINCIA'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tour">Tipo de tour:</label>
                                    <select class="form-control" id="tour" name="tour" required>
                                        <option value="">Seleccione el tipo de tour</option>
                                        <?php
                                        $query = 'SELECT * FROM vista_tour';
                                        $statement_tour = oci_parse($conn, $query);
                                        oci_execute($statement_tour);

                                        while ($row = oci_fetch_assoc($statement_tour)) {
                                            echo "<option value='" . $row['ID_TOUR'] . "'>" . $row['TIPO'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="actividad">Tipo de actividad:</label>
                                    <select class="form-control" id="actividad" name="actividad" required>
                                        <option value="">Seleccione el tipo de actividad</option>
                                        <?php
                                        $query = 'SELECT * FROM vista_actividad';
                                        $statement_actividad = oci_parse($conn, $query);
                                        oci_execute($statement_actividad);

                                        while ($row = oci_fetch_assoc($statement_actividad)) {
                                            echo "<option value='" . $row['ID_ACTIVIDAD'] . "'>" . $row['NOMBRE_ACTIVIDAD'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="menu">Menu:</label>
                                    <select class="form-control" id="menu" name="menu" required>
                                        <option value="">Seleccione el menu</option>
                                        <?php
                                        $query = 'SELECT * FROM vista_menu';
                                        $statement_menu = oci_parse($conn, $query);
                                        oci_execute($statement_menu);

                                        while ($row = oci_fetch_assoc($statement_menu)) {
                                            echo "<option value='" . $row['ID_MENU'] . "'>" . $row['MENU'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lugarSalida">Lugar de Salida:</label>
                                    <select class="form-control" id="lugarSalida" name="lugarSalida" required>
                                        <option value="">Seleccione el lugar de salida</option>
                                        <?php
                                        $query = 'SELECT * FROM vista_lugarSalida';
                                        $statement_ls = oci_parse($conn, $query);
                                        oci_execute($statement_ls);

                                        while ($row = oci_fetch_assoc($statement_ls)) {
                                            echo "<option value='" . $row['ID_LS'] . "'>" . $row['PROVINCIA'] . ":  " . $row['LUGARSALIDA'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha:</label>
                                    <input type="DATE" class="form-control" id="fecha" name="fecha" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio:</label>
                                    <input type="number" class="form-control" id="precio" name="precio" required>
                                </div>
                                <br><button type="submit" class="btn btn-primary">Agregar Paquete</button><br><br><br>
                            </form>
                        </div>
                    </div>
                <?php
            }
                ?>
                </div>
        </div>
        <footer class="bg-secondary text-white text-center p-3">
            <p>TOURS - 2024</p>
        </footer>
</body>

</html>