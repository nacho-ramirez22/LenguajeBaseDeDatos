<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$id_provincia = $_POST["provincia"];
$LugarSalida = $_POST["LugarSalida"];

$query = "BEGIN agregar_lugarSalida(:id_provincia, :LugarSalida); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":id_provincia", $id_provincia);
oci_bind_by_name($statement, ":LugarSalida", $LugarSalida);

$result = oci_execute($statement);

if ($result) {
    header("Location: lugarSalida.php");
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al agregar el lugar de salida" . $m['message'];
}


oci_free_statement($statement);
oci_close($conn);
