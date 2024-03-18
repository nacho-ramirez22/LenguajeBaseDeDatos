<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_paquete = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $destino = $_POST["destino"];
    $provincia = $_POST["provincia"];
    $tour = $_POST["tour"];
    $actividad = $_POST["actividad"];
    $menu = $_POST["menu"];
    $lugarSalida = $_POST["lugarSalida"];
    $fecha = $_POST["fecha"];
    $precio = $_POST["precio"];


    $query = 'BEGIN editar_paquete(:id, :provincia, :menu, :tour, :actividad, :lugarSalida, :destino, :fecha, :precio); END;';

    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ":id", $id_paquete);
    oci_bind_by_name($statement, ":provincia", $provincia);
    oci_bind_by_name($statement, ":menu", $menu);
    oci_bind_by_name($statement, ":tour", $tour);
    oci_bind_by_name($statement, ":actividad", $actividad);
    oci_bind_by_name($statement, ":lugarSalida", $lugarSalida);
    oci_bind_by_name($statement, ":destino", $destino);
    oci_bind_by_name($statement, ":fecha", date('d-M-Y', strtotime($fecha)));
    oci_bind_by_name($statement, ":precio", $precio);

    $result = oci_execute($statement);

    if ($result) {
        header('Location: paquete.php');
        exit;
    } else {
        $m = oci_error($statement);
        echo "Error al editar el paquete: " . $m['message'];
    }

    oci_free_statement($statement);
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lugar de salida</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Paquete</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_paquete; ?>" method="post">
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

            </div><br>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="paquete.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>