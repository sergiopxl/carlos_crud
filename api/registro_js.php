<?php
//CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');
include("conexion.php");

$datos = json_decode(file_get_contents('php://input'));

$nombre = mysqli_real_escape_string($conn, $datos->nombre);
$email = mysqli_real_escape_string($conn, $datos->email);
$password = md5(mysqli_real_escape_string($conn, $datos->password));
$direccion = mysqli_real_escape_string($conn, $datos->direccion);
$telefono = mysqli_real_escape_string($conn, $datos->telefono);

$sqlInsertClientes = "INSERT INTO `clients_tb` (`nombre`, `direccion`, `telefono`, `email`, `password`) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlInsertClientes);
$stmt->bind_param("sssss", $nombre, $direccion, $telefono, $email, $password);
$insercionExitosa = $stmt->execute();
$stmt->close();

if ($insercionExitosa) {
  http_response_code(200);
  echo "Registro exitoso";
} else {
  http_response_code(500);
  echo "Error en el registro";
}
?>
