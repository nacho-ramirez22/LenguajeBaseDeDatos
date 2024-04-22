<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$fecha = $_POST['fecha'];

$query = 'BEGIN :resultado := PAQUETES_FECHA(:fecha); END;';
$statement = oci_parse($conn, $query);

$fecha_format = date('d-M-Y', strtotime($fecha));
oci_bind_by_name($statement, ":fecha", $fecha_format);
oci_bind_by_name($statement, ":resultado", $cantidadPaquetes, 80);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($cantidadPaquetes !== null) {
    echo '<script>alert("Paquetes en esa fecha: ' . $cantidadPaquetes . '");window.location.href = "paquete.php";</script>';
} else {
    echo '<script>alert("No se encontró ningúna paquete con esa fecha.");window.location.href = "paquete.php";</script>';
}
