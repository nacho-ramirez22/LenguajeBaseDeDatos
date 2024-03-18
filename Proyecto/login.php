<?php
$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM usuario WHERE username = :username AND password = :password";
$statement = oci_parse($conn, $query);
oci_bind_by_name($statement, ":username", $username);
oci_bind_by_name($statement, ":password", $password);
oci_execute($statement);

if ($row = oci_fetch_assoc($statement)) {
    header("Location: index.php");
    exit;
} else {
    echo '<script>alert("Usuario no encontrado o contraseña incorrecta"); window.location.href = "login.html";</script>';
    exit;
}

oci_free_statement($statement);
oci_close($conn);
?>