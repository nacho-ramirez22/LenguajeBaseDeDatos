<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$provincia = $_POST['provincia'];

$query = 'BEGIN :resultado := PAQUETES_POR_PROVINCIA(:provincia); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":provincia", $provincia);
oci_bind_by_name($statement, ":resultado", $numPaquetes, 80);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($numPaquetes !== null) {
    echo '<script>alert("Cantidad de paquetes para la provincia seleccionada: ' . $numPaquetes . '");</script>';
} else {
    echo '<script>alert("Error al obtener la cantidad de paquetes para la provincia seleccionada.");</script>';
}
echo '<script>window.location.href = "paquete.php";</script>';
