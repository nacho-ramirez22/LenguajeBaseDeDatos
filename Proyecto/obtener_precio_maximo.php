<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$query = 'BEGIN :resultado := PRECIO_MAXIMO(); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":resultado", $precio_maximo, 32);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

echo '<script>alert("El precio máximo de los paquetes es: ' . $precio_maximo . '");window.location.href = "paquete.php";</script>';
