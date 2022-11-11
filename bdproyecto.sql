-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2022 a las 00:09:49
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdproyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

CREATE TABLE `competencia` (
  `idcompetencia` int(5) NOT NULL,
  `nomcompetencia` varchar(30) NOT NULL,
  `fechainicio` date DEFAULT NULL CHECK (`fechainicio` < `fechafin`),
  `fechafin` date DEFAULT NULL CHECK (`fechafin` > `fechainicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `competencia`
--

INSERT INTO `competencia` (`idcompetencia`, `nomcompetencia`, `fechainicio`, `fechafin`) VALUES
(12345, 'Liga1', '2019-01-02', '2019-12-31'),
(23456, 'Liga2', '2019-01-02', '2019-12-31'),
(34567, 'Liga3', '2020-01-02', '2020-12-31'),
(45678, 'Liga4', '2022-02-01', '2022-09-30'),
(56789, 'Liga5', '2022-02-01', '2022-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compone`
--

CREATE TABLE `compone` (
  `idcompetencia` int(5) NOT NULL,
  `iddeporte` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compone`
--

INSERT INTO `compone` (`idcompetencia`, `iddeporte`) VALUES
(12345, 12),
(23456, 12),
(34567, 12),
(45678, 23),
(56789, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convocado`
--

CREATE TABLE `convocado` (
  `cijugador` int(11) NOT NULL,
  `idconvocado` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `convocado`
--

INSERT INTO `convocado` (`cijugador`, `idconvocado`) VALUES
(12345678, 123456),
(23456789, 234567),
(34567890, 456789),
(45678901, 345678),
(49244291, 567890),
(51642837, 678901),
(56789012, 789012),
(67890123, 890123),
(78901234, 901234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `iddeporte` int(2) NOT NULL,
  `nomdeporte` varchar(20) NOT NULL,
  `convocables` int(11) DEFAULT NULL,
  `titulares` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO `deporte` (`iddeporte`, `nomdeporte`, `convocables`, `titulares`) VALUES
(12, 'Futbol', NULL, NULL),
(23, 'Basketball', NULL, NULL),
(34, 'Handball', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disputa`
--

CREATE TABLE `disputa` (
  `idequipo` int(3) NOT NULL,
  `idcompetencia` int(5) NOT NULL,
  `jugados` int(11) DEFAULT NULL,
  `ganados` int(11) DEFAULT NULL,
  `perdidos` int(11) DEFAULT NULL,
  `empatados` int(11) DEFAULT NULL,
  `gf` int(11) DEFAULT NULL,
  `gc` int(11) DEFAULT NULL,
  `dif` int(11) DEFAULT NULL,
  `pts` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disputa`
--

INSERT INTO `disputa` (`idequipo`, `idcompetencia`, `jugados`, `ganados`, `perdidos`, `empatados`, `gf`, `gc`, `dif`, `pts`) VALUES
(123, 12345, 3, 2, 0, 1, 7, 4, 3, 7),
(123, 23456, 3, 1, 1, 1, 4, 2, 2, 4),
(123, 34567, 3, 1, 0, 2, 6, 5, 1, 5),
(231, 12345, 3, 1, 1, 1, 5, 6, -1, 4),
(231, 23456, 3, 2, 0, 1, 7, 3, 4, 7),
(231, 34567, 3, 2, 0, 1, 5, 2, 3, 7),
(312, 12345, 3, 0, 1, 2, 6, 7, -1, 2),
(312, 23456, 3, 2, 1, 0, 4, 4, 0, 6),
(312, 34567, 3, 0, 1, 2, 3, 5, -2, 2),
(321, 12345, 3, 0, 1, 2, 4, 5, -1, 2),
(321, 23456, 3, 0, 3, 0, 3, 8, -5, 0),
(321, 34567, 3, 0, 2, 1, 2, 4, -2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` int(3) NOT NULL,
  `nomequipo` varchar(30) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `nomequipo`, `idusuario`) VALUES
(123, 'Equipofutbol1', 1),
(213, 'Equipofutbol5', 5),
(231, 'Equipofutbol2', 2),
(312, 'Equipofutbol3', 3),
(321, 'Equipofutbol4', 4),
(456, 'Equipobasquet1', 1),
(546, 'Equipobasquet4', 4),
(564, 'Equipobasquet2', 2),
(645, 'Equipobasquet3', 3),
(654, 'Equipobasquet5', 5),
(789, 'Equipohandball1', 1),
(897, 'Equipohandball2', 2),
(901, 'Equipohandball4', 4),
(902, 'Equipohandball5', 5),
(978, 'Equipohandball3', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guarda`
--

CREATE TABLE `guarda` (
  `idpartido` int(4) NOT NULL,
  `idregistro` int(5) NOT NULL,
  `idincidencia` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `guarda`
--

INSERT INTO `guarda` (`idpartido`, `idregistro`, `idincidencia`) VALUES
(1234, 12345, 123),
(2345, 23456, 234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

CREATE TABLE `incidencia` (
  `idincidencia` int(3) NOT NULL,
  `nomincidencia` varchar(20) NOT NULL,
  `abreviación` varchar(5) NOT NULL,
  `iddeporte` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`idincidencia`, `nomincidencia`, `abreviación`, `iddeporte`) VALUES
(123, 'Gol', 'Gol', 12),
(234, 'Tarjeta amarilla', 'TarA', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `cijugador` int(11) NOT NULL,
  `nomjugador` varchar(20) NOT NULL,
  `apjugador` varchar(20) NOT NULL,
  `fechanacjugador` date NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `dorsal` varchar(2) DEFAULT NULL CHECK (`dorsal` between 1 and 99),
  `sancionactiva` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`cijugador`, `nomjugador`, `apjugador`, `fechanacjugador`, `peso`, `altura`, `dorsal`, `sancionactiva`) VALUES
(10203040, 'Karim', 'Bezema', '1987-12-19', 81.2, 1.85, '9', 0),
(10230450, 'Vinicius', 'Junior', '2000-07-12', 73, 1.76, '20', 0),
(12034056, 'Rodrygo', 'Goes', '2001-01-09', 64, 1.74, '21', 0),
(12345678, 'Federico', 'Valverde', '1998-07-22', 78, 1.82, '15', 0),
(21356789, 'Robert', 'Lewandowski', '1988-08-21', 81, 1.85, '9', 0),
(23456789, 'Luka', 'Modric', '1997-09-09', 66.2, 1.72, '10', 0),
(23654186, 'Wendy', 'Carballo', '2002-07-28', 59, 1.55, '9', 0),
(25341568, 'Pedro', 'Gonzalez', '2002-11-25', 60, 1.74, '8', 0),
(34567890, 'Daniel', 'Carvajal', '1992-01-11', 73.5, 1.73, '2', 0),
(34589765, 'Marc', 'Ter Stegen', '1992-04-30', 85, 1.87, '1', 0),
(34785782, 'Gerard', 'Pique', '1987-02-02', 85, 1.94, '3', 0),
(34789654, 'Raphael', 'Dias', '1996-12-14', 68, 1.76, '22', 0),
(35268945, 'Memphis', 'Depay', '1994-02-13', 78, 1.76, '14', 0),
(42358795, 'Florencia', 'Vicente', '1991-11-12', 68, 1.57, '19', 0),
(45678901, 'Belen', 'Aquino', '2002-02-01', 48, 1.6, '10', 0),
(47859685, 'Jordi', 'Alba', '1989-03-21', 68, 1.7, '18', 0),
(47859763, 'Ronald', 'Araujo', '1999-03-07', 79, 1.88, '4', 0),
(49244291, 'Rocio', 'Roveta', '1999-11-10', 65, 1.67, '9', 0),
(51236587, 'Sasha', 'Larrea', '2001-08-29', 59, 1.6, '23', 0),
(51642837, 'Federico', 'Acosta', '1998-01-16', 75, 1.93, '21', 0),
(52146893, 'Solange', 'Lemos', '2002-08-27', 48, 1.51, '10', 0),
(52213565, 'Toni', 'Kroos', '1990-01-04', 76, 1.83, '8', 0),
(52548686, 'Catia', 'Gomez', '2000-07-12', 73, 1.65, '12', 0),
(53216541, 'Frenkie', 'De Jong', '1997-05-12', 74, 1.8, '21', 0),
(53222772, 'Josefina', 'Villanueva', '2000-02-03', 61, 1.6, '1', 0),
(54683347, 'Rocio', 'Martinez', '2001-09-04', 59, 1.71, '15', 0),
(56235418, 'Pablo', 'Paez Gavira', '2004-08-05', 70, 1.73, '30', 0),
(56389751, 'Maytel', 'Costa', '2001-02-11', 60, 1.63, '20', 0),
(56789012, 'Ximena', 'Velazco', '1995-07-31', 69, 1.57, '8', 0),
(56894130, 'Cecilia', 'Gomez', '2001-09-07', 61, 1.67, '17', 0),
(58749621, 'Alison', 'Latua', '2003-05-23', 59, 1.63, '7', 0),
(58749632, 'Sofia', 'Ferrada', '1998-07-16', 59, 1.6, '9', 0),
(67890123, 'Sofia', 'Ramondegui', '2001-03-26', 63, 1.73, '3', 0),
(78901234, 'Mateo', 'Bianchi', '2002-06-23', 75, 2.05, '45', 0),
(89012345, 'Thibaut', 'Courtois', '1992-05-11', 96, 2, '1', 0),
(90123456, 'Eder', 'Militao', '1998-01-18', 78, 1.86, '3', 0),
(98765432, 'Lucas', 'Vazquez', '1991-07-01', 70.5, 1.73, '17', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocupa`
--

CREATE TABLE `ocupa` (
  `iddeporte` int(2) NOT NULL,
  `idposicion` int(3) NOT NULL,
  `cijugador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ocupa`
--

INSERT INTO `ocupa` (`iddeporte`, `idposicion`, `cijugador`) VALUES
(12, 456, 12345678),
(12, 456, 23456789),
(12, 456, 25341568),
(12, 456, 51236587),
(12, 456, 52213565),
(12, 456, 53216541),
(12, 456, 54683347),
(12, 456, 56235418),
(12, 456, 56789012),
(12, 456, 56894130),
(12, 678, 34567890),
(12, 678, 34785782),
(12, 678, 42358795),
(12, 678, 47859685),
(12, 678, 47859763),
(12, 678, 56389751),
(12, 678, 58749621),
(12, 678, 67890123),
(12, 678, 90123456),
(12, 678, 98765432),
(12, 789, 10203040),
(12, 789, 10230450),
(12, 789, 12034056),
(12, 789, 21356789),
(12, 789, 23654186),
(12, 789, 34789654),
(12, 789, 35268945),
(12, 789, 45678901),
(12, 789, 52146893),
(12, 789, 58749632),
(12, 890, 34589765),
(12, 890, 52548686),
(12, 890, 53222772),
(12, 890, 89012345),
(23, 123, 78901234),
(23, 234, 49244291),
(23, 345, 51642837);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `idpartido` int(4) NOT NULL,
  `lugar` varchar(30) NOT NULL,
  `hora` time NOT NULL,
  `fechapartido` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0,
  `gol_local` int(11) DEFAULT NULL CHECK (`gol_local` >= 0),
  `gol_visitante` int(11) DEFAULT NULL CHECK (`gol_visitante` >= 0),
  `idusuario` int(11) NOT NULL,
  `idequipo` int(3) DEFAULT NULL,
  `local` int(3) DEFAULT NULL,
  `visitante` int(3) DEFAULT NULL,
  `cijugador` int(11) DEFAULT NULL,
  `idconvocado` int(6) DEFAULT NULL,
  `idcompetencia` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`idpartido`, `lugar`, `hora`, `fechapartido`, `estado`, `gol_local`, `gol_visitante`, `idusuario`, `idequipo`, `local`, `visitante`, `cijugador`, `idconvocado`, `idcompetencia`) VALUES
(1234, 'Centenario', '19:00:00', '2019-08-15', 1, 3, 1, 6, 123, 123, 231, 12345678, 123456, 12345),
(2345, 'Campeon del Siglo', '18:30:00', '2020-09-07', 1, 3, 2, 7, 312, 312, 321, 34567890, 456789, 23456),
(3456, 'Gran Parque Central', '17:00:00', '2019-11-18', 1, 2, 2, 8, 231, 231, 123, 45678901, 345678, 34567),
(4567, 'Estadio Luis Franzini', '19:30:00', '2022-11-20', 0, 2, 0, 6, 231, 231, 312, 56789012, 789012, 23456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE `posicion` (
  `iddeporte` int(2) NOT NULL,
  `idposicion` int(3) NOT NULL,
  `nomposicion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `posicion`
--

INSERT INTO `posicion` (`iddeporte`, `idposicion`, `nomposicion`) VALUES
(12, 456, 'Mediocampista'),
(12, 678, 'Defensa'),
(12, 789, 'Delantero'),
(12, 890, 'Golero'),
(23, 123, 'Ala-Pivot'),
(23, 234, 'Pivot'),
(23, 345, 'Base'),
(23, 901, 'Escolta'),
(23, 902, 'Alero'),
(34, 903, 'Portero'),
(34, 904, 'Central'),
(34, 905, 'Extremo'),
(34, 906, 'Lateral'),
(34, 907, 'Pivote');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

CREATE TABLE `realiza` (
  `cijugador` int(11) NOT NULL,
  `iddeporte` int(2) NOT NULL,
  `idequipo` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `realiza`
--

INSERT INTO `realiza` (`cijugador`, `iddeporte`, `idequipo`) VALUES
(10203040, 12, 123),
(10230450, 12, 123),
(12034056, 12, 123),
(12345678, 12, 123),
(23456789, 12, 123),
(34567890, 12, 123),
(52213565, 12, 123),
(89012345, 12, 123),
(90123456, 12, 123),
(98765432, 12, 123),
(23654186, 12, 231),
(42358795, 12, 231),
(45678901, 12, 231),
(51236587, 12, 231),
(52548686, 12, 231),
(56789012, 12, 231),
(67890123, 12, 231),
(52146893, 12, 312),
(53222772, 12, 312),
(54683347, 12, 312),
(56389751, 12, 312),
(56894130, 12, 312),
(58749621, 12, 312),
(58749632, 12, 312),
(21356789, 12, 321),
(25341568, 12, 321),
(34589765, 12, 321),
(34785782, 12, 321),
(34789654, 12, 321),
(35268945, 12, 321),
(47859685, 12, 321),
(47859763, 12, 321),
(53216541, 12, 321),
(56235418, 12, 321),
(49244291, 23, 456),
(51642837, 23, 564),
(78901234, 23, 645);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_incidencia`
--

CREATE TABLE `registro_incidencia` (
  `idpartido` int(4) NOT NULL,
  `idregistro` int(5) NOT NULL,
  `fechareg` date NOT NULL,
  `minuto` time NOT NULL,
  `idusuario` int(11) NOT NULL,
  `cijugador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_incidencia`
--

INSERT INTO `registro_incidencia` (`idpartido`, `idregistro`, `fechareg`, `minuto`, `idusuario`, `cijugador`) VALUES
(1234, 12345, '2019-08-15', '19:20:00', 6, 12345678),
(2345, 23456, '2020-09-07', '19:05:00', 7, 34567890);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `selecciona`
--

CREATE TABLE `selecciona` (
  `idusuario` int(11) NOT NULL,
  `cijugador` int(11) DEFAULT NULL,
  `idconvocado` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `selecciona`
--

INSERT INTO `selecciona` (`idusuario`, `cijugador`, `idconvocado`) VALUES
(1, 12345678, 123456),
(2, 23456789, 234567),
(3, 45678901, 345678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nomusuario` varchar(20) NOT NULL,
  `apusuario` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rol` enum('entrenador','scouting','arbitro','estadistico','administrativo') NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nomusuario`, `apusuario`, `email`, `password`, `rol`, `borrado`) VALUES
(1, 'Luis', 'Perez', 'luisperez@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'entrenador', 0),
(2, 'Jose', 'Gomez', 'josegomez@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'entrenador', 0),
(3, 'Juan', 'Gonzalez', 'juangonzalez@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'entrenador', 0),
(4, 'Raul', 'Suarez', 'raulsuarez@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'entrenador', 0),
(5, 'Pedro', 'Lopez', 'pedrolopez@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'entrenador', 0),
(6, 'Yimmy', 'Alvarez', 'yimmyalvarez@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(7, 'Christian', 'Ferreyra', 'christianferreyra@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(8, 'Esteban', 'Ostojich', 'estebanostojich@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(9, 'Ricardo', 'Olivera', 'ricardoolivera@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(10, 'Adrian', 'Vazquez', 'adrianvazquez@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(11, 'Andres', 'Laulhe', 'andreslaulhe@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(12, 'Mathias', 'Sosa', 'matiassosa@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(13, 'Cristian', 'Lemes', 'cristianlemes@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(14, 'Raul', 'Portela', 'raulportela@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'arbitro', 0),
(15, 'Agustin', 'Recondo', 'agustin@gmail.com', '10515cd629ce85b6c4616fc1f7cf3be164056d0d4b4e4e16f7a6050ef8ca2e06', 'administrativo', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `competencia`
--
ALTER TABLE `competencia`
  ADD PRIMARY KEY (`idcompetencia`);

--
-- Indices de la tabla `compone`
--
ALTER TABLE `compone`
  ADD PRIMARY KEY (`idcompetencia`),
  ADD KEY `iddeporte` (`iddeporte`);

--
-- Indices de la tabla `convocado`
--
ALTER TABLE `convocado`
  ADD PRIMARY KEY (`cijugador`,`idconvocado`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`iddeporte`),
  ADD UNIQUE KEY `nomdeporte` (`nomdeporte`);

--
-- Indices de la tabla `disputa`
--
ALTER TABLE `disputa`
  ADD PRIMARY KEY (`idequipo`,`idcompetencia`),
  ADD KEY `idcompetencia` (`idcompetencia`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequipo`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `guarda`
--
ALTER TABLE `guarda`
  ADD PRIMARY KEY (`idpartido`,`idregistro`,`idincidencia`),
  ADD KEY `idincidencia` (`idincidencia`);

--
-- Indices de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD PRIMARY KEY (`idincidencia`),
  ADD KEY `iddeporte` (`iddeporte`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`cijugador`);

--
-- Indices de la tabla `ocupa`
--
ALTER TABLE `ocupa`
  ADD PRIMARY KEY (`iddeporte`,`idposicion`,`cijugador`),
  ADD KEY `cijugador` (`cijugador`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`idpartido`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idequipo` (`idequipo`),
  ADD KEY `cijugador` (`cijugador`,`idconvocado`),
  ADD KEY `idcompetencia` (`idcompetencia`);

--
-- Indices de la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD PRIMARY KEY (`iddeporte`,`idposicion`);

--
-- Indices de la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD PRIMARY KEY (`cijugador`,`iddeporte`),
  ADD KEY `iddeporte` (`iddeporte`),
  ADD KEY `idequipo` (`idequipo`);

--
-- Indices de la tabla `registro_incidencia`
--
ALTER TABLE `registro_incidencia`
  ADD PRIMARY KEY (`idpartido`,`idregistro`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `cijugador` (`cijugador`);

--
-- Indices de la tabla `selecciona`
--
ALTER TABLE `selecciona`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `cijugador` (`cijugador`,`idconvocado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `registro_incidencia`
--
ALTER TABLE `registro_incidencia`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `selecciona`
--
ALTER TABLE `selecciona`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compone`
--
ALTER TABLE `compone`
  ADD CONSTRAINT `compone_ibfk_1` FOREIGN KEY (`idcompetencia`) REFERENCES `competencia` (`idcompetencia`),
  ADD CONSTRAINT `compone_ibfk_2` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`),
  ADD CONSTRAINT `compone_ibfk_3` FOREIGN KEY (`idcompetencia`) REFERENCES `competencia` (`idcompetencia`) ON DELETE CASCADE,
  ADD CONSTRAINT `compone_ibfk_4` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`) ON DELETE CASCADE;

--
-- Filtros para la tabla `convocado`
--
ALTER TABLE `convocado`
  ADD CONSTRAINT `convocado_ibfk_1` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`),
  ADD CONSTRAINT `convocado_ibfk_2` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `disputa`
--
ALTER TABLE `disputa`
  ADD CONSTRAINT `disputa_ibfk_1` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `disputa_ibfk_2` FOREIGN KEY (`idcompetencia`) REFERENCES `competencia` (`idcompetencia`) ON DELETE CASCADE;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `guarda`
--
ALTER TABLE `guarda`
  ADD CONSTRAINT `guarda_ibfk_1` FOREIGN KEY (`idpartido`,`idregistro`) REFERENCES `registro_incidencia` (`idpartido`, `idregistro`),
  ADD CONSTRAINT `guarda_ibfk_2` FOREIGN KEY (`idincidencia`) REFERENCES `incidencia` (`idincidencia`),
  ADD CONSTRAINT `guarda_ibfk_3` FOREIGN KEY (`idpartido`,`idregistro`) REFERENCES `registro_incidencia` (`idpartido`, `idregistro`) ON DELETE CASCADE,
  ADD CONSTRAINT `guarda_ibfk_4` FOREIGN KEY (`idincidencia`) REFERENCES `incidencia` (`idincidencia`) ON DELETE CASCADE;

--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `incidencia_ibfk_1` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`),
  ADD CONSTRAINT `incidencia_ibfk_2` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ocupa`
--
ALTER TABLE `ocupa`
  ADD CONSTRAINT `ocupa_ibfk_1` FOREIGN KEY (`iddeporte`,`idposicion`) REFERENCES `posicion` (`iddeporte`, `idposicion`),
  ADD CONSTRAINT `ocupa_ibfk_2` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`),
  ADD CONSTRAINT `ocupa_ibfk_3` FOREIGN KEY (`iddeporte`,`idposicion`) REFERENCES `posicion` (`iddeporte`, `idposicion`) ON DELETE CASCADE,
  ADD CONSTRAINT `ocupa_ibfk_4` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `partido_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `partido_ibfk_2` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`),
  ADD CONSTRAINT `partido_ibfk_3` FOREIGN KEY (`cijugador`,`idconvocado`) REFERENCES `convocado` (`cijugador`, `idconvocado`),
  ADD CONSTRAINT `partido_ibfk_4` FOREIGN KEY (`idcompetencia`) REFERENCES `competencia` (`idcompetencia`),
  ADD CONSTRAINT `partido_ibfk_5` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `partido_ibfk_6` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `partido_ibfk_7` FOREIGN KEY (`cijugador`,`idconvocado`) REFERENCES `convocado` (`cijugador`, `idconvocado`) ON DELETE CASCADE,
  ADD CONSTRAINT `partido_ibfk_8` FOREIGN KEY (`idcompetencia`) REFERENCES `competencia` (`idcompetencia`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD CONSTRAINT `posicion_ibfk_1` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`),
  ADD CONSTRAINT `posicion_ibfk_2` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`) ON DELETE CASCADE;

--
-- Filtros para la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `realiza_ibfk_1` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`),
  ADD CONSTRAINT `realiza_ibfk_2` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`),
  ADD CONSTRAINT `realiza_ibfk_3` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`),
  ADD CONSTRAINT `realiza_ibfk_4` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`) ON DELETE CASCADE,
  ADD CONSTRAINT `realiza_ibfk_5` FOREIGN KEY (`iddeporte`) REFERENCES `deporte` (`iddeporte`) ON DELETE CASCADE,
  ADD CONSTRAINT `realiza_ibfk_6` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `registro_incidencia`
--
ALTER TABLE `registro_incidencia`
  ADD CONSTRAINT `registro_incidencia_ibfk_1` FOREIGN KEY (`idpartido`) REFERENCES `partido` (`idpartido`),
  ADD CONSTRAINT `registro_incidencia_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `registro_incidencia_ibfk_3` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`),
  ADD CONSTRAINT `registro_incidencia_ibfk_4` FOREIGN KEY (`idpartido`) REFERENCES `partido` (`idpartido`) ON DELETE CASCADE,
  ADD CONSTRAINT `registro_incidencia_ibfk_5` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `registro_incidencia_ibfk_6` FOREIGN KEY (`cijugador`) REFERENCES `jugador` (`cijugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `selecciona`
--
ALTER TABLE `selecciona`
  ADD CONSTRAINT `selecciona_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `selecciona_ibfk_2` FOREIGN KEY (`cijugador`,`idconvocado`) REFERENCES `convocado` (`cijugador`, `idconvocado`),
  ADD CONSTRAINT `selecciona_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `selecciona_ibfk_4` FOREIGN KEY (`cijugador`,`idconvocado`) REFERENCES `convocado` (`cijugador`, `idconvocado`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
