<?php
include("conexion.php");
$DNI = $_POST['DNI'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$usuario = $_POST['usuario'];
$mail = $_POST['email'];
$password = $_POST['password'];
$id_tiendas = $_POST['id_tiendas'];

$password_hasheada = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO trabajadores (DNI, nombre, apellido, fecha_nacimiento, email, usuario, password, id_tiendas) VALUES ('$DNI', '$nombre', '$apellido', '$fecha_nacimiento', '$mail', '$usuario', '$password_hasheada', '$id_tiendas')";
$result = mysqli_query($conexion, $query);
if ($result) {
    echo "Empleado insertado correctamente";
} else {
    echo "Error al insertar el empleado: " . mysqli_error($conexion);
}
?>