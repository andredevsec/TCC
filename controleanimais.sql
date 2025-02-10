-- ====================================================
-- Script Completo para o banco de dados "controleanimais"
-- com relacionamento de agrupamento para animais, serviços,
-- alimentos e medicamentos.
-- ====================================================

-- (Opcional) Se quiser recriar o banco do zero, descomente a linha abaixo:
DROP DATABASE IF EXISTS `controleanimais`;

CREATE DATABASE IF NOT EXISTS `controleanimais` 
    DEFAULT CHARACTER SET utf8 
    COLLATE utf8_general_ci;
USE `controleanimais`;

-- ====================================================
-- Criação das Tabelas Principais
-- ====================================================

-- Tabela Agrupamento
CREATE TABLE IF NOT EXISTS `agrupamento` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `valor_abate` DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Aluno
CREATE TABLE IF NOT EXISTS `aluno` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `curso` VARCHAR(100) NOT NULL,
    `ra` VARCHAR(100) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `senha` VARCHAR(100) NOT NULL,
    `cep` VARCHAR(8) NOT NULL,
    `endereco` VARCHAR(100) NOT NULL,
    `numero` VARCHAR(10) NOT NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `uf` VARCHAR(2) NOT NULL,
    `telefone` VARCHAR(20) NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `perfil` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Terceirizado
CREATE TABLE IF NOT EXISTS `terceirizado` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `telefone` VARCHAR(20) NOT NULL,
    `senha` VARCHAR(100) NOT NULL,
    `cep` VARCHAR(8) NOT NULL,
    `endereco` VARCHAR(100) NOT NULL,
    `numero` VARCHAR(10) NOT NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `uf` VARCHAR(2) NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `perfil` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Serviço
CREATE TABLE IF NOT EXISTS `servico` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `valor` DECIMAL(10,2) NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Animal
CREATE TABLE IF NOT EXISTS `animal` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `identificador` VARCHAR(100) NOT NULL,
    `quantidade` INT NOT NULL,
    `peso` DECIMAL(10,2) NOT NULL,
    `fase` VARCHAR(100) NOT NULL,
    `sexo` ENUM('Macho', 'Fêmea') NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Alimento
CREATE TABLE IF NOT EXISTS `alimento` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `valor` DECIMAL(10,2) NOT NULL,
    `quantidade` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Medicamento
CREATE TABLE IF NOT EXISTS `medicamento` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `valor` DECIMAL(10,2) NOT NULL,
    `quantidade` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Usuário
CREATE TABLE IF NOT EXISTS `usuario` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `senha` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `cep` VARCHAR(8) NOT NULL,
    `endereco` VARCHAR(100) NOT NULL,
    `numero` VARCHAR(10) NOT NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `uf` VARCHAR(2) NOT NULL,
    `perfil` INT NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Ordem de Serviço
CREATE TABLE IF NOT EXISTS `ordem` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `cod_aluno` INT NOT NULL,
    `cod_terceirizado` INT NOT NULL,
    `cod_servico` INT NOT NULL,
    `data_servico` DATE NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`),
    CONSTRAINT `fk_ordem_aluno` FOREIGN KEY (`cod_aluno`) REFERENCES `aluno` (`cod`) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_ordem_servico` FOREIGN KEY (`cod_servico`) REFERENCES `servico` (`cod`) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_ordem_terceirizado` FOREIGN KEY (`cod_terceirizado`) REFERENCES `terceirizado` (`cod`) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ====================================================
-- Criação das Tabelas de Relacionamento para Agrupamento
-- ====================================================
-- Cada join table liga um registro de agrupamento a um item da entidade correspondente.

-- Relacionamento entre Agrupamento e Animal
CREATE TABLE IF NOT EXISTS `agrupamento_animal` (
    `agrupamento_id` INT NOT NULL,
    `animal_id` INT NOT NULL,
    PRIMARY KEY (`agrupamento_id`, `animal_id`),
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`animal_id`) REFERENCES `animal`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Relacionamento entre Agrupamento e Serviço
CREATE TABLE IF NOT EXISTS `agrupamento_servico` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `agrupamento_id` INT NOT NULL,
    `servico_id` INT NOT NULL,
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`servico_id`) REFERENCES `servico`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Relacionamento entre Agrupamento e Alimento
CREATE TABLE IF NOT EXISTS `agrupamento_alimento` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `agrupamento_id` INT NOT NULL,
    `alimento_id` INT NOT NULL,
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`alimento_id`) REFERENCES `alimento`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Relacionamento entre Agrupamento e Medicamento
CREATE TABLE IF NOT EXISTS `agrupamento_medicamento` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `agrupamento_id` INT NOT NULL,
    `medicamento_id` INT NOT NULL,
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`medicamento_id`) REFERENCES `medicamento`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ====================================================
-- Inserções de Dados (Mantendo os Inserts Originais)
-- ====================================================
-- Inserção em Usuário
INSERT INTO `usuario` (`cod`, `nome`, `senha`, `email`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `perfil`, `status`, `data`) VALUES
	(32, 'teste', '698dc19d489c4e4db73e28a713eab07b', 'teste@gmail.com', '37750000', 'teste', '2', 'Centro', 'Machado', 'MG', 1, 1, '2024-08-06');

-- Inserção em Agrupamento
INSERT INTO `agrupamento` (`id`, `nome`, `valor_abate`) VALUES
    (2, 'Agrupamento Bovinos', 150.00),
    (3, 'Agrupamento Suínos', 80.00),
    (4, 'Agrupamento Aves', 30.00);

-- Inserção em Animal
INSERT INTO `animal` (`cod`, `identificador`, `quantidade`, `peso`, `fase`, `sexo`, `data`) VALUES
    (9, 'Boi-001', 5, 500.00, 'engorda', 'Macho', '2024-09-10'),
    (10, 'Vaca-002', 3, 450.00, 'produção leite', 'Fêmea', '2024-09-10'),
    (11, 'Porco-003', 10, 100.00, 'crescimento', 'Macho', '2024-09-10'),
    (12, 'Galinha-004', 50, 2.00, 'postura', 'Fêmea', '2024-09-10');

-- Inserção em Alimento
INSERT INTO `alimento` (`cod`, `nome`, `valor`, `quantidade`, `data`) VALUES
    (8, 'Ração Bovina', 120.00, 500, '2024-09-05'),
    (9, 'Ração Suína', 80.00, 300, '2024-09-05'),
    (10, 'Milho', 50.00, 200, '2024-09-05');

-- Inserção em Medicamento
INSERT INTO `medicamento` (`cod`, `nome`, `valor`, `quantidade`, `data`) VALUES
    (7, 'Vacina Aftosa', 30.00, 100, '2024-09-05'),
    (8, 'Antibiótico Suíno', 40.00, 50, '2024-09-05');

-- Inserção em Serviço
INSERT INTO `servico` (`cod`, `nome`, `valor`, `data`) VALUES
    (6, 'Castração', 200.00, '2024-09-06'),
    (7, 'Consulta Veterinária', 150.00, '2024-09-06'),
    (8, 'Exame de Sangue', 90.00, '2024-09-06');

    -- Inserção em Aluno
INSERT INTO `aluno` (`cod`, `nome`, `curso`, `ra`, `email`, `senha`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `telefone`, `status`, `perfil`, `data`) VALUES
    (8, 'João Silva', 'Zootecnia', '456', 'joao@gmail.com', 'senha123', '37750000', 'Rua das Fazendas', '50', 'Centro', 'São Paulo', 'SP', '11987654321', 1, 2, '2024-09-04'),
    (9, 'Maria Souza', 'Veterinária', '789', 'maria@gmail.com', 'senha123', '37750000', 'Rua dos Animais', '30', 'Zona Rural', 'Belo Horizonte', 'MG', '31987654321', 1, 2, '2024-09-04');


-- Inserção em Terceirizado
INSERT INTO `terceirizado` (`cod`, `nome`, `email`, `telefone`, `senha`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `status`, `perfil`, `data`) VALUES
    (11, 'Carlos Mendes', 'carlos@gmail.com', '11999999999', 'senha123', '37750000', 'Rua da Saúde', '101', 'Centro', 'São Paulo', 'SP', 1, 3, '2024-09-06'),
    (12, 'Ana Oliveira', 'ana@gmail.com', '11988888888', 'senha123', '37750000', 'Rua da Fazenda', '202', 'Rural', 'Curitiba', 'PR', 1, 3, '2024-09-06');

-- Inserção em Ordem de Serviço
INSERT INTO `ordem` (`cod_aluno`, `cod_terceirizado`, `cod_servico`, `data_servico`, `status`, `data`) VALUES
    (8, 11, 6, '2024-09-10', 1, '2024-09-06'),
    (8, 11, 7, '2024-09-11', 1, '2024-09-06'),
    (9, 12, 8, '2024-09-12', 1, '2024-09-06');

-- Inserção em Agrupamento-Animal
INSERT INTO `agrupamento_animal` (`agrupamento_id`, `animal_id`) VALUES
    (2, 9), (2, 10), (3, 11), (4, 12);

-- Inserção em Agrupamento-Serviço
INSERT INTO `agrupamento_servico` (`agrupamento_id`, `servico_id`) VALUES
    (2, 6), (3, 7), (4, 8);

-- Inserção em Agrupamento-Alimento
INSERT INTO `agrupamento_alimento` (`agrupamento_id`, `alimento_id`) VALUES
    (2, 8), (3, 9), (4, 10);

-- Inserção em Agrupamento-Medicamento
INSERT INTO `agrupamento_medicamento` (`agrupamento_id`, `medicamento_id`) VALUES
    (2, 7), (3, 8);
