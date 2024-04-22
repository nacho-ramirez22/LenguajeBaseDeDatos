<?php
session_start();

if (!isset($_GET['id_usuario'])) {
    header('Location: facturas.php');
    exit;
}

$id_usuario = $_GET['id_usuario'];

$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$query = 'BEGIN :resultado := TOTAL_GASTADO(:id_usuario); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":id_usuario", $id_usuario);

oci_bind_by_name($statement, ":resultado", $total_gastado, 32);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

echo '<script>alert("Total gastado por el usuario: ' . $total_gastado . '");window.location.href = "facturas.php";</script>';
