<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_menu = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comida = $_POST["comida"];
    $bebida = $_POST["bebida"];

    $query = 'BEGIN editar_menu(:id, :comida, :bebida); END;';

    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ':id', $id_menu);
    oci_bind_by_name($statement, ':comida', $comida);
    oci_bind_by_name($statement, ':bebida', $bebida);


    $result = oci_execute($statement);

    if ($result) {
        header('Location: menu.php');
        exit;
    } else {
        $m = oci_error($statement);
        echo "Error al editar el menu" . $m['message'];
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
        <h2>Editar Menu</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_menu; ?>" method="post">
            <div class="form-group">
                <label for="comida">Comida:</label>
                <input type="text" class="form-control" id="comida" name="comida" required>
            </div>
            <div class="form-group">
                <label for="bebida">Bebida:</label>
                <input type="text" class="form-control" id="bebida" name="bebida" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="menu.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>