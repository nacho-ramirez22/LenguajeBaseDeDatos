<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$query = 'BEGIN :resultado := NUMERO_ACTIVIDADES(); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":resultado", $total_actividades, 32);

oci_execute($statement);

oci_fetch($statement);

oci_free_statement($statement);
oci_close($conn);

echo '<script>alert("Total de actividades registradas: ' . $total_actividades . '");window.location.href = "actividades.php";</script>';
