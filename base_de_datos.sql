CREATE DATABASE biblioteca2;

USE biblioteca2;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(100) NOT NULL,
  clave VARCHAR(255) NOT NULL,
  rol ENUM('admin', 'usuario') DEFAULT 'usuario'
);

CREATE TABLE libros (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255),
  categoria VARCHAR(100),
  imagen VARCHAR(255),
  fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
