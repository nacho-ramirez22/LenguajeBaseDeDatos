<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$comida = $_POST["comida"];
$bebida = $_POST["bebida"];


$query = "BEGIN agregar_menu (:comida, :bebida); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":comida", $comida);
oci_bind_by_name($statement, ":bebida", $bebida);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Menu registrado correctamente"); window.location.href = "menu.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al agregar el menu" . $m['message'];
}


oci_free_statement($statement);
oci_close($conn);
