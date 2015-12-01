<?php
    require './clases/AutoCarga.php';
    $sesion = new Session();
    $log = Request::get("log");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <title></title>
    </head>
    <body>
        <?php
            if(!$sesion->isLogged()){
        ?>
        <form action="phplogin.php" method="post"  >
            <?php if($log == -1){ ?> 
            <p>Usuario o contraseña incorrectas</p> <?php } ?>
            <p>Usuario: <input type="text" name="usuario" placeholder="Usuario" /></p>
            <p>Contraseña: <input type="text" name="password" placeholder="password"/></p>
            <a href="index.php"><input class="long" type="button" value="Entrar sin loguear" /></a>
            <input type="submit" value="Login"/>
            
        </form>
        <?php 
            }
        ?>
    </body>
</html>
