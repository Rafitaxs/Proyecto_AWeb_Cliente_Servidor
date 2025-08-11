-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2025 at 10:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clienteservidor`
--

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion`
--

CREATE TABLE `inscripcion` (
  `ID_Inscripcion` int(11) NOT NULL,
  `Cedula` int(11) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Apellido` varchar(60) NOT NULL,
  `TipoLicencia` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sede`
--

CREATE TABLE `sede` (
  `ID` int(11) NOT NULL,
  `Provincia` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Cedula` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido1` varchar(30) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Provincia` varchar(10) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`Cedula`, `Nombre`, `Apellido1`, `Correo`, `Provincia`, `rol`) VALUES
(12345678, 'Rafael', 'Solano', '1234@gmail.com', '1234', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`ID_Inscripcion`),
  ADD KEY `Cedula` (`Cedula`);

--
-- Indexes for table `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Cedula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `ID_Inscripcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sede`
--
ALTER TABLE `sede`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
--
--Insertions for dumped tables
--
INSERT INTO `usuario`(`Cedula`, `Nombre`, `Apellido1`, `Correo`, `Provincia`, `rol`) 
VALUES ('90116043', 'Chris', 'Murillo', 'chris@gmail.com', 'San José', 'Cliente');

INSERT INTO `sede`(`ID`, `Provincia`) 
VALUES ('2', 'Alajuela');

INSERT INTO `sede`(`ID`, `Provincia`) 
VALUES ('3', 'Heredia');

INSERT INTO `sede`(`ID`, `Provincia`) 
VALUES ('4', 'Cartago');

INSERT INTO `sede`(`ID`, `Provincia`) 
VALUES ('5', 'Guanacaste');

INSERT INTO `sede`(`ID`, `Provincia`) 
VALUES ('6', 'Puntarenas');

INSERT INTO `sede`(`ID`, `Provincia`) 
VALUES ('7', 'Limon');




INSERT INTO `inscripcion` (`ID_Inscripcion`, `Cedula`, `Nombre`, `Apellido`, `TipoLicencia`, `SedeID`) 
VALUES ('1', '101010101', 'María', 'Gómez', 'B1', `);

INSERT INTO `inscripcion` (`ID_Inscripcion`, `Cedula`, `Nombre`, `Apellido`, `TipoLicencia`, `SedeID`) 
VALUES ('2', '202020202', 'Carlos', 'Ramírez', 'C2', 2);

INSERT INTO `inscripcion` (`ID_Inscripcion`, `Cedula`, `Nombre`, `Apellido`, `TipoLicencia`, `SedeID`) 
VALUES ('3', '303030303', 'Ana', 'López', 'A1', 3);

INSERT INTO `inscripcion` (`ID_Inscripcion`, `Cedula`, `Nombre`, `Apellido`, `TipoLicencia`, `SedeID`) 
VALUES ('4', '404040404', 'Luis', 'Fernández', 'B2', 4);

INSERT INTO `inscripcion` (`ID_Inscripcion`, `Cedula`, `Nombre`, `Apellido`, `TipoLicencia`, `SedeID`) 
VALUES ('5', '505050505', 'Sofía', 'Martínez', 'C3', 5);


CREATE TABLE cupos_sede (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sede VARCHAR(50) NOT NULL UNIQUE,
  max_cupos INT NOT NULL,
  cupos_disponibles INT NOT NULL
);

INSERT INTO cupos_sede (sede, max_cupos, cupos_disponibles) VALUES
('sede-1', 10, 10),
('sede-2', 8, 8),
('sede-3', 12, 12)
('sede-4', 12, 12),
('sede-5', 12, 3);


CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    sede VARCHAR(50) NOT NULL,
    fecha_inscripcion DATE NOT NULL,
    estado VARCHAR(20) NOT NULL DEFAULT 'Pendiente'
);

ALTER TABLE citas 
MODIFY COLUMN estado ENUM('pendiente','confirmado','rechazado') NOT NULL DEFAULT 'pendiente';


CREATE TABLE pago (
    id INT AUTO_INCREMENT PRIMARY KEY,
    BIC VARCHAR(50) NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    dia INT NOT NULL,
    mes INT NOT NULL,
    anio INT NOT NULL
);

ALTER TABLE inscripcion ADD COLUMN SedeID int(11) NOT NULL;\
UPDATE inscripcion SET SedeID = 2 WHERE ID_Inscripcion = 1;

UPDATE inscripcion SET SedeID = 2 WHERE ID_Inscripcion = 1; -- Alajuela
UPDATE inscripcion SET SedeID = 3 WHERE ID_Inscripcion = 2; -- Heredia
UPDATE inscripcion SET SedeID = 4 WHERE ID_Inscripcion = 3; -- Cartago
UPDATE inscripcion SET SedeID = 5 WHERE ID_Inscripcion = 4; -- Guanacaste
UPDATE inscripcion SET SedeID = 6 WHERE ID_Inscripcion = 5; -- Puntarenas


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
