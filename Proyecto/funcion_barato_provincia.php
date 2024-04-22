<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$provincia = $_POST['provincia'];

$query = 'BEGIN :resultado := DESTINO_MAS_BARATO_PROVINCIA(:provincia); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":provincia", $provincia);
oci_bind_by_name($statement, ":resultado", $numPaquetes, 80);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($numPaquetes !== null) {
    echo '<script>alert("Paquete mas barato para la provincia seleccionada: ' . $numPaquetes . '");</script>';
} else {
    echo '<script>alert("La provincia seleccionada no tiene paquetes.");</script>';
}
echo '<script>window.location.href = "paquete.php";</script>';
