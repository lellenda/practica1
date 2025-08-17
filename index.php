<?php
session_start();
require 'conexion.php';

// Cargar libros
$sql = "SELECT * FROM libros ORDER BY fecha_publicacion DESC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>La Biblioteca</title>
<link rel="stylesheet" href="estilos.css" />
</head>
<body>
<header>
  <h1>LA BIBLIOTECA</h1>
</header>
<div class="container">
  <nav class="menu">
    <button class="toggle" aria-label="Toggle menu">☰ categorias</button>
    <ul class="nav-links">
      <li><a href="login.php">Registro</a></li>
      <li><a href="dashboard.php">Panel de control</a></li>
      
    </ul>
  </nav>
  <main>
    <div class="search">
      <input class="lupa" type="text" placeholder="Buscar..." onkeyup="buscarLibros(this.value)" />
      <span class="icono-lupa">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.398 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
      </span>
    </div>
    <div class="section">
      <div class="section-title">Libros Publicados <a</div>
      <div class="books" id="libros-container">
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <div class="book">
             <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['titulo']); ?>" />
              <div><?php echo htmlspecialchars($row['titulo']); ?></div>
              <small><?php echo htmlspecialchars($row['categoria']); ?></small>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No hay libros publicados.</p>
        <?php endif; ?>
      </div>
    </div>
  </main>
</div>

<script src="nav.js"></script>
<script>
function buscarLibros(filtro) {
  filtro = filtro.toLowerCase();
  const libros = document.querySelectorAll('.book');
  libros.forEach(libro => {
    const titulo = libro.querySelector('div').textContent.toLowerCase();
    if (titulo.includes(filtro)) {
      libro.style.display = '';
    } else {
      libro.style.display = 'none';
    }
  });
}
</script>
</body>
</html>
