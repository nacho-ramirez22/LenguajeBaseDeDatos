<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_tour = $_GET["id"];

$query = "BEGIN eliminar_tour(:ID_TOUR); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":ID_TOUR", $id_tour);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Tour eliminado correctamente"); window.location.href = "tour.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al eliminar el tour" . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
