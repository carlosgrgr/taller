<?php
require './clases/AutoCarga.php';
$sesion = new Session();
$user = $sesion->getUser();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css" type="text/css"/>
        <title></title>
    </head>
    <body>
        <?php
        if($sesion->isLogged()){
        ?>
        <a href="phplogout.php">Logout</a>
        <?php } else { ?>
        <a href="login.php">Login</a>
        <?php } ?>
        <div id="container">
            <div id="clientes" class="enlace">
                <a href="cliente/index.php">
                    <img src="images/clientes.png" />
                    <h1>Gestionar Clientes</h1>
                </a>
            </div>
          
            <div id="vehiculos" class="enlace">
                <a href="vehiculo/index.php">
                    <img src="images/vehicle.png" />
                    <h1>Gestionar Vehículos</h1>
                </a>
            </div>

            <div id="mecanicos" class="enlace">
                <a href="mecanico/index.php">
                    <img src="images/mecanicos.png" />
                    <h1>Gestionar Mecánicos</h1>
                </a>
            </div>
            
            <div id="facturas" class="enlace">
                <a href="factura/index.php">
                    <img src="images/facturas.png" />
                    <h1>Gestionar Facturas</h1>
                </a>
            </div>
            
        </div>
    </body>
</html>
