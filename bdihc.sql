-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bdihc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bdihc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bdihc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `bdihc` ;

-- -----------------------------------------------------
-- Table `bdihc`.`admins`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`admins` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombres` VARCHAR(255) NOT NULL COMMENT '',
  `apellidos` VARCHAR(255) NOT NULL COMMENT '',
  `email` VARCHAR(255) NOT NULL COMMENT '',
  `password` VARCHAR(255) NOT NULL COMMENT '',
  `ultimo` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdihc`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`categorias` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(255) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdihc`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombres` VARCHAR(255) NOT NULL COMMENT '',
  `apellidos` VARCHAR(255) NOT NULL COMMENT '',
  `email` VARCHAR(255) NOT NULL COMMENT '',
  `password` VARCHAR(255) NOT NULL COMMENT '',
  `nacimiento` DATE NOT NULL COMMENT '',
  `sexo` VARCHAR(10) NOT NULL COMMENT '',
  `direccion` VARCHAR(255) NOT NULL COMMENT '',
  `inscripcion` DATETIME NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdihc`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`pedidos` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `id_cliente` INT NOT NULL COMMENT '',
  `fecha` DATETIME NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `direccion` VARCHAR(255) NOT NULL COMMENT '',
  `monto` FLOAT  NULL COMMENT '',
  `estado` INT NOT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`, `id_cliente`)  COMMENT '',
  INDEX `fk_pedidos_clientes_idx` (`id_cliente` ASC)  COMMENT '',
  CONSTRAINT `fk_pedidos_clientes`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `bdihc`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdihc`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`productos` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `price` FLOAT NOT NULL COMMENT '',
  `imagen` VARCHAR(255) NOT NULL COMMENT '',
  `name` VARCHAR(255) NOT NULL COMMENT '',
  `id_categoria` INT NOT NULL COMMENT '',
  `oferta` INT NULL COMMENT '',
  `stock` INT NOT NULL COMMENT '',
  `descripcion` VARCHAR(255) NOT NULL COMMENT '',
  PRIMARY KEY (`id`, `id_categoria`)  COMMENT '',
  INDEX `fk_productos_categorias1_idx` (`id_categoria` ASC)  COMMENT '',
  CONSTRAINT `fk_productos_categorias1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `bdihc`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdihc`.`carro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`carro` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT  '',
  `id_cliente` INT NOT NULL COMMENT '',
  `id_producto` INT NOT NULL COMMENT '',
  `cant` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`, `id_cliente`, `id_producto`)  COMMENT '',
  INDEX `fk_carro_clientes1_idx` (`id_cliente` ASC)  COMMENT '',
  INDEX `fk_carro_productos1_idx` (`id_producto` ASC)  COMMENT '',
  CONSTRAINT `fk_carro_clientes1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `bdihc`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carro_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `bdihc`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdihc`.`facturas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`facturas` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `id_pedido` INT NOT NULL COMMENT '',
  `numtarjeta` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`, `id_pedido`)  COMMENT '',
  INDEX `fk_facturas_pedidos1_idx` (`id_pedido` ASC)  COMMENT '',
  CONSTRAINT `fk_facturas_pedidos1`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `bdihc`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdihc`.`compra_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`compra_detalle` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `id_pedido` INT NOT NULL COMMENT '',
  `id_producto` INT NOT NULL COMMENT '',
  `cantidad` INT NOT NULL COMMENT '',
  `monto` FLOAT NULL COMMENT '',
  PRIMARY KEY (`id`, `id_pedido`, `id_producto`)  COMMENT '',
  INDEX `fk_compra_detalle_pedidos1_idx` (`id_pedido` ASC)  COMMENT '',
  INDEX `fk_compra_detalle_productos1_idx` (`id_producto` ASC)  COMMENT '',
  CONSTRAINT `fk_compra_detalle_pedidos1`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `bdihc`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_detalle_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `bdihc`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `bdihc`.`calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdihc`.`calificaciones` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `id_cliente` INT NOT NULL COMMENT '',
  `id_producto` INT NOT NULL COMMENT '',
  `calificacion` FLOAT NOT NULL COMMENT '',
  PRIMARY KEY (`id`, `id_cliente`, `id_producto`)  COMMENT '',
  INDEX `fk_calificaciones_clientes1_idx` (`id_cliente` ASC)  COMMENT '',
  INDEX `fk_calificaciones_productos1_idx` (`id_producto` ASC)  COMMENT '',
  CONSTRAINT `fk_calificaciones_clientes1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `bdihc`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calificaciones_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `bdihc`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `bdihc`.`meses` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `mes` VARCHAR(255) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `bdihc`.`facebook` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `fecha` DATETIME NOT NULL COMMENT '',
  `likes` INT NOT NULL COMMENT '',
  `posts` INT NOT NULL COMMENT '',
  `mensajes_unread` INT NOT NULL COMMENT '',  
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

insert into meses values(1,"Enero");
insert into meses values(2,"Febrero");
insert into meses values(3,"Marzo");
insert into meses values(4,"Abril");
insert into meses values(5,"Mayo");
insert into meses values(6,"Junio");
insert into meses values(7,"Julio");
insert into meses values(8,"Agosto");
insert into meses values(9,"Setiembre");
insert into meses values(10,"Noviembre");
insert into meses values(11,"Noviembre");
insert into meses values(12,"Diciembre");
  
INSERT INTO `admins` VALUES (1, 'admin', 'admin', 'admin', 'admin', '2019-06-18 02:11:33');
INSERT INTO `categorias` VALUES (1, 'Frutas');
INSERT INTO `categorias` VALUES (2, 'Tecnologia');
INSERT INTO `clientes` VALUES (1, 'bruno', 'salazar', 'brunoasp@gmail.com', '12345', '1999-03-26', 'Masculino', 'crroo', '2019-06-18 02:53:22');
INSERT INTO `clientes` VALUES (2, 'henry', 'aliaga', 'navichicken@gmail.com', '147', '2019-06-18', 'Masculino', 'Crroo', '2019-06-18 02:53:51');
INSERT INTO `productos` VALUES (1, 35, 'https://naylampmechatronics.com/1359-large_default/sensor-de-temperatura-mlx90614.jpg', 'MLX90614', 1, 30, 20, 'Sensor de temperatura');
INSERT INTO `productos` VALUES (2, 35, 'https://naylampmechatronics.com/1744-large_default/modulo-transmisor-rtd-pt100-max31865.jpg', 'Modulo transmisor RTD PT100 MAX31865', 1, 25, 13, 'Transmisor para sensores de temperatura RTD con excelente resolucion');
INSERT INTO `productos` VALUES (3, 5, 'https://naylampmechatronics.com/1316-large_default/sensor-de-fuego-yg1006.jpg', 'YG1006', 1, 4, 4, 'Sensor de flama');
INSERT INTO `productos` VALUES (4, 90, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVH2AFGC1G6jhzSVyhJjoJtd4JKEn6pWEbq7iZYA8tAOKikjBR', 'Arduino Due R3', 2, 85, 2, 'Tarjeta de desarrollo mucho mas potente que Arduino Mega');
INSERT INTO `productos` VALUES (5, 60, 'https://naylampmechatronics.com/1646-large_default/arduino-mega-2560-embebido.jpg', 'Arduino Mega 2560', 2, 56, 7, 'Version miniaturizada del Arduino Mega');INSERT INTO `productos` VALUES (6, 35, 'https://naylampmechatronics.com/1669-large_default/arduino-micro.jpg', 'Arduino Micro', 2, 32, 12, 'Uno de los arduinos mas pequeños, con formato amigable para Protoboard');INSERT INTO `productos` VALUES (7, 25, 'https://www.electronicoscaldas.com/1171-thickbox_default/modulo-bluetooth-hc-06.jpg', 'Modulo Bluetooth HC06', 3, 20, 5, 'Conecta inalambricamente tus proyectos con una PC, laptop o Smartphone de forma sencilla');INSERT INTO `productos` VALUES (8, 20, 'https://naylampmechatronics.com/719-thickbox_default/modulo-wifi-serial-esp-01-esp8266.jpg', 'Modulo WiFi Serial ESP-01 ESP8266', 3, 17, 8, 'Conecta tus proyectos a tu red WiFi y elabora proyectos con IoT');INSERT INTO `productos` VALUES (9, 7, 'https://naylampmechatronics.com/700-large_default/modulo-adaptador-lcd-a-i2c.jpg', 'Modulo adaptador LCD a I2C', 3, 5, 13, 'Controla tu LCD Alfanumerico utilizando solo 2 pines en lugar de 6');INSERT INTO `productos` VALUES (10, 65, 'https://naylampmechatronics.com/2502-large_default/medidor-de-energia-dc-100vdc-20a.jpg', 'Medidor de energia DC 100VDC 20A', 4, 60, 11, 'Con este medidor puedes monitorear en cargas DC el voltaje, corriente, etc');INSERT INTO `productos` VALUES (11, 15, 'https://naylampmechatronics.com/170-large_default/modulo-sensor-de-luz-digital-bh1750.jpg', 'Modulo sensor de luz digital BH1750', 4, 13, 19, 'Sensor de iluminacion digital que permite realizar mediciones de flujo luminico');INSERT INTO `productos` VALUES (12, 10, 'https://wongfood.vteximg.com.br/arquivos/ids/159289-230-230/Pera-Packhams-Wong-67287.jpg?v=636089433514000000', 'DHT11', 4, 7, 16, 'Sensor de humedad relativa y temperatura de bajo costo y de media precision a un bajo precio');INSERT INTO `productos` VALUES (13, 205, 'https://naylampmechatronics.com/1016-large_default/cargador-de-bateria-imax-b6ac-compatible.jpg', 'Cargador de bateria iMax B6AC', 5, 195, 13, 'Carga tus baterias Li-Po de la forma profesional, mas rapida y segura');INSERT INTO `productos` VALUES (14, 8, 'https://http2.mlstatic.com/cargador-de-bateria-de-litio-con-proteccion-arduino-pic-D_NQ_NP_842011-MLC20465472160_102015-F.jpg', 'Cargador USB de bateria litio 18650 1A con proteccion', 5, 5, 23, 'Carga tus baterias Li-Ion directamente del puerto USB con este modulo');INSERT INTO `productos` VALUES (15, 70, 'https://naylampmechatronics.com/971-large_default/cargador-de-bateria-li-po-imax-b3.jpg', 'Cargador de bateria Li-Po IMAX B3', 5, 65, 3, 'Carga tus baterias Li-Po de la forma mas rapida y segura');INSERT INTO `productos` VALUES (16, 12, 'https://naylampmechatronics.com/403-large_default/display-lcd1602-azul-backlight.jpg', 'Display Alfanumerico LCD 1602', 6, 10, 14, 'Pantalla alfanumerica de 2 filas y 16 columnas');INSERT INTO `productos` VALUES (17, 70, 'https://naylampmechatronics.com/2180-large_default/shield-display-lcd-tft-35-tactil.jpg', 'Shield Display LCD TFT 3.5 tactil', 6, 60, 11, 'Shield con pantalla LCD TFT de 3.5 a colores con membrana sensible al tacto');INSERT INTO `productos` VALUES (18, 20, 'https://naylampmechatronics.com/41-large_default/shield-lcd-keypad.jpg', 'Shield LCD Keypad', 6, 15, 8, 'La forma mas rapida de agregar una interfaz hombre-maquina a tus proyectos');INSERT INTO `productos` VALUES (19, 8, 'https://naylampmechatronics.com/724-large_default/protoboard-400.jpg', 'Protoboard 400', 7, 5, 30, 'El mejor protoboard para experimentar rapidamente tus proyectos');INSERT INTO `productos` VALUES (20, 7, 'https://naylampmechatronics.com/2499-large_default/modulo-74hc4067-multiplexor-analogico-16ch.jpg', 'Modulo 74HC4067', 7, 4, 31, 'Expande las entradas analogicas o digitales de tu proyecto');
INSERT INTO `pedidos` VALUES (1, 1, '2019-06-18 03:02:40', 'Ez', 4000, 1);
INSERT INTO `compra_detalle` VALUES (1, 1, 2, 4, 1000);
INSERT INTO `facturas` VALUES (1, 1, '1478546');



