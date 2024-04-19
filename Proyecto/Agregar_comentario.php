<?php
session_start();

if (!isset($_SESSION['id_usuario']) || !isset($_POST['comentario'])) {
    header('Location: comentario.php');
    exit;
}

$comentario = $_POST['comentario'];
$id_usuario = $_SESSION['id_usuario'];

$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}


$query = "BEGIN agregar_comentario (:comentario, :id_usuario); END;";
$statement = oci_parse($conn, $query);

oci_bind_by_name($statement, ":comentario", $comentario);
oci_bind_by_name($statement, ":id_usuario", $id_usuario);

$result = oci_execute($statement);

if ($result) {
    header('Location: comentario.php');
    exit;
} else {
    $m = oci_error($statement);
    echo "Error al agregar el comentario" . $m['message'];
}


oci_free_statement($statement);
oci_close($conn);
