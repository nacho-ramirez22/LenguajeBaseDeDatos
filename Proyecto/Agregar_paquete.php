<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$destino = $_POST["destino"];
$provincia = $_POST["provincia"];
$tour = $_POST["tour"];
$actividad = $_POST["actividad"];
$menu = $_POST["menu"];
$lugarSalida = $_POST["lugarSalida"];
$fecha = $_POST["fecha"];
$precio = $_POST["precio"];

$query = "BEGIN agregar_paquete(:provincia, :menu, :tour, :actividad, :lugarSalida, :destino, :fecha, :precio); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":provincia", $provincia);
oci_bind_by_name($statement, ":menu", $menu);
oci_bind_by_name($statement, ":tour", $tour);
oci_bind_by_name($statement, ":actividad", $actividad);
oci_bind_by_name($statement, ":lugarSalida", $lugarSalida);
oci_bind_by_name($statement, ":destino", $destino);
$fecha_format = date('d-M-Y', strtotime($fecha));
oci_bind_by_name($statement, ":fecha", $fecha_format);
oci_bind_by_name($statement, ":precio", $precio);

$result = oci_execute($statement);

if ($result) {
    header('Location: paquete.php');
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al agregar el paquete: " . $m['message'];
}

oci_free_statement($statement);
oci_close($conn);
