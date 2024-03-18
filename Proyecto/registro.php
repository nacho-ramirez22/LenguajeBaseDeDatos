<?php

$conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_query = "SELECT COUNT(*) FROM usuario WHERE username = :username";
    $check_statement = oci_parse($conn, $check_query);
    oci_bind_by_name($check_statement, ":username", $username);
    oci_execute($check_statement);
    $row = oci_fetch_assoc($check_statement);
    $user_count = $row['COUNT(*)'];

    if ($user_count > 0) {
        echo '<script>alert("El nombre de usuario ya está en uso. Por favor, elija otro nombre de usuario."); window.location.href = "registro.html";</script>';
        exit;
    }

    $query = "BEGIN agregar_usuario(:nombre, :apellido, :telefono, :username, :password); END;";
    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ":nombre", $nombre);
    oci_bind_by_name($statement, ":apellido", $apellido);
    oci_bind_by_name($statement, ":telefono", $telefono);
    oci_bind_by_name($statement, ":username", $username);
    oci_bind_by_name($statement, ":password", $password);

    $result = oci_execute($statement);

    if ($result) {
        echo '<script>alert("Usuario registrado correctamente"); window.location.href = "login.html";</script>';
        exit;
    } else {
        echo "Error al registrar el usuario.";
    }
}

oci_free_statement($statement);
oci_close($conn);
