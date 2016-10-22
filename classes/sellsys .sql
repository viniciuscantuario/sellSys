-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Out-2016 às 21:26
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sellsys`
--
CREATE DATABASE IF NOT EXISTS `sellsys` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sellsys`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `costumers`
--

CREATE TABLE IF NOT EXISTS `costumers` (
  `id` int(150) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(70) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `costumers`
--

INSERT INTO `costumers` (`id`, `name`, `cpf`, `phone`, `birthday`, `address`, `city`, `country`, `date`) VALUES
(1, 'Cesar Garcia', '00832591122', '62981346006', '1991-07-25', 'Rua Em 12 Quadra 26 Lote 01 Vila Sul', 'Goiânia', 'Brasil', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `sell_number` varchar(15) NOT NULL,
  `costumer_id` int(100) NOT NULL,
  `stock_id` int(100) NOT NULL,
  `amount` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `costumer_id` (`costumer_id`),
  KEY `stock_id` (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `sales`
--

INSERT INTO `sales` (`id`, `sell_number`, `costumer_id`, `stock_id`, `amount`) VALUES
(1, '580a5437b0e0b', 1, 5, 2),
(2, '580a5437b0e0b', 1, 7, 1),
(3, '580a5437b0e0b', 1, 6, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(100) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `code` varchar(50) NOT NULL COMMENT 'Product code',
  `brand` varchar(100) NOT NULL COMMENT 'Product brand',
  `model` varchar(100) NOT NULL COMMENT 'Product model',
  `type` varchar(100) NOT NULL COMMENT 'Product type',
  `amount` int(50) NOT NULL COMMENT 'Amount of product',
  `price_in` float(50,2) NOT NULL COMMENT 'purchase price',
  `price_out` float(50,2) NOT NULL COMMENT 'sale price',
  `description` varchar(100) NOT NULL COMMENT 'Product description',
  `date` datetime NOT NULL COMMENT 'date of insert',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`id`, `code`, `brand`, `model`, `type`, `amount`, `price_in`, `price_out`, `description`, `date`) VALUES
(5, '00021355', 'Coisa', 'Modelado', 'Tipado', 8, 15.50, 21.50, 'Teste', '2016-07-08 16:13:17'),
(6, '123456789', 'Teste', 'Testado', 'Test', 12, 15.20, 78.33, 'Novo', '2016-07-13 16:09:48'),
(7, '152', 'Brand', 'Model', 'Type', 5, 36.55, 122.48, 'Desc', '2016-07-20 10:57:50');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`costumer_id`) REFERENCES `costumers` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
