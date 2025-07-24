<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="carr">
<?php
#AQUI ESTABLECIMOS EL TIEMPO PARA NUESTRA SESION EN 1800 SEGUNDOS LO CUAL EQUIVALE A 30 MINUTOS
ini_set('session.gc_maxlifetime', 1800);
#AQUI ESTABLECIMOS EL TIEMPO PARA NUESTRO COOKIES EN 1800 SEGUNDOS LO QUE EQUIVALE A 30 MIN
ini_set('session.cookie_lifetime', 1800);
#AQUI ESTABLECIMOS EL TIEMPO DE EXPIRACION DE NUESTRO CACHE EN 30 MINUTOS
session_cache_expire(30);

session_start();

# CONDICION PARAVALIDAR SI EL CARRO ESTA VACIO
if (empty($_SESSION['carrito'])) {
    #MOSTRAR MENSAJE CARRO VACIO EN PANTALLA
    echo "<br>El carrito está vacío<br>";
} else {
    #MOSTRAR DONACIONES POR PANTALLA
    foreach ($_SESSION['carrito'] as $productoId => $cantidad ) {
        echo "Id : " . $productoId . " Cantidad de donaciones: " . $cantidad . " <a href='eliminar_prod.php?id=" . $productoId . "'>Eliminar</a><br>";
     
    }
}
#AQUI CREAMOS VINCULO ENTRE PAGINAS
echo "<br><a href='agregar.php'>Agregar Donacion</a><br>";
echo "<a href='principal_html.php'>Volver a la pagina principal</a>";
?> 

</body>
</html>