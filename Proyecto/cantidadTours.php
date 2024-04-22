<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$query = 'BEGIN :resultado := Numero_Tours(); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":resultado", $total_tours, 32);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($total_tours !== null) {
    echo '<script>alert("Total de tours registrados: ' . $total_tours . '");window.location.href = "tour.php";</script>';
} else {
    echo '<script>alert("No se pudo obtener el total de tours.");window.location.href = "tour.php";</script>';
}
