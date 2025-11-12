<?php
include("conexion.php");
$usuario = $_POST['usuario'];
$password = $_POST['password'];


$password_bd = "SELECT password FROM trabajadores WHERE usuario = '$usuario'";
$result = mysqli_query($conexion, $password_bd);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hashed_password = trim($row['password']);

    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: ../index.html");
    } else {
        echo "Contraseña incorrecta";
    }
} else   {

    echo "No existe ese usuario";
}
?>