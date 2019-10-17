-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2019 at 11:03 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemamatricula`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarAdmin` (IN `pced` INT, IN `pnom` VARCHAR(50), IN `pap1` VARCHAR(50), IN `pap2` VARCHAR(50), IN `ptel` VARCHAR(50), IN `puser` VARCHAR(50), IN `pidus` INT)  NO SQL
BEGIN
	UPDATE persona SET 
    	idpersona = pced,
        nombre = pnom,
        apellido1 = pap1,
        apellido2 = pap2,
        telefono = ptel
    WHERE idusuario = pidus;
    UPDATE usuario SET
    	usuario = puser
    WHERE idusuario = pidus;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarcomunidad` (IN `pcomunidad` INT, IN `pnombre` VARCHAR(100), IN `ptelefono` VARCHAR(100), IN `pencargado` VARCHAR(100), IN `pubi` VARCHAR(100))  NO SQL
BEGIN
UPDATE comunidad
	set encargado = pencargado   , 
    ubicacion =   pubi   ,
    telefono =  ptelefono    ,
	nombre = pnombre
    where idcomunidad  =  pcomunidad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarCurso` (IN `pid` INT, IN `pnom` VARCHAR(50), IN `pdes` VARCHAR(200), IN `pprof` VARCHAR(50), IN `pdur` VARCHAR(100), IN `phor` VARCHAR(80), IN `pprec` VARCHAR(20), IN `pcupo` INT)  NO SQL
BEGIN
UPDATE curso
	set 
    nombre = pnom,
    descripcion = pdes,
    profesor = pprof,
    duracion = pdur,
    horario = phor,
    precio = pprec,
    cuposdisponibles = pcupo
    where idcurso  =  pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarClave` (IN `pcon` VARCHAR(100), IN `pid` INT)  NO SQL
BEGIN
UPDATE usuario
SET contrasena=pcon, nuevo = 0 WHERE idusuario=pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarClaveUsuario` (IN `puser` INT, IN `oldclave` VARCHAR(100), IN `newclave` VARCHAR(100), OUT `res` INT)  NO SQL
BEGIN
	declare pruebaCon varchar (100);
    select contrasena
    into pruebaCon
    from usuario
    where idusuario =  puser;
    set res = 0;
    if pruebaCon = oldclave then
    	set res = 1;
        UPDATE usuario
		SET contrasena = newclave WHERE idusuario=puser;
     end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiardescrpcurso` (IN `idcurs` INT, IN `nombrecurso` VARCHAR(200))  BEGIN
	update  curso 
    set descripcion =  nombrecurso 
    where idcurso  = curso;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiardisponibilidad` (IN `idcur` INT)  BEGIN
	update curso 
    set matriculable =  0 
	where idcurso =  idcur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarnombrecurso` (IN `idcurs` INT, IN `nombrecurso` VARCHAR(50))  BEGIN
	update  curso 
    set nombre =  nombrecurso 
    where idcurso  = curso;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearComunidad` (IN `pnombre` VARCHAR(100), IN `pubi` VARCHAR(200), IN `ptelefono` VARCHAR(30), IN `pencargado` VARCHAR(100))  BEGIN
	insert into comunidad(nombre,ubicacion,telefono,encargado)
    values(pnombre,pubi,ptelefono,pencargado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearcurso` (IN `nombrecurso` VARCHAR(50), IN `descrip` VARCHAR(200), IN `profe` VARCHAR(50), IN `cupos` INT, IN `horas` VARCHAR(80), IN `idcom` INT, IN `price` VARCHAR(20), IN `duration` VARCHAR(100), IN `pact` INT)  BEGIN
	insert into curso (nombre, descripcion, profesor, cuposdisponibles, horario, idcomunidad,precio, duracion,activo)
    values (nombrecurso,descrip, profe, cupos, horas , idcom,price,duration, pact);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearEstudiante` (IN `pced` INT, IN `pnom` VARCHAR(50), IN `pap1` VARCHAR(50), IN `pap2` VARCHAR(50), IN `ptelf` VARCHAR(50), IN `pcorreo` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO estudiante (cedula, correo, nombre, primerapellido, segundoapellido, telefono)
    VALUES (pced, pcorreo, pnom, pap1, pap2, ptelf);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearHistorial` (IN `pEnc` INT(50), IN `pMatri` INT(50))  NO SQL
BEGIN
	INSERT into historial(idEncargado, idMatricula)
    VALUES(pEnc, pMatri);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `creartipousuario` (IN `nombreusuario` VARCHAR(50))  BEGIN
	insert into tipousuario(descripcion)
    values(nombreusuario);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `desmatricular` (IN `pcur` INT, IN `pest` INT)  NO SQL
BEGIN 
	call eliminarhistorialsimple(pcur, pest); 
    DELETE FROM matricula
    WHERE idestudiante = pest AND idcurso = pcur;
    call incrementarCupo(pcur);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `desmatricularsimple` (IN `pmatri` INT)  NO SQL
BEGIN 
	DECLARE pcur int;
    DECLARE pest int;
    SELECT idcurso, idestudiante into pcur,pest from matricula 
    where idmatricula =  pmatri; 
	call eliminarhistorialsimple(pcur, pest); 
    DELETE FROM matricula
    WHERE idestudiante = pest AND idcurso = pcur;
    call incrementarCupo(pcur);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarEstudiante` (IN `pced` INT)  NO SQL
BEGIN
	DELETE FROM matricula WHERE idestudiante = pced;
    DELETE from estudiante WHERE cedula = pced;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarHistorial` (IN `pEnc` INT(20))  NO SQL
BEGIN
	DELETE from historial WHERE idEncargado =  pEnc; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarhistorialsimple` (IN `pcur` INT, IN `pest` INT)  NO SQL
BEGIN
	DECLARE nummatricula int; 
    SELECT idmatricula into nummatricula from matricula 
    where idcurso =  pcur and idestudiante  =  pest; 
	DELETE from historial where idMatricula  =  nummatricula;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarusuario` (IN `pced` INT)  NO SQL
BEGIN
	DECLARE puser int; 
    SELECT idusuario into puser from persona 
    where idpersona =  pced; 
	DELETE from persona where idpersona  =  pced;
    DELETE from usuario where idusuario =  puser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `estamatriculado` (IN `pest` INT, IN `pcur` INT)  NO SQL
BEGIN
	SELECT COUNT(*)  cant from matricula
    where idcurso =  pcur  and idestudiante =  pest;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `existePersona` (IN `pced` INT)  NO SQL
BEGIN
    SELECT IF (EXISTS ( SELECT * FROM persona WHERE idpersona = pced ),1,0) AS existe;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `existeUsuario` (IN `puser` VARCHAR(50))  NO SQL
BEGIN
    SELECT IF (EXISTS ( SELECT * FROM usuario WHERE usuario.usuario = puser ),1,0) AS existe;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getActivo` (IN `pid` INT)  NO SQL
BEGIN
	SELECT activo from curso WHERE idcurso = pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAdminComunidad` (IN `pcntr` INT)  NO SQL
BEGIN
SELECT per.idpersona, per.nombre, per.apellido1, per.apellido2, per.telefono, us.usuario FROM persona per 
INNER JOIN usuario us 
ON us.idusuario = per.idusuario 
WHERE idcomunidad = pcntr;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getcomunidades` ()  BEGIN
	select idcomunidad , nombre from comunidad ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEstudiantes` ()  NO SQL
BEGIN
	SELECT * FROM estudiante;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getHistorial` (IN `pEnc` INT(50))  NO SQL
BEGIN
SELECT est.cedula cedula, est.nombre Estudiante , est.primerapellido Ap1,  est.segundoapellido Ap2, info.curso Curso, info.matri matri
FROM (
	SELECT temp.idest idest  ,  cur.nombre curso , temp.matri matri
    FROM  (
        SELECT matri2.idestudiante as idest, matri2.idcurso as curso,  matri.idMatricula matri
        FROM (
            SELECT idMatricula FROM historial where idEncargado = pEnc
        ) matri 
        INNER JOIN matricula matri2 
        on matri2.idmatricula  =   matri.idMatricula
     )   temp 
    INNER JOIN curso cur
    on cur.idcurso = temp.curso
) info 
INNER JOIN estudiante est 
ON est.cedula = info.idest;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getidcomunidad` (IN `puser` INT)  NO SQL
BEGIN
    SELECT idcomunidad
    FROM persona
    WHERE idusuario = puser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getinfoadmin` (IN `piduser` INT)  NO SQL
BEGIN
SELECT per.idpersona, per.nombre, per.apellido1, per.apellido2, per.telefono, us.usuario FROM persona per 
INNER JOIN usuario us 
ON us.idusuario = per.idusuario 
WHERE us.idusuario = piduser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getInfoComunidad` (IN `pcntr` INT)  NO SQL
BEGIN
	SELECT * FROM comunidad WHERE idcomunidad = pcntr;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getInfoCurso` (IN `pcur` INT)  NO SQL
BEGIN
SELECT * FROM curso WHERE idcurso = pcur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNombreCurso` (IN `pcur` INT)  NO SQL
BEGIN
	SELECT nombre FROM curso WHERE idcurso = pcur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNombreEstudiante` (IN `pid` INT)  NO SQL
BEGIN
    SELECT cedula, nombre, primerapellido, segundoapellido 
    FROM estudiante 
    WHERE cedula = pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNombresCursoCm` (IN `pcntr` INT, IN `pact` INT)  NO SQL
BEGIN
	SELECT idcurso, nombre from curso WHERE idcomunidad = pcntr and cuposdisponibles>0 and activo = pact;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNuevo` (IN `pid` INT)  NO SQL
BEGIN
SELECT nuevo 
FROM usuario
WHERE idusuario = pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `incrementarCupo` (IN `pcur` INT)  NO SQL
BEGIN
	update curso 
    set cuposdisponibles =  cuposdisponibles + 1 
	where idcurso =  pcur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infocomunidad` (IN `id` INT)  NO SQL
SELECT idcomunidad, nombre, ubicacion, telefono from comunidad WHERE idcomunidad = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `manejoCurso` (IN `pcur` INT)  NO SQL
BEGIN
	DECLARE prueba int;
    SELECT activo INTO prueba from curso WHERE idcurso = pcur;
    IF(prueba = 1) THEN
    	UPDATE curso SET activo = 0 WHERE idcurso = pcur;
    ELSE
    	UPDATE curso SET activo = 1 WHERE idcurso = pcur;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `matriculados` (IN `pcur` INT)  NO SQL
BEGIN
SELECT es.cedula, es.nombre, es.primerapellido, es.segundoapellido
FROM matricula mat
INNER JOIN estudiante es
ON es.cedula = mat.idestudiante
WHERE mat.idcurso = pcur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `matriculadosDescarga` (IN `pcur` INT)  NO SQL
BEGIN
SELECT es.cedula, es.nombre, es.primerapellido, es.segundoapellido, es.correo, es.telefono
FROM matricula mat
INNER JOIN estudiante es
ON es.cedula = mat.idestudiante
WHERE mat.idcurso = pcur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `matricular` (IN `pest` INT, IN `pcur` INT, IN `pencarg` INT)  NO SQL
BEGIN
INSERT INTO matricula (idestudiante, idcurso)
VALUES (pest, pcur);
call reducircupo(pcur);
call crearHistorial(pencarg, LAST_INSERT_ID());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reducircupo` (IN `idcur` INT)  BEGIN
	update curso 
    set cuposdisponibles =  cuposdisponibles - 1 
	where idcurso =  idcur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarAdmin` (IN `puser` VARCHAR(50), IN `pcont` VARCHAR(100), IN `ptipo` INT, IN `pced` INT, IN `pnom` VARCHAR(50), IN `pap1` VARCHAR(50), IN `pap2` VARCHAR(50), IN `pcomuni` INT, IN `ptelf` VARCHAR(50))  NO SQL
BEGIN
	insert into usuario(usuario, contrasena, idtipousuario, nuevo)
    values(puser,pcont,ptipo,1);
    insert into persona(idpersona, idusuario,nombre, apellido1,apellido2, idcomunidad,telefono)
    values(pced,LAST_INSERT_ID(),pnom, pap1,pap2,pcomuni, ptelf);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarUsuario` (IN `pnombre` VARCHAR(50), IN `pap1` VARCHAR(50), IN `pap2` VARCHAR(50), IN `puser` VARCHAR(50), IN `pmail` VARCHAR(50), IN `pcelular` VARCHAR(50), IN `ptelefono` VARCHAR(50), IN `pclave` VARCHAR(50), INOUT `res` INT)  BEGIN
	Declare pusuario int default 0;
    select idusuario into pusuario from usuario where usuario =  puser;
    if pusuario = 0 then
		insert into usuario (nombre, apellido1, apellido2, usuario, email, celular, telefono, contrasena)
		values(pnombre, pap1,  pap2, puser, pmail, pcelular, ptelefono, pclave);
        set res= 1 ; 
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarUser` (IN `puser` VARCHAR(50), IN `pclave` VARCHAR(100), OUT `res` INT, OUT `ptipo` INT, OUT `pid` INT)  NO SQL
BEGIN
	SELECT IF (EXISTS ( SELECT * FROM usuario WHERE usuario.usuario = puser AND usuario.contrasena = pclave),1,0) INTO res;
    IF res <> 0 THEN
    SELECT usuario.idtipousuario, usuario.idusuario INTO ptipo, pid FROM usuario WHERE usuario.usuario = puser; 

    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comunidad`
--

CREATE TABLE `comunidad` (
  `idcomunidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ubicacion` varchar(200) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `encargado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comunidad`
--

INSERT INTO `comunidad` (`idcomunidad`, `nombre`, `ubicacion`, `telefono`, `encargado`) VALUES
(8, 'Centro comunitario de San Bosco', 'San Bosco de Santa Bárbara de Heredia, frente a la plaza comunal de San Bosco.', '22693516', 'Mary Chavarría');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `profesor` varchar(50) NOT NULL,
  `cuposdisponibles` int(11) NOT NULL,
  `precio` varchar(20) NOT NULL,
  `horario` varchar(80) NOT NULL,
  `duracion` varchar(100) NOT NULL COMMENT 'Duracion del cursos en meses',
  `idcomunidad` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`idcurso`, `nombre`, `descripcion`, `profesor`, `cuposdisponibles`, `precio`, `horario`, `duracion`, `idcomunidad`, `activo`) VALUES
(6, 'Bordado Punto y Cruz - Nivel 1', 'Se introducirán las bases del bordado punto y cruz y sus elementos.', 'Flor Mejía', 17, '10000', 'Lunes de 6-7:30 pm', '1 mes a partir del 4 de noviembre.', 8, 1),
(7, 'Manejo de Alimentos', 'Curso indispensable para el manejo de alimentos profesionalmente. Se dan las certificaciones del ministerio de Salud.', 'Edgar Roldán', 22, '22000 colones', 'Jueves y Viernes de 5 a 7 pm', '2 meses a partir del Lunes 4 de noviembre.', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estudiante`
--

CREATE TABLE `estudiante` (
  `cedula` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primerapellido` varchar(50) NOT NULL,
  `segundoapellido` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estudiante`
--

INSERT INTO `estudiante` (`cedula`, `nombre`, `primerapellido`, `segundoapellido`, `telefono`, `correo`) VALUES
(103870619, 'Victor', 'Camacho', 'Rubi', '87589984', 'vcamacho@gmail.com'),
(116920331, 'Gabriel', 'Solórzano', 'Chanto', '87062905', 'g.solorzano97@hotmail.com'),
(117250365, 'Paolo', 'Blanco', 'Núñez', '70145505', 'pblanco@hotmail.es'),
(206710976, 'Ana', 'Delgado', 'Cruz', '22547885', 'a.delgado23@gmail.com'),
(401061222, 'Eduardo', 'Parra', 'Cortéz', '82255731', 'epcortez@gmail.com'),
(402440409, 'Luciana', 'Herrera', 'Ugalde', '75145586', 'luciana96@hotmail.com'),
(800770443, 'Hernán', 'Solórzano', 'Saavedra', '88224235', 'hsolorzano@gash.co.cr');

-- --------------------------------------------------------

--
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `idEncargado` int(50) NOT NULL,
  `idMatricula` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `matricula`
--

CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL,
  `idestudiante` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matricula`
--

INSERT INTO `matricula` (`idmatricula`, `idestudiante`, `idcurso`) VALUES
(73, 103870619, 6),
(74, 206710976, 6),
(76, 402440409, 6),
(77, 800770443, 6);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `idusuario` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `idcomunidad` int(11) NOT NULL,
  `telefono` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`idpersona`, `idusuario`, `nombre`, `apellido1`, `apellido2`, `idcomunidad`, `telefono`) VALUES
(105980415, 20, 'Maribel', 'Chanto', 'Cantillano', 8, '83434964'),
(402430534, 21, 'Carlos', 'Gómez', 'Segura', 8, '86615654');

-- --------------------------------------------------------

--
-- Table structure for table `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipoUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipousuario`
--

INSERT INTO `tipousuario` (`idtipoUsuario`, `nombre`, `descripcion`) VALUES
(1, 'Super Usuario', 'Usuario con poderes de crear comunidades.'),
(2, 'Administrador', 'Usuario con los poderes de matricular y desmatricular personas en una comunidad');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  `nuevo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `contrasena`, `idtipousuario`, `nuevo`) VALUES
(2, 'gabritico', '8cb2237d0679ca88db6464eac60da96345513964', 1, 0),
(20, 'mchanto', 'e65aed2eb817c7e65d4c097ca0010cbaf14064db', 2, 0),
(21, 'nacho', '6a503dfe2af5d13d793e4891a3ff135d96df8000', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comunidad`
--
ALTER TABLE `comunidad`
  ADD PRIMARY KEY (`idcomunidad`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `idcomunidad_idx` (`idcomunidad`);

--
-- Indexes for table `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`cedula`);

--
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idEncargado`,`idMatricula`),
  ADD KEY `idMatriculado` (`idMatricula`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idmatricula`),
  ADD KEY `idcurso_idx` (`idcurso`),
  ADD KEY `idestudiante_idx` (`idestudiante`) USING BTREE;

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `idusuario_idx` (`idusuario`),
  ADD KEY `idcomunidadpersona` (`idcomunidad`);

--
-- Indexes for table `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipoUsuario`),
  ADD UNIQUE KEY `idtipoUsuario_UNIQUE` (`idtipoUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `correo_UNIQUE` (`usuario`),
  ADD KEY `idtipousuario_idx` (`idtipousuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comunidad`
--
ALTER TABLE `comunidad`
  MODIFY `idcomunidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idmatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `idcomunidad` FOREIGN KEY (`idcomunidad`) REFERENCES `comunidad` (`idcomunidad`);

--
-- Constraints for table `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `idcurso` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`),
  ADD CONSTRAINT `idestudiante` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`cedula`);

--
-- Constraints for table `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `idcomunidadpersona` FOREIGN KEY (`idcomunidad`) REFERENCES `comunidad` (`idcomunidad`),
  ADD CONSTRAINT `iduser` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idtipousuario` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuario` (`idtipoUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
