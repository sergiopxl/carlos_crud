<?php
include_once 'parameters.php';
//echo "<div> entro en conexion</div>";
// Create connection
$conn = mysqli_connect(HOST, USER, PASSWORD) or die ("No se puede conectar json");
mysqli_select_db($conn, DATABASE);
mysqli_set_charset($conn, "UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>