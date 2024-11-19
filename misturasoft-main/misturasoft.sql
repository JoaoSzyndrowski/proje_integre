-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2024 às 04:28
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
  `sts` enum('concluido','em andamento') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamento`
--

INSERT INTO `agendamento` (`id_agenda`, `data`, `id_produto`, `horainicio`, `horafim`, `id_cliente`, `sts`) VALUES
(19, '0000-00-00', 1, '00:00:03', '00:20:24', 1, 'concluido'),
(20, '0000-00-00', 1, '00:00:03', '00:20:24', NULL, 'concluido'),
(21, '0000-00-00', 1, '00:00:11', '00:20:24', NULL, 'concluido'),
(22, '0000-00-00', 1, '00:00:00', '00:20:24', NULL, 'concluido'),
(23, '0000-00-00', 1, '00:00:04', '00:20:24', NULL, 'concluido'),
(24, '0000-00-00', 1, '04:43:00', '00:20:24', NULL, 'concluido'),
(25, '0000-00-00', 1, '04:43:00', '00:20:24', NULL, 'concluido'),
(26, '0000-00-00', 1, '04:43:00', '00:20:24', NULL, 'concluido'),
(27, '0000-00-00', 1, '04:43:00', '00:20:24', NULL, 'concluido'),
(28, '0000-00-00', 1, '04:43:00', '00:20:24', NULL, 'concluido'),
(29, '2024-11-21', 1, '01:43:00', '04:43:00', 1, 'concluido'),
(30, '2024-11-19', 2, '03:53:00', '05:53:00', 1, 'concluido'),
(31, '2024-11-12', 3, '00:07:00', '00:09:00', 1, 'concluido'),
(32, '2024-11-08', 4, '06:11:00', '21:11:00', 1, 'concluido');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ag_prod_cliente`
--

CREATE TABLE `ag_prod_cliente` (
  `id_agprodcliente` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `datahora` datetime DEFAULT NULL
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
(1, 'edu', 'tuamae@gmail.com', '666', '123123', '123123');

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
(2, 149.5, 'Produto B', 'Descrição do Produto B', 'P', 'Criança', 'disp'),
(3, 79.99, 'Produto C', 'Descrição do Produto C', 'G', 'Adulto', 'disp'),
(4, 120, 'Produto D', 'Descrição do Produto D', 'GG', 'Idoso', 'disp'),
(5, 89.9, 'Produto E', 'Descrição do Produto E', 'M', 'Adulto', 'disp'),
(6, 49.99, 'Produto F', 'Descrição do Produto F', 'P', 'Criança', 'disp'),
(7, 199.9, 'Produto G', 'Descrição do Produto G', 'M', 'Adulto', 'disp'),
(8, 110, 'Produto H', 'Descrição do Produto H', 'G', 'Idoso', 'disp'),
(9, 59.9, 'Produto I', 'Descrição do Produto I', 'M', 'Criança', 'disp'),
(10, 129.5, 'Produto J', 'Descrição do Produto J', 'P', 'Adulto', 'disp');

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
(1, 'eduardo', 'edu@gmail.com', 'edu', 'adm'),
(2, 'Eduardo Silveira Frigo', 'edu123@gmail.com', '$2y$10$k8d6WX3jN29roziXfaZhnuY2B5cLbAVxgafWsgCIPloZvWWetWp0G', NULL);

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
  ADD KEY `id_produto` (`id_produto`);

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
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `ag_prod_cliente`
--
ALTER TABLE `ag_prod_cliente`
  MODIFY `id_agprodcliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `fk_produto_id` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
