<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
$id_provincia = $_POST['id_provincia'];

$query = 'BEGIN :resultado := NOMBRE_PROVINCIA(:id_provincia); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":id_provincia", $id_provincia);
oci_bind_by_name($statement, ":resultado", $id_provincia, 80);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($id_provincia !== null) {
    echo '<script>alert("Provincia: ' . $id_provincia . '");window.location.href = "provincia.php";</script>';
} else {
    echo '<script>alert("No se encontró ningúna provincia con ese ID.");window.location.href = "provincia.php";</script>';
}
