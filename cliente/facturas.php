<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageFactura($bd);
$gestorjoin = new ManageFacturaCliente($bd);

$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$facturas = $gestor->getList($page);
$id = Request::get("id");
$inners = $gestorjoin->join("cli.id=$id");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />

        <title></title>
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
            <h1>Facturas del cliente</h1>
            <table border="1">
                <tr>
                    <th>NumFactura</th>
                    <th>Id Cliente</th>
                    <th>Dni Cliente</th>
                    <th>Nombre Cliente</th>
                    <th>Matrícula</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                </tr>
                <?php
                foreach ($inners as $indice => $inner) {
                    ?>
                <tr>
                    <td><?= $inner["factura"]->getNumFactura(); ?> </td>
                    <td><?= $inner["cliente"]->getId(); ?> </td>
                    <td><?= $inner["cliente"]->getDni(); ?> </td>
                    <td><?= $inner["cliente"]->getNombre(); ?> </td>
                    <td><?= $inner["factura"]->getVehiculo(); ?></td>
                    <td><?= $inner["factura"]->getFecha(); ?></td>
                    <td><?= $inner["factura"]->getDetalle(); ?></td>
                    <td><?= $inner["factura"]->getPrecio(); ?> €</td>
                </tr>
                    <?php
                }
                ?>
            </table>
            <a href="index.php">Volver</a>
        </div>
    </body>
</html>
