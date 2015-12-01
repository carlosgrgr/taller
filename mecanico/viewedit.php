<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageMecanico($bd);
$id = Request::get("id");
$mecanico = $gestor->get($id);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Editar mecanico - Taller</title>
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
            <h1>Editar Mecánico</h1>
            <form action="phpedit.php" method="POST">
                <p>Id<sup>*</sup>: <input type="number" name="id" value="<?php echo $mecanico->getId(); ?>"  /></p>
                <p>Dni<sup>*</sup>: <input type="text" name="dni" value="<?php echo $mecanico->getDni(); ?>" /></p>
                <p>Nombre: <input type="text" name="nombre" value="<?php echo $mecanico->getNombre(); ?>" /></p>
                <p>Primer Apellido: <input type="text" name="apellido1" value="<?php echo $mecanico->getApellido1(); ?>" /></p>
                <p>Segundo Apellido: <input type="text" name="apellido2" value="<?php echo $mecanico->getApellido2(); ?>" /></p>
                <p>Dirección: <input type="text" name="direccion" value="<?php echo $mecanico->getDireccion(); ?>" /></p>
                <p>Telefono: <input type="number" name="telefono" value="<?php echo $mecanico->getTelefono(); ?>" /></p>
                <input type="hidden" name="pkid" value="<?php echo $mecanico->getId(); ?>" />
                <a href="index.php"><input type="button" value="Cancelar" /></a>
                <input type="submit" value="Editar" />
            </form>
        </div>
    </body>
</html>

<?php
$bd->close();
