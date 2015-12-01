<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor= new ManageCliente($bd);
$id = Request::get("id");
$cliente = $gestor->get($id);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Editar cliente - Taller</title>
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
            <h1>Editar Cliente</h1>
            <form action="phpedit.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $cliente->getId() ;?>" />
                <p>Dni<sup>*</sup>: </label><input type="text" name="dni" value="<?php echo $cliente->getDni() ;?>" /></p>
                <p>Nombre<sup>*</sup>: </label><input type="text" name="nombre" value="<?php echo $cliente->getNombre() ;?>" /></p>
                <p>Primer Apellido: </label><input type="text" name="apellido1" value="<?php echo $cliente->getApellido1() ;?>"/></p>
                <p>Segundo Apellido: </label><input type="text" name="apellido2" value="<?php echo $cliente->getApellido2() ;?>"/></p>
                <p>Dirección: </label><input type="text" name="direccion" value="<?php echo $cliente->getDireccion() ;?>" /></p>
                <p>Telefono: </label><input type="number" name="telefono" value="<?php echo $cliente->getTelefono() ;?>" /></p>
                <input type="hidden" name="pkid" value="<?php echo $cliente->getId();?>" />
                <a href="index.php"><input type="button" value="Cancelar" /></a>
                <input type="submit" value="Guardar" />
            </form>
        </div>
    </body>
</html>

<?php
$bd->close();