<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <H1>Organización sin fines de lucro</H1>
    
<form action="" method="post">

  <label for="nombre">Nombre:</label>
  <input type="text" id="name"  name="nombre" placeholder="Ingrese su nombre" required ><br><br>

  <label for="apellido">Apellido:</label>
  <input type="text" id="apelli"  name="apellido" placeholder="Ingrese su Apellido" required ><br><br>

  <label for="number">Monto</label>
  <input type="number" id="monto" name="monto" style="width: 200px;" placeholder="Ingrese monto de donacion" required><br><br>
  
  <input type="submit" id="enviardona"  value="Enviar donacion">
</form>
<br>

 <?php
//AQUI CREAMOS LA FUNCION PARA LA VALIDACION DE DONACIONES
function validar(){
  //AQUI APLICAMOS LA VALIDACION QUE NOMBRE NO ESTA VACIO, QUE NOMBRE TENGA SOLO LETRAS, QUE MONTO SEA VALOR NUMERICO Y QUE NO SEA
  //MENOS O IGUAL A CERO, Y ASI VALIDAMOS NUESTRA DONACION
  if (empty($_POST['nombre']) || !ctype_alpha($_POST['nombre']) || empty($_POST['apellido'])
   || !ctype_alpha($_POST['apellido']) ||  !is_numeric($_POST['monto']) || $_POST['monto'] <= 0) {
    echo "Error: Datos ingresados no validos.";
  } else {
    echo "¡Gracias ". $_POST['nombre'] . "! por tu donacion de $ " .$_POST['monto'];
  }
}
//AQUI HACEMOS EL LLAMADO A LA FUNCION
validar()
?>   
<br><br>

<h1>Eventos </h1>

<?php
session_start();

class Evento {
    public $descripcion;
    public $tipo;
    public $lugar;
    public $fecha;
    public $hora;

    public function __construct($descripcion, $tipo, $lugar, $fecha, $hora) {
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->lugar = $lugar;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }
}

// ARRAY DE EVENTOS
if (!isset($_SESSION['eventos'])) {
    $_SESSION['eventos'] = [];
}

// FUNCION PARA AGREGAR EVENTOS
function agregarEvento($evento) {
    $_SESSION['eventos'][] = $evento;
}

// AQUI AGREGAMOS EVENTOS INICIALE A NUESTRA TABLA
if (empty($_SESSION['eventos'])) {
    agregarEvento(new Evento("Maraton", "Deporte", "Parque kaukari", "2025-07-03", "10:00"));
    agregarEvento(new Evento("Concierto", "Musica", "Salon Alicanto", "2025-07-20", "20:00"));
    agregarEvento(new Evento("Completada", "Venta comida", "Escuela Italiana", "2025-07-21", "20:00"));
}

// PROCESAR FORMULARIO PARA AGREGAR EVENTOS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar'])) {
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $lugar = $_POST['lugar'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    if ($descripcion && $tipo && $lugar && $fecha && $hora) {
        agregarEvento(new Evento($descripcion, $tipo, $lugar, $fecha, $hora));
    }
}

// PROCESAR FILTRADO POR TIPO DE EVENTOS
$filtroTipo = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['filtro_tipo'])) {
    $filtroTipo = $_GET['filtro_tipo'];
}

$eventosFiltrados = array_filter($_SESSION['eventos'], function($evento) use ($filtroTipo) {
    return empty($filtroTipo) || $evento->tipo == $filtroTipo;
});

?>

<h2>Agregar Evento</h2>

<form method="post" action="">
    <label>Descripción del evento:</label>
    <input type="text" name="descripcion" required><br><br>

    <label>Tipo de evento:</label>
    <input type="text" name="tipo" required><br><br>

    <label>Lugar:</label>
    <input type="text" name="lugar" required><br><br>

    <label>Fecha:</label>
    <input type="date" name="fecha" required><br><br>

    <label>Hora:</label>
    <input type="time" name="hora" required><br><br>

    <button type="submit" name="agregar">Agregar Evento</button>
</form>

<h2>Filtrar por Tipo de Evento</h2>
<form method="get" action="">
    <input type="text" name="filtro_tipo" placeholder="Tipo de evento" value="<?php echo htmlspecialchars($filtroTipo); ?>">
    <button type="submit">Filtrar</button>
</form>

<h2>Eventos</h2>

<table>
    <tr>
        <th>Descripción del evento</th>
        <th>Tipo de evento</th>
        <th>Lugar</th>
        <th>Fecha</th>
        <th>Hora</th>
    </tr>
    <?php foreach ($eventosFiltrados as $evento): ?>
        <tr>
            <td><?php echo htmlspecialchars($evento->descripcion); ?></td>
            <td><?php echo htmlspecialchars($evento->tipo); ?></td>
            <td><?php echo htmlspecialchars($evento->lugar); ?></td>
            <td><?php echo htmlspecialchars($evento->fecha); ?></td>
            <td><?php echo htmlspecialchars($evento->hora); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div id="notification-container">
</div>
<div class="search-container">
</div>
<div id="content-container">
</div>
<div id="results-container">
</div>
<script src="index.js"></script>


<div>
  <h2>Carrito de Donaciones</h2>
  
<a href="agregar.php">
  <button>Agregar Donacion</button>
</a>

<a href="carrito.php">
  <button>Ver Carrito</button>
</a>
</div>


</body>
</html>