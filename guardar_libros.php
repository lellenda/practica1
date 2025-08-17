<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit;
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $categoria = $conn->real_escape_string($_POST['categoria']);

    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK){
        $fileTmpPath = $_FILES['imagen']['tmp_name'];
        $fileName = basename($_FILES['imagen']['name']);
        $fileSize = $_FILES['imagen']['size'];
        $fileType = $_FILES['imagen']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = './uploads/';
            $dest_path = $uploadFileDir . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $sql = "INSERT INTO libros (titulo, categoria, imagen) VALUES ('$titulo', '$categoria', '$newFileName')";
                if ($conn->query($sql) === TRUE) {
                    $success = "Libro publicado correctamente.";
                } else {
                    $error = "Error al guardar el libro en la base de datos.";
                }
            } else {
                $error = "Error al mover el archivo.";
            }
        } else {
            $error = "Tipo de archivo no permitido. Solo jpg, jpeg, png.";
        }
    } else {
        $error = "Error en la subida de imagen.";
    }
} else {
    $error = "Método no permitido.";
}

if ($error) {
    $_SESSION['error'] = $error;
} else {
    $_SESSION['success'] = $success;
}

header('Location: dashboard.php');
exit;
?>
