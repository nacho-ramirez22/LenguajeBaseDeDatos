<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_ls = $_GET["id"];

$query = "BEGIN eliminar_lugarSalida(:id_ls); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":id_ls", $id_ls);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Lugar de salida eliminado correctamente"); window.location.href = "lugarSalida.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al eliminar el lugar de salida" . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
