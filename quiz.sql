-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Jun-2018 às 23:24
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `answer_user`
--

CREATE TABLE `answer_user` (
  `id` int(11) NOT NULL,
  `hits` int(15) DEFAULT NULL,
  `error` int(15) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user` varchar(200) NOT NULL,
  `finalized_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `answer_user`
--

INSERT INTO `answer_user` (`id`, `hits`, `error`, `created_at`, `user`, `finalized_at`) VALUES
(83, 2, 2, '2018-06-25 16:18:24', 'trezo', '2018-06-25 16:18:44'),
(84, 3, 1, '2018-06-25 17:50:07', 'dirceulh@hotmail.com', '2018-06-25 17:50:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `answer_user_id`
--

CREATE TABLE `answer_user_id` (
  `id` int(11) NOT NULL,
  `answers_id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `answer_user_id`
--

INSERT INTO `answer_user_id` (`id`, `answers_id`, `user`) VALUES
(5, 853, 'trezo'),
(6, 855, 'trezo'),
(7, 861, 'trezo'),
(8, 862, 'trezo'),
(9, 855, 'dirceulh@hotmail.com'),
(10, 863, 'dirceulh@hotmail.com'),
(11, 860, 'dirceulh@hotmail.com'),
(12, 850, 'dirceulh@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questions`
--

CREATE TABLE `questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `description_options` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Extraindo dados da tabela `questions`
--

INSERT INTO `questions` (`id`, `body`, `answer_id`, `created_at`, `updated_at`, `description_options`) VALUES
(217, 'Uma das palavras abaixo NÃƒO Ã© sinÃ´nimo de PerseveranÃ§a.', 853, '2018-06-25 13:54:42', '0000-00-00 00:00:00', ' DesistÃªncia'),
(218, 'InsÃ­pido Ã© o mesmo que:', 855, '2018-06-25 13:55:28', '0000-00-00 00:00:00', 'Que nÃ£o tem sabor'),
(219, 'O vocÃ¡bulo Inquieto significa:', 860, '2018-06-25 13:56:13', '0000-00-00 00:00:00', 'Agitado'),
(220, 'Perspicaz Ã© o mesmo que:', 863, '2018-06-25 13:56:57', '0000-00-00 00:00:00', ' Observador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `body` varchar(250) COLLATE utf8mb4_turkish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Extraindo dados da tabela `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `body`, `created_at`, `updated_at`) VALUES
(850, 217, 'ConstÃ¢ncia', '2018-06-25 13:54:42', '0000-00-00 00:00:00'),
(851, 217, 'PertinÃ¡cia', '2018-06-25 13:54:42', '0000-00-00 00:00:00'),
(852, 217, ' InsistÃªncia', '2018-06-25 13:54:42', '0000-00-00 00:00:00'),
(853, 217, ' DesistÃªncia', '2018-06-25 13:54:42', '0000-00-00 00:00:00'),
(854, 218, ' Ã‰ a mesma coisa que "IMENSO"', '2018-06-25 13:55:28', '0000-00-00 00:00:00'),
(855, 218, 'Que nÃ£o tem sabor', '2018-06-25 13:55:28', '0000-00-00 00:00:00'),
(856, 218, 'Aquele que anda sempre descalÃ§o', '2018-06-25 13:55:28', '0000-00-00 00:00:00'),
(857, 218, ' Que nÃ£o tem sabedoria', '2018-06-25 13:55:28', '0000-00-00 00:00:00'),
(858, 219, 'Ã‰ o AntÃ´nimo da palavra "LONGE"', '2018-06-25 13:56:14', '0000-00-00 00:00:00'),
(859, 219, 'Sossegado', '2018-06-25 13:56:14', '0000-00-00 00:00:00'),
(860, 219, 'Agitado', '2018-06-25 13:56:14', '0000-00-00 00:00:00'),
(861, 219, 'Nenhuma das respostas acima', '2018-06-25 13:56:14', '0000-00-00 00:00:00'),
(862, 220, ' IndivÃ­duo com pouca inteligÃªncia', '2018-06-25 13:56:57', '0000-00-00 00:00:00'),
(863, 220, ' Observador', '2018-06-25 13:56:57', '0000-00-00 00:00:00'),
(864, 220, 'EspÃ©cie de "Bicho do pÃ©" muito comum em areia de praia', '2018-06-25 13:56:57', '0000-00-00 00:00:00'),
(865, 220, 'DistraÃ­do', '2018-06-25 13:56:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(5) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_admin`
--

INSERT INTO `user_admin` (`id`, `user`, `password`, `created_at`) VALUES
(26, 'trezo', '2018', '0000-00-00 00:00:00'),
(31, 'dirceulh@hotmail.com', '12345', '2018-06-25 17:49:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_user`
--
ALTER TABLE `answer_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer_user_id`
--
ALTER TABLE `answer_user_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_ibfk_1` (`answer_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_user`
--
ALTER TABLE `answer_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `answer_user_id`
--
ALTER TABLE `answer_user_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=866;
--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
