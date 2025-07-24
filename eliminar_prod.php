<?php
#AQUI ESTABLECIMOS EL TIEMPO PARA NUESTRA SESION EN 1800 SEGUNDOS LO CUAL EQUIVALE A 30 MINUTOS
ini_set('session.gc_maxlifetime', 1800);
#AQUI ESTABLECIMOS EL TIEMPO PARA NUESTRO COOKIES EN 1800 SEGUNDOS LO QUE EQUIVALE A 30 MIN
ini_set('session.cookie_lifetime', 1800);
#AQUI ESTABLECIMOS EL TIEMPO DE EXPIRACION DE NUESTRO CACHE EN 30 MINUTOS
session_cache_expire(30);

session_start();
# VALIDACION DE ID
if (isset($_GET['id'])) {
    #OBTENER ID MEDIANTE GET
    $productoId = $_GET['id'];
    #ELIMINAR PRODUCTO DEL CARRITO
    unset($_SESSION['carrito'][$productoId]);
}
header('Location: carrito.php'); # REDIRIGIR A CARRITO
?>

