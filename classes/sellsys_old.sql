-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Set-2016 às 21:54
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `costumers`
--

CREATE TABLE IF NOT EXISTS `costumers` (
  `id` int(150) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(70) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`id`, `code`, `brand`, `model`, `type`, `amount`, `price_in`, `price_out`, `description`, `date`) VALUES
(5, '00021355', 'Coisa', 'Modelado', 'Tipado', 8, 15.50, 21.50, 'Teste', '2016-07-08 16:13:17'),
(6, '123456789', 'Teste', 'Testado', 'Test', 12, 15.20, 78.33, 'Novo', '2016-07-13 16:09:48'),
(7, '152', 'Brand', 'Model', 'Type', 5, 36.55, 122.48, 'Desc', '2016-07-20 10:57:50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
