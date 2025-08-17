<?php
session_start();
require 'conexion.php';

if(isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($clave, $row['clave'])) {
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['rol'] = $row['rol'];
            if ($row['rol'] == 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $error = "Clave incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - La Biblioteca</title>
  <link rel="stylesheet" href="estilos.css" />
</head>
<body>
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <?php if($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
      <input type="text" name="usuario" placeholder="Usuario" required autofocus />
      <input type="password" name="clave" placeholder="Clave" required />
      <button type="submit">Ingresar</button>
    </form>
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
  </div>
</body>
</html>
