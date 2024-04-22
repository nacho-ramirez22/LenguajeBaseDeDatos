<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$query = 'BEGIN :resultado := PROVINCIA_CON_MAS_VENTAS(); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":resultado", $mas_Ventas, 32);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

echo '<script>alert("La provinvia con mas paquetes es: ' . $mas_Ventas . '");window.location.href = "paquete.php";</script>';
