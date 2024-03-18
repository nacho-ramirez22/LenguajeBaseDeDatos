<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_provincia = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provincia = $_POST["provincia"];

    $query = 'BEGIN editar_provincia(:id, :provincia); END;';

    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ':id', $id_provincia);
    oci_bind_by_name($statement, ':provincia', $provincia);

    $result = oci_execute($statement);

    if ($result) {
        header('Location: provincia.php');
        exit;
    } else {
        $m = oci_error($statement);
        echo "Error al editar la provincia" . $m['message'];
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
    <title>Editar Provincia</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Provincia</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_provincia; ?>" method="post">
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="provincia.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>