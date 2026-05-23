-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/05/2026 às 03:14
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mecanica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordem_servicos`
--

CREATE TABLE `ordem_servicos` (
  `id` int(11) NOT NULL,
  `id_ordem` int(11) NOT NULL,
  `servico` int(11) NOT NULL,
  `pecas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ordem_servicos`
--

INSERT INTO `ordem_servicos` (`id`, `id_ordem`, `servico`, `pecas`) VALUES
(1, 3, 11, 0),
(2, 3, 7, 0),
(3, 3, 0, 15),
(4, 3, 0, 8),
(5, 3, 0, 9),
(6, 4, 8, 0),
(7, 4, 11, 0),
(8, 4, 0, 3),
(9, 4, 0, 6),
(10, 4, 0, 14),
(11, 5, 16, 0),
(12, 5, 0, 16),
(13, 6, 15, 0),
(14, 6, 14, 0),
(15, 6, 12, 0),
(16, 6, 0, 14),
(17, 6, 0, 8),
(18, 6, 0, 17),
(19, 6, 0, 15),
(20, 7, 3, 0),
(21, 7, 6, 0),
(22, 7, 11, 0),
(23, 7, 0, 8),
(24, 7, 0, 6),
(25, 7, 0, 16),
(26, 8, 5, 0),
(27, 8, 9, 0),
(28, 8, 12, 0),
(29, 8, 0, 11),
(30, 8, 0, 14),
(31, 8, 0, 3),
(32, 8, 0, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordens`
--

CREATE TABLE `ordens` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(180) NOT NULL,
  `cpf` varchar(25) NOT NULL,
  `veiculo` varchar(100) NOT NULL,
  `placa` varchar(15) NOT NULL,
  `data_entrada` datetime NOT NULL,
  `data_saida` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ordens`
--

INSERT INTO `ordens` (`id`, `nome_cliente`, `cpf`, `veiculo`, `placa`, `data_entrada`, `data_saida`, `status`) VALUES
(3, 'Emerson Camargo', '88119653904', 'Monza SLE', 'EJT-0B42', '2026-05-16 03:15:54', '2026-05-19 19:26:18', 1),
(4, 'Ana Julia', '12345678977', 'C3 Cinza', '12W34RT', '2026-05-18 19:25:35', '2026-05-22 19:58:13', 1),
(5, 'jose', '478456141', 'citroen xsara picasso', '4545sds4545', '2026-05-20 00:26:12', '2026-05-22 19:58:15', 1),
(6, 'Alison', '578941651', 'opala', '441dwsd41', '2026-05-20 02:53:13', '0000-00-00 00:00:00', 0),
(7, 'edison', '85478416156', 'asdfasfdas', 'asdasdasda', '2026-05-23 00:58:08', '2026-05-22 19:58:18', 1),
(8, 'sghfdgafd', '484654418', 'dfghadfg', 'adfgafdgad', '2026-05-23 00:59:19', '2026-05-22 19:59:20', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pecas`
--

CREATE TABLE `pecas` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `marca` varchar(150) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_entrada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pecas`
--

INSERT INTO `pecas` (`codigo`, `nome`, `marca`, `modelo`, `descricao`, `data_entrada`) VALUES
(3, 'Filtro de Ar', 'Mahle', 'FA-991', 'Filtro de ar do motor de alta eficiência.', '2026-01-07'),
(4, 'Filtro de Combustível', 'Mahle', 'FC-22', 'Filtro de combustível para sistemas de injeção.', '2026-03-04'),
(5, 'Bomba de Combustível', 'Magneti Marelli', 'BC-200', 'Bomba de combustível interna 12V.', '2026-01-27'),
(6, 'Pistão com Anéis', 'Mahle', 'PA-1.6', 'Kit de pistão e anéis de motor 1.6 standard.', '2026-01-23'),
(7, 'Disco de Freio', 'Fras-le', 'DF-320', 'Disco de freio ventilado dianteiro.', '2026-01-09'),
(8, 'Filtro de Óleo', 'Bosch', 'OB012', 'Filtro de óleo de alta performance para motores flex.', '2026-02-25'),
(9, 'Bobina de Ignição', 'Magneti Marelli', 'BI-0914', 'Bobina de ignição eletrônica de alta tensão.', '2026-01-07'),
(10, 'Lona de Freio', 'Fras-le', 'LF-512', 'Lona de freio para eixo traseiro resistente.', '2026-04-18'),
(11, 'Amortecedor Dianteiro', 'Magneti Marelli', 'AMD-33', 'Amortecedor pressurizado a gás estrutural.', '2026-03-13'),
(12, 'Filtro de Óleo', 'Bosch', 'OB012', 'Filtro de óleo de alta performance para motores flex.', '2026-04-19'),
(13, 'Sonda Lambda', 'NGK', 'O2-NEO', 'Sensor de oxigênio pré-catalisador.', '2026-02-09'),
(14, 'Amortecedor Dianteiro', 'Magneti Marelli', 'AMD-33', 'Amortecedor pressurizado a gás estrutural.', '2026-01-27'),
(15, 'Vela de Ignição', 'Bosch', 'SPK-45', 'Jogo de velas de ignição Iridium.', '2026-01-25'),
(16, 'Sonda Lambda', 'NGK', 'O2-NEO', 'Sensor de oxigênio pré-catalisador.', '2026-03-09'),
(17, 'Pastilha de Freio', 'Bosch', 'BP987', 'Pastilha de freio dianteira cerâmica.', '2026-04-28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `categoria` varchar(150) NOT NULL,
  `prioridade` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `descricao`, `categoria`, `prioridade`) VALUES
(2, 'Revisão de Sistema Elétrico', 'Elétrica', 'Média'),
(3, 'Troca de Óleo e Filtro', 'Manutenção Preventiva', 'Alta'),
(5, 'Carga de Gás do Ar Condicionado', 'Climatização', 'Baixa'),
(6, 'Limpeza do Sistema de Arrefecimento', 'Sistema de Arrefecimento', 'Alta'),
(7, 'Troca de Fluido de Freio', 'Sistema de Freios', 'Alta'),
(9, 'Alinhamento e Balanceamento', 'Suspensão e Direção', 'Média'),
(11, 'Substituição da Bateria', 'Elétrica', 'Alta'),
(12, 'Substituição de Vela de Ignição', 'Motor', 'Média'),
(13, 'Cambagem e Caster', 'Suspensão e Direção', 'Média'),
(14, 'Troca de Filtro de Cabine', 'Climatização', 'Baixa'),
(15, 'Troca de Amortecedores Dianteiros', 'Suspensão e Direção', 'Alta'),
(16, 'Limpeza de Bicos Injetores', 'Injeção Eletrônica', 'Média');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(180) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `funcao` varchar(40) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `funcao`, `genero`, `login`, `senha`) VALUES
(1, 'José', '12345678911', 'admin', 'M', 'admin', 'admin'),
(3, 'Alline', '4874818185', 'administrativo', 'f', 'alline', 'allne'),
(5, 'Meca', '74161', 'mecanico', 'm', 'mecanico', 'mecanico');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ordens`
--
ALTER TABLE `ordens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pecas`
--
ALTER TABLE `pecas`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `ordens`
--
ALTER TABLE `ordens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pecas`
--
ALTER TABLE `pecas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
