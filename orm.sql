-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-01-2024 a las 20:08:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `orm`
--

CREATE DATABASE IF NOT EXISTS orm;

USE orm;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Disco`
--

CREATE TABLE `Disco` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `anio` date NOT NULL,
  `publicacion` varchar(255) NOT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `artista` varchar(255) NOT NULL,
  `duracion` int(11) NOT NULL,
  `iswc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Disco`
--

INSERT INTO `Disco` (`id`, `titulo`, `anio`, `publicacion`, `genero`, `imagen`, `estado`, `artista`, `duracion`, `iswc`) VALUES
(1, 'Dark Side of the Moon', '1973-03-01', 'EMI Records', 'Rock', 'Dark_Side_of_the_Moon.webp', 1, 'Pink Floyd', 230, 'ISWC122'),
(2, 'Thriller', '1982-11-30', 'Epic Records', 'Pop', 'thriller.webp', 0, 'Michael Jackson', 312, 'ISWC456'),
(3, 'Back in Black', '1980-07-25', 'Atlantic Records', 'Hard Rock', 'back_in_black.webp', 1, 'AC/DC', 246, 'ISWC789'),
(4, 'Abbey Road', '1969-09-26', 'Apple Records', 'Rock', 'abbey_road.webp', 1, 'The Beatles', 213, 'ISWC012'),
(5, 'The Wall', '1979-11-30', 'Columbia Records', 'Rock', 'the_wall.webp', 1, 'Pink Floyd', 281, 'ISWC345'),
(11, 'Disco de prueba', '2003-02-20', 'Prueba', 'Prueba', '65998f174debb.jpg', 1, 'dario prueba', 250, '235');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Libro`
--

CREATE TABLE `Libro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `anio` datetime NOT NULL,
  `publicacion` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `autor` varchar(255) NOT NULL,
  `paginas` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Libro`
--

INSERT INTO `Libro` (`id`, `titulo`, `anio`, `publicacion`, `genero`, `imagen`, `estado`, `autor`, `paginas`, `isbn`) VALUES
(1, 'The Lord of the Rings', '1954-07-29 00:00:00', 'George Allen & Unwin', 'Fantasy', 'lord_of_the_rings.jpg', 0, 'J.R.R. Tolkien', 1179, 'ISBN105'),
(2, 'To Kill a Mockingbird', '1960-07-11 00:00:00', 'J.B. Lippincott & Co.', 'Fiction', 'mockingbird.jpg', 1, 'Harper Lee', 281, 'ISBN102'),
(3, '1984', '1949-06-08 00:00:00', 'Secker & Warburg', 'Dystopian Fiction', '1984.jpeg', 1, 'George Orwell', 328, 'ISBN103'),
(4, 'The Great Gatsby', '1925-04-10 00:00:00', 'Charles Scribner\'s Sons', 'Fiction', 'great_gatsby.webp', 1, 'F. Scott Fitzgerald', 180, 'ISBN104'),
(5, 'Brave New World', '1932-01-01 00:00:00', 'Chatto & Windus', 'Dystopian Fiction', 'brave_new_world.webp', 1, 'Aldous Huxley', 325, 'ISBN105'),
(6, 'The Catcher in the Rye', '1951-07-16 00:00:00', 'Little, Brown and Company', 'Fiction', 'catcher_in_the_rye.webp', 1, 'J.D. Salinger', 224, 'ISBN106'),
(7, 'Harry Potter and the Sorcerer\'s Stone', '1997-06-26 00:00:00', 'Bloomsbury Publishing', 'Fantasy', 'harry_potter.webp', 1, 'J.K. Rowling', 320, 'ISBN107'),
(8, 'The Hobbit', '1937-09-21 00:00:00', 'George Allen & Unwin', 'Fantasy', 'thehobbit.webp', 1, 'J.R.R. Tolkien', 310, 'ISBN108'),
(9, 'The Chronicles of Narnia: The Lion, the Witch and the Wardrobe', '1950-10-16 00:00:00', 'Geoffrey Bles', 'Fantasy', 'narnia.webp', 1, 'C.S. Lewis', 206, 'ISBN109'),
(10, 'Pride and Prejudice', '1813-01-28 00:00:00', 'T. Egerton, Whitehall', 'Romance', 'pride_and_prejudice.webp', 1, 'Jane Austen', 279, 'ISBN110'),
(11, 'The Alchemist', '1988-01-01 00:00:00', 'HarperCollins', 'Fiction', 'the_alchemist.webp', 1, 'Paulo Coelho', 197, 'ISBN111'),
(12, 'The Da Vinci Code', '2003-03-18 00:00:00', 'Doubleday', 'Mystery', 'da_vinci_code.webp\r\n', 1, 'Dan Brown', 454, 'ISBN112'),
(13, 'Libro de prueba', '0222-02-22 00:00:00', 'libro de prueba', 'libro de prueba', '65999779cc83a.jpg', 0, 'prueba', 200, 'prueba'),
(14, 'modificando', '0002-02-05 00:00:00', 'modificado', 'modificado', '659997af54528.webp', 1, 'dario', 200, '202');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pelicula`
--

CREATE TABLE `Pelicula` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `anio` datetime NOT NULL,
  `publicacion` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `director` varchar(255) NOT NULL,
  `reparto` text NOT NULL,
  `duracion` int(11) NOT NULL,
  `isan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Pelicula`
--

INSERT INTO `Pelicula` (`id`, `titulo`, `anio`, `publicacion`, `genero`, `imagen`, `estado`, `director`, `reparto`, `duracion`, `isan`) VALUES
(1, 'The Shawshank Redemption', '1994-09-23 00:00:00', 'Columbia Pictures', 'Drama', '65999569c170d.webp', 1, 'Frank Darabonaa', 'Tim Robbins, Morgan Freeman', 142, 'ISAN001'),
(2, 'The Godfather', '1972-03-14 00:00:00', 'Paramount Pictures', 'Drama', 'the_godfather.webp', 1, 'Francis Ford Coppola', 'Marlon Brando, Al Pacino', 175, 'ISAN002'),
(3, 'The Dark Knight', '2008-07-14 00:00:00', 'Warner Bros. Pictures', 'Action', 'dark_night.jpg', 1, 'Christopher Nolan', 'Christian Bale, Heath Ledger', 152, 'ISAN003'),
(4, 'Pulp Fiction', '1994-05-21 00:00:00', 'Miramax Films', 'Crime', 'pulp_fiction.webp', 1, 'Quentin Tarantino', 'John Travolta, Uma Thurman', 154, 'ISAN004'),
(5, 'Forrest Gump', '1994-06-23 00:00:00', 'Paramount Pictures', 'Drama', 'forrest_gump.webp', 1, 'Robert Zemeckis', 'Tom Hanks, Robin Wright', 142, 'ISAN005'),
(6, 'prueba', '2003-02-22 00:00:00', 'prueba', 'pruebas', '65999db1991ed.jpg', 1, 'Pelicula prueba', 'prueba', 250, 'Prueba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Disco`
--
ALTER TABLE `Disco`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Libro`
--
ALTER TABLE `Libro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Pelicula`
--
ALTER TABLE `Pelicula`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Disco`
--
ALTER TABLE `Disco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `Libro`
--
ALTER TABLE `Libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `Pelicula`
--
ALTER TABLE `Pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
