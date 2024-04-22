<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
$id_actividad = $_POST['id_actividad'];

$query = 'BEGIN :resultado := NOMBRE_ACTIVIDAD(:id_actividad); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":id_actividad", $id_actividad);
oci_bind_by_name($statement, ":resultado", $id_actividad, 80);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($id_actividad !== null) {
    echo '<script>alert("Actividad: ' . $id_actividad . '");window.location.href = "actividades.php";</script>';
} else {
    echo '<script>alert("No se encontró ningúna actividad con ese ID.");window.location.href = "actividades.php";</script>';
}
