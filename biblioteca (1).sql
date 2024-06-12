-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/06/2024 às 20:07
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
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date DEFAULT NULL,
  `data_prevista_devolucao` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'emprestado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `autor` varchar(150) NOT NULL,
  `genero` varchar(150) NOT NULL,
  `ano_publicacao` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `autor`, `genero`, `ano_publicacao`, `quantidade`) VALUES
(22, '1984', 'George Orwell', 'Distopia', 1949, 15),
(23, 'O Morro dos Ventos Uivantes', ' Emily Brontë', 'Romance Gótico', 1847, 10),
(24, 'Orgulho e Preconceito', 'Jane Austen', 'Romance', 1813, 25),
(25, 'O Grande Gatsby', 'F. Scott Fitzgerald', 'Romance', 1925, 12),
(26, 'Moby Dick', 'Herman Melville', 'Aventura', 1851, 8),
(27, 'Cem Anos de Solidão', 'Gabriel García Márquez', 'Realismo Mágico', 1967, 30),
(28, 'A Metamorfose', 'Franz Kafka', 'Ficção', 1915, 5),
(29, 'A Revolução dos Bichos', 'George Orwell', ' Fábula Política', 1945, 22),
(30, 'O Apanhador no Campo de Centeio', ' J.D. Salinger', 'Romance', 1951, 17),
(31, 'O Senhor dos Anéis', ' J.R.R. Tolkien', 'Fantasia', 1954, 9),
(32, 'A Divina Comédia', 'Dante Alighieri', 'Poesia Épica', 1320, 7),
(33, 'O Processo', 'Franz Kafka', 'Ficção', 1915, 5),
(34, 'Crime e Castigo', ' Fiódor Dostoiévski', 'Romance', 1866, 14),
(35, 'Dom Quixote', 'Miguel de Cervantes', ' Romance', 1605, 20),
(36, 'Guerra e Paz', 'Liev Tolstói', 'Romance Histórico', 1869, 18),
(37, 'Ulisses', ' James Joyce', 'Romance Modernista', 1922, 11),
(38, 'O Estrangeiro', 'Albert Camus', 'Ficção Existencial', 1942, 6),
(39, 'O Sol é para Todos', 'Harper Lee', 'Romance', 1960, 19),
(40, 'Madame Bovary', 'Gustave Flaubert', 'Romance', 1857, 16),
(41, 'A Montanha Mágica', ' Thomas Mann', 'Romance', 1924, 21),
(42, 'Cemitérios de Dragões', 'Raphael Draccon', 'Fantasia', 2014, 23),
(43, 'A Máquina do Tempo', 'H.G. Wells', 'Ficção Científica', 1895, 13),
(44, 'A Ilha do Dr. Moreau', 'H.G. Wells', 'Ficção Científica', 1896, 10),
(45, 'Neuromancer', 'William Gibson', 'Cyberpunk', 1984, 12),
(46, 'Duna', 'Frank Herbert', ' Ficção Científica', 1965, 9),
(47, 'Fahrenheit 451', 'Ray Bradbury', 'Distopia', 1953, 24),
(48, 'O Nome da Rosa', 'Umberto Eco', 'Romance Histórico', 1980, 8),
(49, 'Brave New World', ' Aldous Huxley', 'Distopia', 1932, 20),
(50, 'As Aventuras de Huckleberry Finn', 'Mark Twain', 'Aventura', 1884, 14),
(51, 'Os Miseráveis', ' Victor Hugo', 'Romance', 1862, 15),
(52, 'A Laranja Mecânica', 'Anthony Burgess', 'Distopia', 1962, 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `senhaHash` varchar(150) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `email`, `senha`, `senhaHash`, `isAdmin`) VALUES
(2, 'João Juan Duarte', 'joao', 'joao_juan_duarte@hotamail.com', '123', '$2y$10$ptmDAtJ8MHVC9auriJaepeFTrYJtvFO5QCXn5wuxuGW0vE5vIG3Aa', 1),
(3, 'Cristiane Giovana Marina Farias', 'cristiane', 'cristiane-farias99@inglesasset.com.br', '987', '$2y$10$q0ogYpJ/0s3E3npnTK5PzOYwP1Q.Dkgrd0HTbRviGt2cD9Z23kMHK', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `is_livro` (`id_livro`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
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
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `is_livro` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
