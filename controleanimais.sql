-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.38 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para controleanimais
CREATE DATABASE IF NOT EXISTS `controleanimais` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `controleanimais`;

-- Copiando estrutura para tabela controleanimais.alimento
CREATE TABLE IF NOT EXISTS `alimento` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `quantidade` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela controleanimais.alimento: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela controleanimais.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `curso` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `perfil` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela controleanimais.aluno: ~1 rows (aproximadamente)
INSERT INTO `aluno` (`cod`, `nome`, `curso`, `email`, `senha`, `endereco`, `numero`, `bairro`, `cidade`, `telefone`, `status`, `perfil`, `data`) VALUES
	(8, 'aluno1', 'curso1', 'aluno1@gmail.com', 'a9f598a223a555dd4acaaa5a5a46a9e8', 'aluno1', '11', 'aluno1', 'aluno1', '16112341234', 1, 2, '2024-08-04');

-- Copiando estrutura para tabela controleanimais.animal
CREATE TABLE IF NOT EXISTS `animal` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `identificador` varchar(100) NOT NULL,
  `quantidade` varchar(100) NOT NULL,
  `peso` varchar(100) NOT NULL,
  `fase` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela controleanimais.animal: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela controleanimais.ordem
CREATE TABLE IF NOT EXISTS `ordem` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `cod_aluno` int NOT NULL,
  `cod_terceirizado` int NOT NULL,
  `cod_servico` int NOT NULL,
  `data_servico` date NOT NULL,
  `status` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `foreign_key_cod_aluno` (`cod_aluno`),
  KEY `foreign_key_cod_servico` (`cod_servico`),
  KEY `foreign_key_cod_terceirizado` (`cod_terceirizado`),
  CONSTRAINT `foreign_key_cod_aluno` FOREIGN KEY (`cod_aluno`) REFERENCES `aluno` (`cod`),
  CONSTRAINT `foreign_key_cod_servico` FOREIGN KEY (`cod_servico`) REFERENCES `servico` (`cod`),
  CONSTRAINT `foreign_key_cod_terceirizado` FOREIGN KEY (`cod_terceirizado`) REFERENCES `terceirizado` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela controleanimais.ordem: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela controleanimais.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela controleanimais.servico: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela controleanimais.terceirizado
CREATE TABLE IF NOT EXISTS `terceirizado` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `perfil` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela controleanimais.terceirizado: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela controleanimais.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `perfil` int NOT NULL,
  `status` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela controleanimais.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`cod`, `nome`, `senha`, `email`, `perfil`, `status`, `data`) VALUES
	(32, 'teste', '698dc19d489c4e4db73e28a713eab07b', 'teste@gmail.com', 1, 1, '2024-08-04');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
