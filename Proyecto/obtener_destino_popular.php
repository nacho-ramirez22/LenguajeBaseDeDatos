<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$query = 'BEGIN :resultado := DESTINO_POPULAR(); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":resultado", $DESTINO_POPULAR, 32);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

echo '<script>alert("El destino mas popular es: ' . $DESTINO_POPULAR . '");window.location.href = "paquete.php";</script>';
