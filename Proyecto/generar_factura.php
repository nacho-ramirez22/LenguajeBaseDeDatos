<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURA</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php
    session_start();

    if (!isset($_GET['id_paquete']) || !isset($_GET['id_usuario'])) {
        header('Location: paquete.php');
        exit;
    }

    $id_paquete = $_GET['id_paquete'];
    $id_usuario = $_GET['id_usuario'];

    $conn = oci_connect("ESTEBAN", "12345", "localhost/orcl");

    if (!$conn) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    }

    $query_user = "SELECT * FROM usuario WHERE ID_USUARIO = $id_usuario";
    $statement_user = oci_parse($conn, $query_user);
    oci_execute($statement_user);
    $user = oci_fetch_assoc($statement_user);

    $query_paquete = "SELECT * FROM vista_paquete WHERE ID_PAQUETE = $id_paquete";
    $statement_paquete = oci_parse($conn, $query_paquete);
    oci_execute($statement_paquete);
    $paquete = oci_fetch_assoc($statement_paquete);

    oci_free_statement($statement_user);
    oci_free_statement($statement_paquete);
    ?>

    <div class="container mt-5">
        <h2>Factura</h2>
        <hr>
        <h3>Usuario</h3>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nombre:</strong> <?php echo $user['NOMBRE']; ?></li>
            <li class="list-group-item"><strong>Apellido:</strong> <?php echo $user['APELLIDO']; ?></li>
            <li class="list-group-item"><strong>Telefono:</strong> <?php echo $user['TELEFONO']; ?></li>
        </ul>

        <br>
        <h3>Datos del Paquete</h3>
        <ul class="list-group">
            <li class="list-group-item"><strong>Destino:</strong> <?php echo $paquete['DESTINO']; ?></li>
            <li class="list-group-item"><strong>Provincia:</strong> <?php echo $paquete['PROVINCIA']; ?></li>
            <li class="list-group-item"><strong>Tipo de Tour:</strong> <?php echo $paquete['TIPO']; ?></li>
            <li class="list-group-item"><strong>Actividad:</strong> <?php echo $paquete['NOMBRE_ACTIVIDAD']; ?></li>
            <li class="list-group-item"><strong>Comida:</strong> <?php echo $paquete['COMIDA']; ?></li>
            <li class="list-group-item"><strong>Bebida:</strong> <?php echo $paquete['BEBIDA']; ?></li>
            <li class="list-group-item"><strong>Lugar de Salida:</strong> <?php echo $paquete['LUGARSALIDA']; ?></li>
            <li class="list-group-item"><strong>Fecha:</strong> <?php echo $paquete['FECHA']; ?></li>
            <li class="list-group-item"><strong>Precio:</strong> <?php echo $paquete['PRECIO']; ?></li>
        </ul>

        <form action="confirmar_compra.php" method="POST">
            <input type="hidden" name="id_paquete" value="<?php echo $id_paquete; ?>">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <br>
            <button type="submit" class="btn btn-success btn-lg">Confirmar Compra</button>
            <button type="button" class="btn btn-danger btn-lg" onclick="window.location.href = 'paquete.php';">Cancelar</button>
        </form>