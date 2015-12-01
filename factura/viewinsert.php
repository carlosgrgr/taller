<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorCliente = new ManageCliente($bd);
$gestorVehiculo = new ManageVehiculo($bd);
$gestorMecanico = new ManageMecanico($bd);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Nueva factura - Taller</title>
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
            <h1>Añadir nueva Factura</h1>
            <form action="phpinsert.php" method="POST">
                <input type="hidden" name="numFactura" value=""/>
                <input type="hidden" name="cliente" value="" />
                <p>Vehículo<sup>*</sup>: <?php echo Util::getSelect("vehiculo", $gestorVehiculo->getValuesSelect()); ?></p>
                <p>Mecánico<sup>*</sup>: <?php echo Util::getSelect("mecanico", $gestorMecanico->getValuesSelect()); ?></p>
                <p>Fecha:  <input type="date" name="fecha" value="" /></p>
                <p>Detalle: <textarea name="detalle" cols="32" rows="10"></textarea></p>
                <p>Precio: <input type="text" name="precio" value="" /></p>
                <a href="index.php"><input type="button" value="Cancelar" /></a>
                <input type="submit" value="Insertar" />
            </form>

    </body>
</html>

<?php
$bd->close();
