<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_menu = $_GET["id"];

$query = "BEGIN eliminar_menu(:ID_MENU); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":ID_MENU", $id_menu);

$result = oci_execute($statement);

if ($result) {
    echo '<script>alert("Menu eliminado correctamente"); window.location.href = "menu.php";</script>';
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al eliminar el menu" . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
