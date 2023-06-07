CREATE DATABASE vehiculos;
USE vehiculos;

CREATE TABLE automoviles
(
	idautomovil			INT AUTO_INCREMENT PRIMARY KEY,
	marca 				VARCHAR(30) 	NOT NULL,
	modelo 				VARCHAR(30) 	NOT NULL,
	precio 				DECIMAL(10,2) 	NOT NULL,
	tipoCombustible 	VARCHAR(20)  	NOT NULL,
	color					VARCHAR(30) NOT NULL,
	create_at 			DATETIME NOT NULL DEFAULT NOW(),
	update_at 			DATETIME NULL,
	CONSTRAINT uk_marca UNIQUE(marca, modelo)
)ENGINE = INNODB;

INSERT INTO automoviles (marca, modelo, precio, tipoCombustible, color) VALUES
('Kia', 'SPlay', 1500, 'Premiun', 'Rojo');

-- Listar
DELIMITER $$
CREATE PROCEDURE spu_listar()
BEGIN 
	SELECT * FROM automoviles ORDER BY idautomovil DESC;
END $$

-- Registrar 
DELIMITER $$
CREATE PROCEDURE spu_registrar (
IN _marca		VARCHAR(30),
IN _modelo		VARCHAR(30),
IN _precio		DECIMAL(10,2),
IN _tipoCombustible VARCHAR(20),
IN _color		VARCHAR(30)
)
BEGIN
	INSERT INTO automoviles (marca, modelo, precio, tipoCombustible, color) VALUES
	(_marca, _modelo, _precio, _tipoCombustible, _color);
END $$

-- Eliminar
DELIMITER $$
CREATE PROCEDURE spu_eliminar (
IN _idautomovil	INT
)
BEGIN 
	DELETE FROM automoviles 
	WHERE	idautomovil = _idautomovil;
END $$

-- obtener
DELIMITER $$
CREATE PROCEDURE spu_obtener(
IN _idautomovil 	INT
)
BEGIN 
	SELECT * FROM automoviles WHERE idautomovil = _idautomovil;
END $$

-- editar
DELIMITER $$
CREATE PROCEDURE spu_editar(
IN _idautomovil INT,
IN _marca		VARCHAR(30),
IN _modelo		VARCHAR(30),
IN _precio		DECIMAL(10,2),
IN _tipoCombustible VARCHAR(20),
IN _color		VARCHAR(30)
)
BEGIN 
	UPDATE automoviles SET 
	marca = _marca,
	modelo = _modelo,
	precio = _precio,
	tipoCombustible = _tipoCombustible,
	color = _color
	WHERE idautomovil = _idautomovil;
END $$