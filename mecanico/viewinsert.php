<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Nuevo mecánico - Taller</title>
    </head>
    <body>
        <div id="menu">
            <nav>
                <ul>
                    <a href="../index.php"><li>INICIO</li></a>
                    <a href="../cliente/index.php"><li>CLIENTES</li></a>
                    <a href="../vehiculo/index.php"><li>VEHÍCULOS</li></a>
                    <a href="../mecanico/index.php"><li>MECÁNICOS</li></a>
                    <a href="../factura/index.php"><li>FACTURAS</li></a>
                </ul>
            </nav>
        </div>
        <div id="wrapper">
            <h1>Añadir nuevo Mecánico</h1>
            <form action="phpinsert.php" method="POST">
                <p>Dni<sup>*</sup>: <input type="text" name="dni" value=""/></p>
                <p>Nombre<sup>*</sup>: <input type="text" name="nombre" value=""/></p>
                <p>Primer apellido: <input type="text" name="apellido1" value="" /></p>
                <p>Segundo apellido: <input type="text" name="apellido2" value="" /></p>
                <p>Dirección: <input type="text" name="direccion" value="" /></p>
                <p>Teléfono: <input type="text" name="telefono" value="" /></p>
                <a href="index.php"><input type="button" value="Cancelar" /></a>
                <input type="submit" value="Insertar" />
            </form>
        </div>
    </body>
</html>

<?php
$bd->close();
