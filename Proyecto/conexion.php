<?php
$conn = oci_connect("esteban", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
} else {
    echo "Conexion con exito a oracle";
}
oci_close($conn);
