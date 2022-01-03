-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2018 a las 19:58:54
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cejosica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_anio_escolar`
--

CREATE TABLE `tb_anio_escolar` (
  `idtb_anio_escolar` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `anio_fecha_inicio` date NOT NULL,
  `anio_fecha_final` date NOT NULL,
  `anio_descrip` text NOT NULL,
  `anio_estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_anio_escolar`
--

INSERT INTO `tb_anio_escolar` (`idtb_anio_escolar`, `anio`, `anio_fecha_inicio`, `anio_fecha_final`, `anio_descrip`, `anio_estado`) VALUES
(4, 2018, '2018-10-23', '2018-10-23', 'Este año es escolar para el 2018', 'Activo'),
(5, 2021, '2018-10-21', '2018-10-31', 'este año es de', 'Activo'),
(7, 2024, '2018-10-20', '2018-10-26', 'will chimbera', 'Activo'),
(8, 2020, '2018-10-20', '2018-10-20', 'kj', 'Activo'),
(9, 2022, '2018-10-02', '2018-10-31', 'sdf', 'Activo'),
(10, 2025, '2018-10-21', '2019-07-10', 'sfs', 'Activo'),
(11, 2029, '2018-11-01', '2018-11-01', '', 'Activo'),
(12, 2030, '2018-11-01', '2018-11-01', '', 'Activo'),
(13, 2050, '2018-11-01', '2018-11-01', '', 'Activo'),
(14, 2031, '2018-11-01', '2018-11-01', '', 'Activo'),
(15, 2033, '2018-11-01', '2018-11-01', '', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estudiante`
--

CREATE TABLE `tb_estudiante` (
  `idestudiante` int(11) NOT NULL,
  `est_nie` varchar(15) NOT NULL,
  `est_nombre` varchar(100) NOT NULL,
  `est_apellido` varchar(100) NOT NULL,
  `est_sexo` varchar(20) NOT NULL,
  `est_foto` text,
  `est_estado_civil` varchar(45) DEFAULT 'Soltero',
  `est_fecha_nace` date NOT NULL,
  `est_edad` int(11) NOT NULL,
  `est_direccion` text NOT NULL,
  `est_partida` varchar(45) DEFAULT NULL,
  `est_dui` varchar(45) DEFAULT NULL,
  `est_transporte` varchar(45) DEFAULT NULL,
  `est_repite_grado` varchar(45) DEFAULT NULL,
  `est_anio_ult` int(11) DEFAULT NULL,
  `est_depart` varchar(45) DEFAULT NULL,
  `est_municipio` varchar(45) DEFAULT NULL,
  `est_convivencia` varchar(45) DEFAULT NULL,
  `est_discapacidad` varchar(200) DEFAULT NULL,
  `est_dp_economica` varchar(45) DEFAULT NULL,
  `est_fecha_registro` date DEFAULT NULL,
  `est_estado` varchar(45) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_materia`
--

CREATE TABLE `tb_materia` (
  `idtb_materia` int(11) NOT NULL,
  `mate_nombre` varchar(100) NOT NULL,
  `mate_descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_materia_user`
--

CREATE TABLE `tb_materia_user` (
  `mate_user_id` int(11) NOT NULL,
  `mate_user_idtb_materia` int(11) NOT NULL,
  `mate_user_idtb_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_matricula`
--

CREATE TABLE `tb_matricula` (
  `idtb_matricula` int(11) NOT NULL,
  `matri_fecha` date NOT NULL,
  `matri_idestudiante` int(11) NOT NULL,
  `matri_idtb_seccion` int(11) NOT NULL,
  `matri_idtb_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_nota`
--

CREATE TABLE `tb_nota` (
  `idtb_nota` int(11) NOT NULL,
  `not_p1_act1` decimal(10,2) DEFAULT '0.00',
  `not_p1_act2` decimal(10,2) DEFAULT '0.00',
  `not_p1_act3` decimal(10,2) DEFAULT '0.00',
  `not_p1_promuno` decimal(10,2) DEFAULT '0.00',
  `not_p2_act1` decimal(10,2) DEFAULT '0.00',
  `not_p2_act2` decimal(10,2) DEFAULT '0.00',
  `not_p2_act3` decimal(10,2) DEFAULT '0.00',
  `not_p2_prom2` decimal(10,2) DEFAULT '0.00',
  `not_p3-act1` decimal(10,2) DEFAULT '0.00',
  `not_p3_act2` decimal(10,2) DEFAULT '0.00',
  `not_p3_act3` decimal(10,2) DEFAULT '0.00',
  `not_p3_prom3` decimal(10,2) DEFAULT '0.00',
  `nota_prom_final` decimal(10,2) DEFAULT '0.00',
  `not_idtb_materia` int(11) NOT NULL,
  `not_idtb_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_parentesco`
--

CREATE TABLE `tb_parentesco` (
  `idtb_parentesco` int(11) NOT NULL,
  `parent_nombre` varchar(150) NOT NULL,
  `parent_dui` varchar(10) DEFAULT NULL,
  `parent_telefono` varchar(9) DEFAULT NULL,
  `parent_trabajo` varchar(75) DEFAULT NULL,
  `parent_direccion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_parentesco_estudiante`
--

CREATE TABLE `tb_parentesco_estudiante` (
  `tbid_parent_est` int(11) NOT NULL,
  `tb_parentesco_id` int(11) NOT NULL,
  `tb_estudiante_id` int(11) NOT NULL,
  `tb_tipo` varchar(45) NOT NULL,
  `tb_responsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seccion`
--

CREATE TABLE `tb_seccion` (
  `idtb_seccion` int(11) NOT NULL,
  `sec_servicio_ed` varchar(45) NOT NULL,
  `sec_turno` varchar(45) NOT NULL,
  `sec_identificador` varchar(45) NOT NULL,
  `sec_nivel` varchar(45) DEFAULT NULL,
  `sec_vacante` int(11) NOT NULL,
  `sec_idtb_anio_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seccion`
--

INSERT INTO `tb_seccion` (`idtb_seccion`, `sec_servicio_ed`, `sec_turno`, `sec_identificador`, `sec_nivel`, `sec_vacante`, `sec_idtb_anio_escolar`) VALUES
(8, '-2', 'Mañana', 'A', 'Kinder', 20, 4),
(10, '1', 'Tarde', 'A', 'I', 2, 8),
(11, '1', 'Mañana', 'A', 'I', 40, 5),
(12, '2', 'Mañana', 'A', 'I', 60, 5),
(13, '2', 'Mañana', 'B', 'I', 30, 4),
(14, '1', 'Mañana', 'C', 'I', 50, 4),
(15, '1', 'Mañana', 'B', 'I', 40, 8),
(16, '-3', 'Mañana', 'A', 'Kinder', 20, 4),
(17, '9', 'Mañana', 'A', 'III', 50, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seccion_materia`
--

CREATE TABLE `tb_seccion_materia` (
  `sec_mate_id` int(11) NOT NULL,
  `sec_mate_idtb_seccion` int(11) NOT NULL,
  `sec_mate_idtb_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_usuario`
--

CREATE TABLE `tb_tipo_usuario` (
  `idtb_tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_tipo_usuario`
--

INSERT INTO `tb_tipo_usuario` (`idtb_tipo_usuario`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Director'),
(3, 'Docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `idtb_usuario` int(11) NOT NULL,
  `user_nombre` varchar(100) NOT NULL,
  `user_apellido` varchar(100) NOT NULL,
  `user_dui` varchar(10) DEFAULT NULL,
  `user_nit` varchar(20) DEFAULT NULL,
  `user_telefono` varchar(45) DEFAULT NULL,
  `user_email` varchar(75) DEFAULT NULL,
  `user_usuario` varchar(100) NOT NULL,
  `user_clave` varchar(100) NOT NULL,
  `user_profesion` varchar(75) DEFAULT NULL,
  `user_estado` varchar(45) NOT NULL DEFAULT 'Activo',
  `user_fecha_registro` date DEFAULT NULL,
  `user_cod_recup` varchar(45) DEFAULT NULL,
  `user_idtb_tipo_usuario` int(11) NOT NULL,
  `user_idtb_seccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_anio_escolar`
--
ALTER TABLE `tb_anio_escolar`
  ADD PRIMARY KEY (`idtb_anio_escolar`);

--
-- Indices de la tabla `tb_estudiante`
--
ALTER TABLE `tb_estudiante`
  ADD PRIMARY KEY (`idestudiante`);

--
-- Indices de la tabla `tb_materia`
--
ALTER TABLE `tb_materia`
  ADD PRIMARY KEY (`idtb_materia`);

--
-- Indices de la tabla `tb_materia_user`
--
ALTER TABLE `tb_materia_user`
  ADD PRIMARY KEY (`mate_user_id`,`mate_user_idtb_materia`,`mate_user_idtb_usuario`),
  ADD KEY `fk_tb_materia_has_tb_usuario_tb_usuario1_idx` (`mate_user_idtb_usuario`),
  ADD KEY `fk_tb_materia_has_tb_usuario_tb_materia1_idx` (`mate_user_idtb_materia`);

--
-- Indices de la tabla `tb_matricula`
--
ALTER TABLE `tb_matricula`
  ADD PRIMARY KEY (`idtb_matricula`,`matri_idestudiante`,`matri_idtb_seccion`,`matri_idtb_usuario`),
  ADD KEY `fk_tb_matricula_tb_estudiante1_idx` (`matri_idestudiante`),
  ADD KEY `fk_tb_matricula_tb_seccion1_idx` (`matri_idtb_seccion`),
  ADD KEY `fk_tb_matricula_tb_usuario1_idx` (`matri_idtb_usuario`);

--
-- Indices de la tabla `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD PRIMARY KEY (`idtb_nota`,`not_idtb_materia`,`not_idtb_matricula`),
  ADD KEY `fk_tb_nota_tb_materia1_idx` (`not_idtb_materia`),
  ADD KEY `fk_tb_nota_tb_matricula1_idx` (`not_idtb_matricula`);

--
-- Indices de la tabla `tb_parentesco`
--
ALTER TABLE `tb_parentesco`
  ADD PRIMARY KEY (`idtb_parentesco`);

--
-- Indices de la tabla `tb_parentesco_estudiante`
--
ALTER TABLE `tb_parentesco_estudiante`
  ADD PRIMARY KEY (`tbid_parent_est`,`tb_parentesco_id`,`tb_estudiante_id`),
  ADD KEY `fk_tb_parentesco_has_tb_estudiante_tb_estudiante1_idx` (`tb_estudiante_id`),
  ADD KEY `fk_tb_parentesco_has_tb_estudiante_tb_parentesco1_idx` (`tb_parentesco_id`);

--
-- Indices de la tabla `tb_seccion`
--
ALTER TABLE `tb_seccion`
  ADD PRIMARY KEY (`idtb_seccion`,`sec_idtb_anio_escolar`),
  ADD KEY `fk_tb_seccion_tb_anio_escolar1_idx` (`sec_idtb_anio_escolar`);

--
-- Indices de la tabla `tb_seccion_materia`
--
ALTER TABLE `tb_seccion_materia`
  ADD PRIMARY KEY (`sec_mate_id`,`sec_mate_idtb_seccion`,`sec_mate_idtb_materia`),
  ADD KEY `fk_tb_seccion_has_tb_materia_tb_materia1_idx` (`sec_mate_idtb_materia`),
  ADD KEY `fk_tb_seccion_has_tb_materia_tb_seccion1_idx` (`sec_mate_idtb_seccion`);

--
-- Indices de la tabla `tb_tipo_usuario`
--
ALTER TABLE `tb_tipo_usuario`
  ADD PRIMARY KEY (`idtb_tipo_usuario`);

--
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`idtb_usuario`,`user_idtb_tipo_usuario`,`user_idtb_seccion`),
  ADD KEY `fk_tb_usuario_tb_tipo_usuario1_idx` (`user_idtb_tipo_usuario`),
  ADD KEY `fk_tb_usuario_tb_seccion1_idx` (`user_idtb_seccion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_anio_escolar`
--
ALTER TABLE `tb_anio_escolar`
  MODIFY `idtb_anio_escolar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `tb_estudiante`
--
ALTER TABLE `tb_estudiante`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_materia`
--
ALTER TABLE `tb_materia`
  MODIFY `idtb_materia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_materia_user`
--
ALTER TABLE `tb_materia_user`
  MODIFY `mate_user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_matricula`
--
ALTER TABLE `tb_matricula`
  MODIFY `idtb_matricula` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_nota`
--
ALTER TABLE `tb_nota`
  MODIFY `idtb_nota` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_parentesco`
--
ALTER TABLE `tb_parentesco`
  MODIFY `idtb_parentesco` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_parentesco_estudiante`
--
ALTER TABLE `tb_parentesco_estudiante`
  MODIFY `tbid_parent_est` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_seccion`
--
ALTER TABLE `tb_seccion`
  MODIFY `idtb_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `tb_seccion_materia`
--
ALTER TABLE `tb_seccion_materia`
  MODIFY `sec_mate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_tipo_usuario`
--
ALTER TABLE `tb_tipo_usuario`
  MODIFY `idtb_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `idtb_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_materia_user`
--
ALTER TABLE `tb_materia_user`
  ADD CONSTRAINT `fk_tb_materia_has_tb_usuario_tb_materia1` FOREIGN KEY (`mate_user_idtb_materia`) REFERENCES `tb_materia` (`idtb_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_materia_has_tb_usuario_tb_usuario1` FOREIGN KEY (`mate_user_idtb_usuario`) REFERENCES `tb_usuario` (`idtb_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_matricula`
--
ALTER TABLE `tb_matricula`
  ADD CONSTRAINT `fk_tb_matricula_tb_estudiante1` FOREIGN KEY (`matri_idestudiante`) REFERENCES `tb_estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_matricula_tb_seccion1` FOREIGN KEY (`matri_idtb_seccion`) REFERENCES `tb_seccion` (`idtb_seccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_matricula_tb_usuario1` FOREIGN KEY (`matri_idtb_usuario`) REFERENCES `tb_usuario` (`idtb_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD CONSTRAINT `fk_tb_nota_tb_materia1` FOREIGN KEY (`not_idtb_materia`) REFERENCES `tb_materia` (`idtb_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_nota_tb_matricula1` FOREIGN KEY (`not_idtb_matricula`) REFERENCES `tb_matricula` (`idtb_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_parentesco_estudiante`
--
ALTER TABLE `tb_parentesco_estudiante`
  ADD CONSTRAINT `fk_tb_parentesco_has_tb_estudiante_tb_estudiante1` FOREIGN KEY (`tb_estudiante_id`) REFERENCES `tb_estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_parentesco_has_tb_estudiante_tb_parentesco1` FOREIGN KEY (`tb_parentesco_id`) REFERENCES `tb_parentesco` (`idtb_parentesco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_seccion`
--
ALTER TABLE `tb_seccion`
  ADD CONSTRAINT `fk_tb_seccion_tb_anio_escolar1` FOREIGN KEY (`sec_idtb_anio_escolar`) REFERENCES `tb_anio_escolar` (`idtb_anio_escolar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_seccion_materia`
--
ALTER TABLE `tb_seccion_materia`
  ADD CONSTRAINT `fk_tb_seccion_has_tb_materia_tb_materia1` FOREIGN KEY (`sec_mate_idtb_materia`) REFERENCES `tb_materia` (`idtb_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_seccion_has_tb_materia_tb_seccion1` FOREIGN KEY (`sec_mate_idtb_seccion`) REFERENCES `tb_seccion` (`idtb_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `fk_tb_usuario_tb_seccion1` FOREIGN KEY (`user_idtb_seccion`) REFERENCES `tb_seccion` (`idtb_seccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_usuario_tb_tipo_usuario1` FOREIGN KEY (`user_idtb_tipo_usuario`) REFERENCES `tb_tipo_usuario` (`idtb_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
