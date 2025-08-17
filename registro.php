<?php
session_start();
require 'conexion.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $clave = $_POST['clave'];
    $clave2 = $_POST['clave2'];
    $rol = 'usuario'; // por defecto

    if ($clave !== $clave2) {
        $error = "Las claves no coinciden.";
    } else {
        $sqlCheck = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resCheck = $conn->query($sqlCheck);
        if ($resCheck->num_rows > 0) {
            $error = "El usuario ya existe.";
        } else {
            $claveHash = password_hash($clave, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (usuario, clave, rol) VALUES ('$usuario', '$claveHash', '$rol')";
            if ($conn->query($sql) === TRUE) {
                $success = "Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a>";
            } else {
                $error = "Error al registrar usuario.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro - La Biblioteca</title>
  <link rel="stylesheet" href="estilos.css" />
</head>
<body>
  <div class="login-container">
    <h2>Registro de Usuario</h2>
    <?php if($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if($success): ?>
      <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form method="POST" action="registro.php">
      <input type="text" name="usuario" placeholder="Usuario" required autofocus />
      <input type="password" name="clave" placeholder="Clave" required />
      <input type="password" name="clave2" placeholder="Confirmar Clave" required />
      <button type="submit">Registrar</button>
    </form>
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
  </div>
</body>
</html>
