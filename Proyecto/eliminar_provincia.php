<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_provincia = $_GET["id"];

$query = "BEGIN eliminar_provincia(:ID_PROVINCIA); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":ID_PROVINCIA", $id_provincia);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Provincia eliminada correctamente"); window.location.href = "provincia.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al eliminar la provincia" . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
