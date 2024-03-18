<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_paquete = $_GET["id"];

$query = "BEGIN eliminar_paquete(:id_paquete); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":id_paquete", $id_paquete);

$result = oci_execute($statement);

if ($result) {
    header('Location: paquete.php');
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al eliminar el paquete" . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
