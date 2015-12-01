<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$user = $sesion->getUser();
$bd = new DataBase();
$gestor = new ManageFactura($bd);
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$facturas = $gestor->getList($page);
$op = Request::get("op");
$r = Request::get("r");

$gestorjoin = new ManageFacturaMecanico($bd);
$inners = $gestorjoin->join();






?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Facturas - Taller</title>
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
        
        <?php
        if($sesion->isLogged()){
        ?>
        <a href="../phplogout.php">Logout</a>
        <?php } else { ?>
        <a href="../login.php">Login</a>
        <?php } ?>
        
        <div id="wrapper">
            <h1>Facturas</h1>
            <?php
                if($sesion->isLogged()){
            ?>
            <a href="viewinsert.php"><img class="add" src="../images/add.png"/></a>
            <?php
                }
                if ($op != null) {
                    if($r == 1){
                        echo "<h3>Se ha $op $r factura con éxito.</h3>";
                    }else{
                        echo "<h3>No se ha podido realizar la operación de $op.</h3>";
                    }
                }
                ?>
            <table border="1">
                <tr>
                    <th>numFactura</th>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Mecánico</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <?php
                        if($sesion->isLogged()){
                        ?>
                    <th colspan="2">Acciones</th>
                    <?php
                        }
                        ?>
                </tr>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <a href="?page=1">Primero</a>
                            <a href="?page=<?php echo max(1, $page - 1); ?>">Anterior</a>
                            <a href="?page=<?php echo min($page + 1); ?>">Siguiente</a>
                            <a href="?page=<?php echo "calcular"; ?>">Última</a>
                            <span>Total: <?= $bd->getCount() ?> facturas</span>
                        </td>
                    </tr>
                </tfoot>
                <?php
                foreach ($facturas as $indice => $factura) {
                    ?>
                    <tr>
                        <td><?php echo $factura->getNumFactura(); ?></td>
                        <td><?php echo $factura->getCliente(); ?></td>
                        <td><?php echo $factura->getVehiculo(); ?></td>
                        <td><?php echo $factura->getMecanico(); ?></td>
                        <td id="fecha"><?php echo $factura->getFecha(); ?></td>
                        <td><?php echo $factura->getDetalle(); ?></td>
                        <td id="precio"><?php echo $factura->getPrecio(); ?> €</td>
                        <?php
                        if($sesion->isLogged()){
                        ?>
                        <td class="accion"><?php echo "<a class='editar' href='viewedit.php?numFactura={$factura->getNumFactura()}'><img src='../images/edit.png'/></a>"; ?></td>
                        <td class="accion"><?php echo "<a class='borrar' class='borrar' href='phpdelete.php?numFactura={$factura->getNumFactura()}'><img src='../images/deleteN.png'/></a> "; ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <script src="../js/scripts.js"></script>
    </body>
</html>

<?php
$bd->close();
