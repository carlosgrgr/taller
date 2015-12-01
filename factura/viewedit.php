<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorFactura = new ManageFactura($bd);
$numFactura = Request::get("numFactura");
$factura = $gestorFactura->get($numFactura);
$gestorCliente = new ManageCliente($bd);
$gestorVehiculo = new ManageVehiculo($bd);
$gestorMecanico = new ManageMecanico($bd);

//getValues da un select con los dnis del propietario
//tengo que sacar el id para que funcione la propiedad selected
$id = $factura->getCliente();
$cliente = new Cliente();
$cliente = $gestorCliente->get($id);
$dni = $cliente->getDni();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Editar factura - Taller</title>
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
            <h1>Editar Factura</h1>
            <form action="phpedit.php" method="POST">
                <p><input type="hidden" name="numFactura" value="<?php echo $factura->getNumFactura(); ?>"/></p>
                <input type="hidden" name="cliente" value="" /></p>
                <p>Vehículo: <?php echo Util::getSelect("vehiculo", $gestorVehiculo->getValuesSelect(), $factura->getVehiculo(), false); ?></p>
                <p>Mecánico: <?php echo Util::getSelect("mecanico", $gestorMecanico->getValuesSelect(), $factura->getMecanico(), false); ?></p>
                <p>Fecha:<input type="date" name="fecha" value="<?php echo $factura->getFecha(); ?>"/></p>
                <p>Detalle: <textarea name="detalle" cols="32" rows="10"><?php echo $factura->getDetalle(); ?></textarea></p>
                <p>Precio: <input type="text" name="precio" value="<?php echo $factura->getPrecio(); ?>" /></p>
                <input type="hidden" name="pknumFactura" value="<?php echo $factura->getNumFactura(); ?>" /></p>
                <a href="index.php"><input type="button" value="Cancelar" /></a>
                <input type="submit" value="Edición" />
            </form>
    </body>
</html>

<?php
$bd->close();
