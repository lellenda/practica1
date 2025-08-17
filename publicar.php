<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
   

    // Procesar imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImg = $_FILES['imagen']['name'];
        $tmp = $_FILES['imagen']['tmp_name'];
        $rutaDestino = 'imagenes/' . $nombreImg;

        if (!is_dir('imagenes')) {
            mkdir('imagenes');
        }

        move_uploaded_file($tmp, $rutaDestino);
    } else {
        $rutaDestino = 'imagenes/default.png'; // o imagen por defecto
    }

    // Insertar en base de datos
    $sql = "INSERT INTO libros (titulo, categoria, imagen) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $titulo, $categoria, $rutaDestino);

    if ($stmt->execute()) {
        echo "✅ Libro publicado correctamente.<br>";
        echo "<a href='dashboard.php'>Volver al dashboard</a>";
    } else {
        echo "❌ Error al publicar: " . $conn->error;
    }
}
?>
