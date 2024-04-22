<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
$username = $_POST['username'];

$query = 'BEGIN :resultado := COMENTARIOS_USUARIO(:username); END;';
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":username", $username);
oci_bind_by_name($statement, ":resultado", $cantidadComentarios, 80);

oci_execute($statement);

oci_free_statement($statement);
oci_close($conn);

if ($username !== null) {
    echo '<script>alert("Cantidad de comentarios realizados: ' . $cantidadComentarios . '");window.location.href = "comentario.php";</script>';
} else {
    echo '<script>alert("No se encontró ningúna comentario con ese ID.");window.location.href = "comentario.php";</script>';
}
