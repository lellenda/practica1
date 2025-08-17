<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit;
}

$error = "";
$success = "";

if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
  $success = $_SESSION['success'];
  unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - La Biblioteca</title>
  <link rel="stylesheet" href="estilos.css" />
</head>
<body class=cuerpo>
<header>
  <h1 >Panel de Administración</h1>
  <a href="logout.php" class="logout-btn">Cerrar sesión</a>
</header>
<div class="publiicar">
  <main>
    <h2 class="p">Publicar Nuevo Libro</h2>
    <?php if($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if($success): ?>
      <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
  <form  class="z" action="publicar.php" method="POST" enctype="multipart/form-data">
  <input type="text" name="titulo" placeholder="Título del libro" required><br>
  <input type="text" name="categoria" placeholder="Categoría" required><br>
  <input type="file" name="imagen"><br>
  <button type="submit">Publicar</button>
</form>

  </main>
</div>
</body>
</html>
