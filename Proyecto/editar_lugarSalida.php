<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_ls = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provincia = $_POST["provincia"];
    $lugarSalida = $_POST["lugarSalida"];

    $query = 'BEGIN editar_lugarSalida(:id, :provincia, :lugarSalida); END;';

    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ':id', $id_ls);
    oci_bind_by_name($statement, ':provincia', $provincia);
    oci_bind_by_name($statement, ':lugarSalida', $lugarSalida);

    $result = oci_execute($statement);

    if ($result) {
        header('Location: lugarSalida.php');
        exit;
    } else {
        $m = oci_error($statement);
        echo "Error al editar el lugar de salida" . $m['message'];
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
        <h2>Editar Lugar de salida</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_ls; ?>" method="post">
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
                <div class="form-group">
                    <label for="lugarSalida">Lugar de Salida:</label>
                    <input type="text" class="form-control" id="lugarSalida" name="lugarSalida" required>
                </div>
            </div><br>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="lugarSalida.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>