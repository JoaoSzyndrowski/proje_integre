-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2024 às 04:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `misturasoft`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id_agenda` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `id_produto` int(11) NOT NULL,
  `horainicio` time NOT NULL,
  `horafim` time NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `sts` enum('concluido','em andamento') DEFAULT NULL,
  `horaInsert` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamento`
--

INSERT INTO `agendamento` (`id_agenda`, `data`, `id_produto`, `horainicio`, `horafim`, `id_cliente`, `sts`, `horaInsert`) VALUES
(25, '2024-11-19', 1, '06:17:00', '06:17:00', 2, 'concluido', '00:17:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ag_prod_cliente`
--

CREATE TABLE `ag_prod_cliente` (
  `id_agprodcliente` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_agendamento` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `endereco` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `telefone`, `endereco`, `cpf`) VALUES
(6, 'Carlos Souza', 'carlos@example.com', '456123789', 'Rua da Paz, 789', '321.654.987-00'),
(7, 'Maria Oliveira', 'maria@example.com', '987654321', 'Avenida Central, 456', '987.654.321-00'),
(8, 'Carlos Souza', 'carlos@example.com', '456123789', 'Rua da Paz, 789', '321.654.987-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `preco` float DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `tamanho` varchar(200) DEFAULT NULL,
  `faixa_etaria` varchar(100) DEFAULT NULL,
  `status` enum('disp','indisp') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `preco`, `nome`, `descricao`, `tamanho`, `faixa_etaria`, `status`) VALUES
(1, 19.99, 'Camiseta', 'Camiseta de algodão, tamanho médio', 'M', 'Adulto', 'disp'),
(2, 149.5, 'Produto B', 'Descrição do Produto B', 'P', 'Criança', ''),
(3, 79.99, 'Produto C', 'Descrição do Produto C', 'G', 'Adulto', 'disp'),
(4, 120, 'Produto D', 'Descrição do Produto D', 'GG', 'Idoso', 'disp'),
(5, 89.9, 'Produto E', 'Descrição do Produto E', 'M', 'Adulto', 'disp'),
(6, 49.99, 'Produto F', 'Descrição do Produto F', 'P', 'Criança', 'disp'),
(7, 199.9, 'Produto G', 'Descrição do Produto G', 'M', 'Adulto', 'disp'),
(8, 110, 'Produto H', 'Descrição do Produto H', 'G', 'Idoso', 'disp'),
(9, 59.9, 'Produto I', 'Descrição do Produto I', 'M', 'Criança', 'disp'),
(10, 129.5, 'Produto J', 'Descrição do Produto J', 'P', 'Adulto', 'disp'),
(16, 1231, '123123', '12312', 'G', 'Criança', 'indisp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `tipo` enum('cliente','adm') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `tipo`) VALUES
(1, 'edu chupa cu', 'edu@gmail.com', 'edu', 'adm');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `fk_produto_id` (`id_produto`);

--
-- Índices de tabela `ag_prod_cliente`
--
ALTER TABLE `ag_prod_cliente`
  ADD PRIMARY KEY (`id_agprodcliente`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `fk_usuario` (`id_usuario`),
  ADD KEY `fk_agendamento` (`id_agendamento`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `ag_prod_cliente`
--
ALTER TABLE `ag_prod_cliente`
  MODIFY `id_agprodcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ag_prod_cliente`
--
ALTER TABLE `ag_prod_cliente`
  ADD CONSTRAINT `fk_agendamento` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamento` (`id_agenda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
