<?php
include("conexion.php");
$usuario = $_POST['usuario'];
$password = $_POST['password'];


$query = "SELECT * FROM trabajadores WHERE usuario = '$usuario' AND password = '$password'";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) > 0) {
    // El usuario y la contraseña son correctos
    session_start();
    $_SESSION['usuario'] = $usuario;
    header("Location: ../html/inicio.html");
} else {
    // El usuario o la contraseña son incorrectos
    echo "No existe ese usuario";
}
?>