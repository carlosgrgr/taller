<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageFactura($bd);
$gestorjoin = new ManageFacturaMecanico($bd);

$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$facturas = $gestor->getList($page);
$id = Request::get("id");
$inners = $gestorjoin->join("me.id=$id");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />

        <title>Facturas por mecánico</title>
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
            <h1>Facturas del Mecánico </h1>
            <table border="1">
                <tr>
                    <th>NumFactura</th>
                    <th>Id Mecánico</th>
                    <th>Dni Mecánico</th>
                    <th>Nombre Mecánico</th>
                    <th>Vehículo</th>
                    <th>Fecha</th>
                </tr>
                <?php
                foreach ($inners as $indice => $inner) {
                    ?>
                    <tr>
                        <td><?= $inner["factura"]->getNumFactura() ?></td>
                        <td> <?= $inner["mecanico"]->getId() ?> </td>
                        <td> <?= $inner["mecanico"]->getDni() ?> </td>
                        <td> <?= $inner["mecanico"]->getNombre() ?> </td>
                        <td> <?= $inner["factura"]->getVehiculo() ?></td>
                        <td> <?= $inner["factura"]->getFecha() ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <a href="index.php">Volver</a>
        </div>
    </body>
</html>
