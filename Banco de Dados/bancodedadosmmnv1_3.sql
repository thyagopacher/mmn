-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tempo de Geração: 08/06/2016 às 22:50
-- Versão do servidor: 5.5.49-cll
-- Versão do PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `bigguia_demo1`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `affiliateuser`
--

CREATE TABLE IF NOT EXISTS `affiliateuser` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `email` text NOT NULL,
  `referedby` varchar(15) NOT NULL DEFAULT 'none',
  `ipaddress` int(10) unsigned NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `active` int(11) NOT NULL,
  `tamount` double NOT NULL DEFAULT '0',
  `signupcode` text NOT NULL,
  `level` int(1) NOT NULL DEFAULT '2',
  `lider` int(1) NOT NULL DEFAULT '0',
  `expiry` varchar(50) NOT NULL DEFAULT '0',
  `cpf` varchar(11) CHARACTER SET utf8 NOT NULL,
  `total` double NOT NULL DEFAULT '0',
  `pontos` int(11) NOT NULL DEFAULT '0',
  `banco` varchar(255) NOT NULL,
  `agencia` varchar(255) NOT NULL,
  `conta` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Fazendo dump de dados para tabela `affiliateuser`
--

INSERT INTO `affiliateuser` (`Id`, `username`, `password`, `fname`, `email`, `referedby`, `ipaddress`, `mobile`, `active`, `tamount`, `signupcode`, `level`, `lider`, `expiry`, `cpf`, `total`, `pontos`, `banco`, `agencia`, `conta`, `tipo`) VALUES
(1, 'sistema', '', '', '', 'none', 0, 0, 0, 5, '', 2, 0, '0', '', 0, 0, '', '', '', ''),
(2, 'admin2016', '123456789', 'Administrador do Site', 'admin@mmn5.16mb.com', 'sistema', 3143814384, 11900000000, 1, 5, '', 1, 0, '0', '01234567890', 0, 0, '', '', '', ''),
(3, 'useruser01', '123456789', 'Primeiro UsuÃ¡rio', 'user1@mmn5.16mb.com', 'admin2016', 3143814384, 11911111111, 0, 5, '', 2, 0, '0', '12345678901', 0, 0, '', '', '', ''),
(4, 'useruser02', '123456789', 'Segundo UsuÃ¡rio', 'user2@mmn5.16mb.com', 'useruser01', 3143814384, 11922222222, 0, 5, '', 2, 0, '0', '23456789012', 0, 0, '', '', '', ''),
(5, 'useruser03', '123456789', 'Terceiro UsuÃ¡rio', 'user3@mmn5.16mb.com', 'useruser02', 3143814384, 11933333333, 0, 10, '', 2, 0, '0', '34567890123', 0, 0, '', '', '', ''),
(6, 'useruser04', '123456789', 'Quarto UsuÃ¡rio', 'user4@mmn5.16mb.com', 'useruser03', 3143814384, 11944444444, 1, 0, '', 2, 0, '0', '45678901234', 0, 1, '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bonusdl`
--

CREATE TABLE IF NOT EXISTS `bonusdl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double NOT NULL,
  `data` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `bonusdl`
--

INSERT INTO `bonusdl` (`id`, `valor`, `data`) VALUES
(1, 8.5, '08/06/2016');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comissions`
--

CREATE TABLE IF NOT EXISTS `comissions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `packslimit` int(10) NOT NULL DEFAULT '0',
  `saquemin` int(10) NOT NULL DEFAULT '0',
  `nv1` int(2) NOT NULL DEFAULT '0',
  `nv2` int(2) NOT NULL DEFAULT '0',
  `nv3` int(2) NOT NULL DEFAULT '0',
  `nv4` int(2) NOT NULL DEFAULT '0',
  `nv5` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `sbonus` double DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `validity` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `sbonus`, `active`, `validity`) VALUES
(1, 'Bronze', 100, 1, 1, 30),
(2, 'Prata', 200, 2, 1, 30),
(3, 'Ouro', 500, 5, 1, 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `payment_amount` double NOT NULL DEFAULT '0',
  `payment_status` int(1) NOT NULL DEFAULT '0',
  `data` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `payorders`
--

CREATE TABLE IF NOT EXISTS `payorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double DEFAULT '0',
  `tipo` varchar(255) NOT NULL,
  `user` varchar(15) NOT NULL,
  `nome` text NOT NULL,
  `status` int(11) NOT NULL,
  `pontos` double DEFAULT '0',
  `dia` varchar(50) NOT NULL DEFAULT '0',
  `valid` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `payorders`
--

INSERT INTO `payorders` (`id`, `valor`, `tipo`, `user`, `nome`, `status`, `pontos`, `dia`, `valid`) VALUES
(1, 100, 'Bronze', 'useruser04', 'Quarto UsuÃ¡rio', 1, 1, '08/06/2016', '08/07/2016');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sacar`
--

CREATE TABLE IF NOT EXISTS `sacar` (
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `sacar`
--

INSERT INTO `sacar` (`status`) VALUES
(1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `email` varchar(100) NOT NULL DEFAULT 'Enter Your E-Mail Address',
  `wlink` varchar(100) NOT NULL DEFAULT 'www.yourwebsite.com',
  `coname` text NOT NULL,
  `limite_ganho` int(5) NOT NULL DEFAULT '200',
  `emailbank` varchar(100) NOT NULL DEFAULT 'email',
  `banco` varchar(255) NOT NULL DEFAULT '0',
  `agencia` varchar(255) NOT NULL DEFAULT '0',
  `conta` varchar(255) NOT NULL DEFAULT '0',
  `tipo` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `uplines`
--

CREATE TABLE IF NOT EXISTS `uplines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(15) CHARACTER SET latin1 NOT NULL,
  `up1` varchar(15) CHARACTER SET latin1 NOT NULL,
  `up2` varchar(15) CHARACTER SET latin1 NOT NULL,
  `up3` varchar(15) CHARACTER SET latin1 NOT NULL,
  `up4` varchar(15) CHARACTER SET latin1 NOT NULL,
  `up5` varchar(15) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `uplines`
--

INSERT INTO `uplines` (`id`, `user_id`, `up1`, `up2`, `up3`, `up4`, `up5`) VALUES
(1, 'admin2016', 'sistema', '', '', '', ''),
(2, 'useruser01', 'admin2016', 'sistema', '', '', ''),
(3, 'useruser02', 'useruser01', 'admin2016', 'sistema', '', ''),
(4, 'useruser03', 'useruser02', 'useruser01', 'admin2016', 'sistema', ''),
(5, 'useruser04', 'useruser03', 'useruser02', 'useruser01', 'admin2016', 'sistema');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_bonus_dl`
--

CREATE TABLE IF NOT EXISTS `user_bonus_dl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `dia` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
