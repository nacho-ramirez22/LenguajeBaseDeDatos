<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$actividad = $_POST["actividad"];

$query = "BEGIN agregar_actividad (:actividad); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":actividad", $actividad);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Actividad registrada correctamente"); window.location.href = "actividades.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al agregar la actividad" . $m['message'];
}


oci_free_statement($statement);
oci_close($conn);
