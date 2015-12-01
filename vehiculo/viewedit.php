<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorVehiculo = new ManageVehiculo($bd);
$matricula = Request::get("matricula");
$vehiculo = $gestorVehiculo->get($matricula);
$gestorCliente = new ManageCliente($bd);

//getValues da un select con los dnis del propietario
//tengo que sacar el id para que funcione la propiedad selected
$id = $vehiculo->getPropietario();
$cliente = new Cliente();
$cliente = $gestorCliente->get($id);
$dni = $cliente->getDni();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Editar Vehículo - Taller</title>
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
            <h1>Editar Vehículo</h1>
            <form action="phpedit.php" method="POST">
                <p>Matrícula: <input type="text" name="matricula" value="<?php echo $vehiculo->getMatricula(); ?>"/></p>
                <p>Marca: <input type="text" name="marca" value="<?php echo $vehiculo->getMarca(); ?>"/></p>
                <p>Modelo: <input type="text" name="modelo" value="<?php echo $vehiculo->getModelo(); ?>"/></p>
                <p>Motor: <input type="text" name="motor" value="<?php echo $vehiculo->getMotor(); ?>"/></p>
                <p>Año: <input type="text" name="anio" value="<?php echo $vehiculo->getAnio(); ?>"/></p>
                <p>Propietario: <?php echo Util::getSelect("propietario", $gestorCliente->getValuesSelect(), $dni, false); ?></p>
                <input type="hidden" name="pkMatricula" value="<?php echo $vehiculo->getMatricula(); ?>" /></p>
                <a href="index.php"><input type="button" value="Cancelar" /></a>
                <input type="submit" value="Edición" />
            </form>
        </div>
    </body>
</html>

<?php
$bd->close();
