<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$tipo = $_POST["tipo"];

$query = "BEGIN agregar_tour (:tipo); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":tipo", $tipo);

$result = oci_execute($statement);

if ($result) {
    header("Location: tour.php");
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al agregar el tour" . $m['message'];
}


oci_free_statement($statement);
oci_close($conn);
