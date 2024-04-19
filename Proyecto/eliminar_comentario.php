<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_comentario = $_GET["id"];

$query = "BEGIN eliminar_comentario(:ID_COMENTARIO); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":ID_COMENTARIO", $id_comentario);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Comentario eliminado correctamente"); window.location.href = "comentario.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al eliminar el comentario" . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
