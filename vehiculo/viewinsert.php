<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorCliente = new ManageCliente($bd);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Nuevo vehículo - Taller</title>
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
            <h1>Añadir nuevo Vehículo</h1>
            <form action="phpinsert.php" method="POST">
                <p>Matrícula<sup>*</sup>: <input type="text" name="matricula" value=""/></p>
                <p>Marca: <input type="text" name="marca" value="" /></p>
                <p>Modelo: <input type="text" name="modelo" value="" /></p>
                <p>Motor: <input type="text" name="motor" value="" /></p>
                <p>Año: <input type="text" name="anio" value="" /></p>
                <p>Propietario<sup>*</sup>: <?php echo Util::getSelect("propietario", $gestorCliente->getValuesSelect()); ?></p>
                <a href="index.php"><input type="button" value="Cancelar" /></a>
                <input type="submit" value="Insertar" />
            </form>
        </div>

    </body>
</html>

<?php
$bd->close();
