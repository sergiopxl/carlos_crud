<?php
// CORDS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST,GET');

include ("conexion.php");

// Obtener los datos del formulario
if(isset($_POST['email'])){
  $email = $_POST['email'];
}

if(isset($_POST['password'])){
  $password = md5($_POST['password']);
}

if(isset($_GET['email'])){
  $email = $_GET['email'];
  //echo json_encode(["Si llega email get"]);
}else{
 //echo json_encode(["No llega email get"]);
}

if(isset($_GET['password'])){
  $password = md5($_GET['password']);
  //echo json_encode(["Si llega password get"]);
}else{
  //echo json_encode(["No llega password get"]);
}

// Consultar la base de datos para verificar las credenciales
$sql = "SELECT `id`, `nombre`, `direccion`, `telefono`, `email` FROM `clients_tb` WHERE `email` = '$email' AND `password` = '$password'";
$result = $conn->query($sql);
$resultados = [];
if ($result->num_rows > 0) {
  // Inicio de sesión exitoso
  while($resultado = mysqli_fetch_assoc($result)){
    $resultados[] = $resultado;
  }
  $tokenG = generateToken();
  $resultados[] = $tokenG;
  echo json_encode($resultados);
} else {
  echo json_encode([0]);
}
function generateToken($length = 32) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#$%&';
  $token = '';
  
  for ($i = 0; $i < $length; $i++) {
      $randomIndex = random_int(0, strlen($characters) - 1);
      $token .= $characters[$randomIndex];
  }
  
  return $token;
}
?>
