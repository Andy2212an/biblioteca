# 📚 Proyecto Biblioteca 

Este proyecto implementa un sistema de gestión de **recursos de biblioteca** usando **CodeIgniter 4** y **MySQL**.  
Incluye la administración de **categorías, subcategorías, editoriales y recursos**.

---

## 🚀 Rama con cambios
Los cambios y mejoras realizados se encuentran en la rama **`Tarea_04`**.  
Para revisarlos debes cambiarte a esa rama:
```bash

git checkout Tarea_04
```

🗄️ Base de Datos

Para que el módulo listar.php (recursos) funcione correctamente, es necesario crear la base de datos y tablas con el siguiente script en MySQL:
```bash

CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

CREATE TABLE categorias (
  idcategoria INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

INSERT INTO categorias (nombre) VALUES
('Matemáticas'),
('Comunicación'),
('Computación');

CREATE TABLE subcategorias (
  idsubcategoria INT AUTO_INCREMENT PRIMARY KEY,
  idcategoria INT NOT NULL,
  nombre VARCHAR(150) NOT NULL,
  FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria)
);

INSERT INTO subcategorias (idcategoria, nombre) VALUES
(1, 'Razonamiento Lógico Matemático'),
(1, 'Álgebra'),
(1, 'Trigonometría'),
(2, 'Razonamiento verbal'),
(2, 'Composición'),
(2, 'Redacción'),
(3, 'Base de datos'),
(3, 'Sistemas Operativos'),
(3, 'Lenguajes de Programación');

CREATE TABLE editoriales (
  ideditorial INT AUTO_INCREMENT PRIMARY KEY,
  empresa VARCHAR(150) NOT NULL,
  nacionalidad VARCHAR(100) NOT NULL
);

INSERT INTO editoriales (empresa, nacionalidad) VALUES
('Pearson', 'EEUU'),
('Santillana', 'España'),
('McGraw Hill', 'México');

CREATE TABLE recursos (
  idrecurso INT AUTO_INCREMENT PRIMARY KEY,
  idsubcategoria INT NOT NULL,
  ideditorial INT NOT NULL,
  tipo ENUM('FISICO','DIGITAL') NOT NULL,
  titulo VARCHAR(255) NOT NULL,
  apublicacion YEAR NOT NULL,
  isbn VARCHAR(20) UNIQUE,
  numpaginas INT,
  rutaportada VARCHAR(255),
  rutarecurso VARCHAR(255),
  estado ENUM('BUENO','REGULAR','MALO') NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  modificado TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (idsubcategoria) REFERENCES subcategorias(idsubcategoria),
  FOREIGN KEY (ideditorial) REFERENCES editoriales(ideditorial)
);

INSERT INTO recursos (idsubcategoria, ideditorial, tipo, titulo, apublicacion, isbn, numpaginas, rutaportada, rutarecurso, estado)
VALUES
(1, 1, 'FISICO', 'Matemáticas Básicas', 2007, '9781234567890', 350, 'portadas/matematicas.jpg', NULL, 'BUENO'),
(4, 2, 'DIGITAL', 'Manual de Comunicación', 2015, '9789876543210', 220, 'portadas/comunicacion.jpg', 'recursos/comunicacion.pdf', 'REGULAR'),
(7, 3, 'DIGITAL', 'Introducción a Bases de Datos', 2020, '9781122334455', 500, 'portadas/bd.jpg', 'recursos/bd.pdf', 'BUENO');

```

SELECT * FROM recursos;

