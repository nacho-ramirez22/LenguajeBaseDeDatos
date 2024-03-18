<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$provincia = $_POST["provincia"];

$query = "BEGIN agregar_provincia (:provincia); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":provincia", $provincia);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Provincia registrada correctamente"); window.location.href = "provincia.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al agregar la provincia" . $m['message'];
}


oci_free_statement($statement);
oci_close($conn);
