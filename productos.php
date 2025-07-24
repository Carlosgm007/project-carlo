<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="produc">

<?php

#AQUI ESTABLECIMOS EL TIEMPO PARA NUESTRA SESION EN 1800 SEGUNDOS LO CUAL EQUIVALE A 30 MINUTOS
ini_set('session.gc_maxlifetime', 1800);
#AQUI ESTABLECIMOS EL TIEMPO PARA NUESTRO COOKIES EN 1800 SEGUNDOS LO QUE EQUIVALE A 30 MIN
ini_set('session.cookie_lifetime', 1800);
#AQUI ESTABLECIMOS EL TIEMPO DE EXPIRACION DE NUESTRO CACHE EN 30 MINUTOS
session_cache_expire(30);


session_start();
#ESTA SERIA NUESTRA LISTA DE DONACIONES POR DEFECTO
$productos = [
    ['id' => 1, 'nombre' => 'Donacion', 'precio' => 10000],
    ['id' => 2, 'nombre' => 'Donacion', 'precio' => 150000],
    ['id' => 3, 'nombre' => 'Donacion', 'precio' => 200000],
    ['id' => 4, 'nombre' => 'Donar ropa', 'precio' => 20000],
    ['id' => 5, 'nombre' => 'Donar desayuno', 'precio' => 20000],
    ['id' => 6, 'nombre' => 'Donar cena', 'precio' => 2000]
];
#AQUI MOSTRAMOS LA LISTA DE DONACIONES MEDIANTE EL BUCLE
foreach ($productos as $producto) {
    echo "ID ". $producto['id']. " - ". $producto['nombre'] . " - $" . $producto['precio'] . "
    <a href='agregar.php?id=" . $producto['id'] . "'>Agregar al carrito</a><br>";
}
#AQUI VINCULAMOS NUESTRO CARRITO PARA VOLVER A LA PAGINA
    echo "<br><a href='carrito.php'> Ir al carrito</a><br>";
?> 

</body>
</html>