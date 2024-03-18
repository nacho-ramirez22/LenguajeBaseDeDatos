<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_tour = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];

    $query = 'BEGIN editar_tour(:id, :tipo); END;';

    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ':id', $id_tour);
    oci_bind_by_name($statement, ':tipo', $tipo);

    $result = oci_execute($statement);

    if ($result) {
        header('Location: Tour.php');
        exit;
    } else {
        $m = oci_error($statement);
        echo "Error al editar el tour" . $m['message'];
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
    <title>Editar Tour</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Tour</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_tour; ?>" method="post">
            <div class="form-group">
                <label for="tipo">Tipo de Tour:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="Tour.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>