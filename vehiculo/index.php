<?php
require '../clases/AutoCarga.php';

$sesion = new Session();
$user = $sesion->getUser();

$bd = new DataBase();
$gestor = new ManageVehiculo($bd);
$gestorCliente = new ManageCliente($bd);
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$vehiculos = $gestor->getList($page);
$op = Request::get("op");
$r = Request::get("r");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <title>Vehículos - Taller</title>
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
            <h1>Vehículos</h1>
            <?php
                if($sesion->isLogged()){
            ?>
            <a href="viewinsert.php"><img class="add" src="../images/add.png"/></a>
            <?php
                }
            if ($op != null) {
                if($r == 1){
                    echo "<h3>Se ha $op $r vehículo con éxito.</h3>";
                }else{
                    echo "<h3>No se ha podido realizar la operación de $op.</h3>";
                }
            }
            ?>
            <table border="1">
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Motor</th>
                    <th>Año</th>
                    <th>Propietario</th>
                    <th colspan="4">Acciones</th>
                </tr>
                <tfoot>
                    <tr>
                        <td colspan="11">
                            <a href="?page=1">Primero</a>
                            <a href="?page=<?php echo max(1, $page - 1); ?>">Anterior</a>
                            <a href="?page=<?php echo min($page + 1); ?>">Siguiente</a>
                            <a href="?page=<?php echo "calcular"; ?>">Última</a>
                            <span>Total: <?= $bd->getCount() ?> vehículos</span>
                        </td>
                    </tr>
                </tfoot>
                <?php
                foreach ($vehiculos as $indice => $vehiculo) {
                    ?>
                    <tr>
                        <td><?php echo $vehiculo->getMatricula(); ?></td>
                        <td><?php echo $vehiculo->getMarca(); ?></td>
                        <td><?php echo $vehiculo->getModelo(); ?></td>
                        <td><?php echo $vehiculo->getMotor(); ?></td>
                        <td><?php echo $vehiculo->getAnio(); ?></td>
                        <td><?php echo $gestorCliente->get($vehiculo->getPropietario())->getDni(); ?></td>
                        <?php
                        if($sesion->isLogged()){
                        ?>
                        <td class="accion"><?php echo "<a href='viewedit.php?matricula={$vehiculo->getMatricula()}'><img src='../images/edit.png'/></a>"; ?></td>
                        <td class="accion"><?php echo "<a class='borrar' href='phpdelete.php?matricula={$vehiculo->getMatricula()}'><img src='../images/deleteN.png'/></a> "; ?></td>
                        <td class="accion"><?php echo "<a class='borrar' href='phpdelete.php?f=1&matricula={$vehiculo->getMatricula()}'><img src='../images/delete.png'/></a> "; ?></td>
                        <?php
                        }
                        ?>
                        <td class="accion"><?php echo "<a href='facturas.php?matricula={$vehiculo->getMatricula()}'><img src='../images/view.png'/></a> "; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <script src="../js/scripts.js"></script>
    </body>
</html>

<?php
$bd->close();
