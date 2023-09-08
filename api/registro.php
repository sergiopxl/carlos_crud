<?php

// CORDS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');


include ("conexion.php");

$datos = json_decode(file_get_contents('php://input'));

$nombre = mysqli_real_escape_string($conn, $datos->nombre);
$email = mysqli_real_escape_string($conn, $datos->email);
$password = md5(mysqli_real_escape_string($conn, $datos->password));
$direccion = mysqli_real_escape_string($conn, $datos->direccion);
$telefono = mysqli_real_escape_string($conn, $datos->telefono);
//echo json_encode([$nombre]);
/*
// Validar los datos del formulario
if (empty($nombre) || empty($email) || empty($password) || empty($direccion) || empty($telefono)) {
  // Alguno de los campos requeridos está vacío
  http_response_code(400); // Indicar un error de solicitud incorrecta (código 400)
  exit;
}*/

// Aplicar codificación MD5 a la contraseña
$password = md5($password);

// Crear la consulta SQL utilizando prepared statements

$sqlInsertClientes = "INSERT INTO `clients_tb` (`nombre`, `direccion`, `telefono`, `email`, `password`) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlInsertClientes);
$stmt->bind_param("sssss", $nombre, $direccion, $telefono, $email, $password);
$insercionExitosa = $stmt->execute();
$stmt->close();

// Comprobar si la inserción fue exitosa
if ($insercionExitosa) {
  http_response_code(200); // Indicar que la respuesta es exitosa (código 200)
  echo json_encode(["registro con exito"]);
} else {
  http_response_code(500); // Indicar que ocurrió un error en el servidor (código 500)
  echo json_encode(["Error terrible"]);
}
?>
