<?php

session_start();

if (isset($_POST['id_paquete']) && isset($_POST['id_usuario'])) {
    $id_paquete = $_POST['id_paquete'];
    $id_usuario = $_POST['id_usuario'];

    $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

    if (!$conn) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    }

    $query = "BEGIN agregar_factura (:id_usuario, :id_paquete); END;";
    $statement = oci_parse($conn, $query);

    oci_bind_by_name($statement, ":id_usuario", $id_usuario);
    oci_bind_by_name($statement, ":id_paquete", $id_paquete);

    $result = oci_execute($statement);

    if ($result) {
        echo '<script>alert("Factura registrada correctamente"); window.location.href = "paquete.php";</script>';
        exit;
    } else {
        $m = oci_error($statement);
        echo "Error al registrar la factura" . $m['message'];
    }


    oci_free_statement($statement);
    oci_close($conn);
}
