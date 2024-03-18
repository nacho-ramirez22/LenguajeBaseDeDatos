<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_actividad = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_actividad = $_POST["nombre_actividad"];

    $query = 'BEGIN editar_actividad(:id, :nombre_actividad); END;';

    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ':id', $id_actividad);
    oci_bind_by_name($statement, ':nombre_actividad', $nombre_actividad);

    $result = oci_execute($statement);

    if ($result) {
        header('Location: actividades.php');
        exit;
    } else {
        $m = oci_error($statement);
        echo "Error al editar actividad" . $m['message'];
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
    <title>Editar Actividad</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Actividad</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_actividad; ?>" method="post">
            <div class="form-group">
                <label for="nombre_actividad">Tipo de Actividad:</label>
                <input type="text" class="form-control" id="nombre_actividad" name="nombre_actividad" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="actividades.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>