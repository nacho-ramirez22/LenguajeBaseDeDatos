<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
$id_lugar_salida = $_POST['id_lugar_salida'];

$query = 'BEGIN :resultado := LUGAR_SALIDA(:id_lugar_salida); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":id_lugar_salida", $id_lugar_salida);
oci_bind_by_name($statement, ":resultado", $lugar_salida, 80);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($lugar_salida !== null) {
    echo '<script>alert("Lugar de salida: ' . $lugar_salida . '");window.location.href = "lugarSalida.php";</script>';
} else {
    echo '<script>alert("No se encontró ningún lugar de salida con ese ID.");window.location.href = "lugarSalida.php";</script>';
}
