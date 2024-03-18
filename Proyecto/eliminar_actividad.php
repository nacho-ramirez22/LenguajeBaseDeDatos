<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_actividad = $_GET["id"];

$query = "BEGIN eliminar_actividad(:ID_ACTIVIDAD); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":ID_ACTIVIDAD", $id_actividad);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Actividad eliminada correctamente"); window.location.href = "actividades.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al eliminar la actividad" . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
