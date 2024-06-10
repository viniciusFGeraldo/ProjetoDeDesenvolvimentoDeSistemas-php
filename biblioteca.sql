-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Jun-2024 às 16:20
-- Versão do servidor: 8.0.27
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_livro` int NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date DEFAULT NULL,
  `data_prevista_devolucao` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'emprestado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `id_usuario`, `id_livro`, `data_emprestimo`, `data_devolucao`, `data_prevista_devolucao`, `status`) VALUES
(88, 4, 17, '2024-06-10', '2024-06-10', '2024-06-24', 'devolvido'),
(89, 4, 17, '2024-06-10', '2024-06-10', '2024-06-24', 'devolvido'),
(90, 4, 17, '2024-06-10', NULL, '2024-06-24', 'emprestado'),
(91, 3, 17, '2024-06-10', '2024-06-10', '2024-06-24', 'devolvido'),
(92, 3, 19, '2024-06-10', '2024-06-10', '2024-06-24', 'devolvido'),
(94, 2, 19, '2024-06-10', '2024-06-10', '2024-06-24', 'devolvido'),
(95, 2, 17, '2024-06-10', '2024-06-10', '2024-06-24', 'devolvido'),
(96, 3, 19, '2024-06-10', '2024-06-10', '2024-06-24', 'devolvido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id` int NOT NULL,
  `titulo` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `autor` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `genero` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `ano_publicacao` int NOT NULL,
  `quantidade` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `autor`, `genero`, `ano_publicacao`, `quantidade`) VALUES
(17, 'dsadas', 'asdsada', 'asdasdsa', 2024, 0),
(19, 'asdasdsad', 'sadasdas', 'dasdasdas', 1999, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `senhaHash` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `email`, `senha`, `senhaHash`, `isAdmin`) VALUES
(2, 'João Juan Duarte', 'joao', 'joao_juan_duarte@hotamail.com', '123', '$2y$10$ptmDAtJ8MHVC9auriJaepeFTrYJtvFO5QCXn5wuxuGW0vE5vIG3Aa', 1),
(3, 'Cristiane Giovana Marina Farias', 'cristiane', 'cristiane-farias99@inglesasset.com.br', '987', '$2y$10$q0ogYpJ/0s3E3npnTK5PzOYwP1Q.Dkgrd0HTbRviGt2cD9Z23kMHK', 0),
(4, 'Thiago Schwantes de Moura', 'thi', 'thiagodemoura2015@gmail.com', '123', '$2y$10$QmkiZolz6RHxGO9xYUvd1.YIzfx.PBOVBn0KOQubhNRYvDSvI/pOa', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `is_livro` (`id_livro`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `is_livro` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
