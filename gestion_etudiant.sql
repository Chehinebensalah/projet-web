-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 08 mai 2022 à 20:10
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_etudiant`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `dateAbs` date NOT NULL,
  `classe` varchar(11) NOT NULL,
  `module` varchar(11) NOT NULL,
  `typeAbs` varchar(25) NOT NULL,
  `nomEtd` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`dateAbs`, `classe`, `module`, `typeAbs`, `nomEtd`) VALUES
('2022-05-01', '', 'Tech.Web', 'Justifieé', 'aaaaa'),
('2022-05-19', '', 'Anl.Num', 'NoNJustifieé', 'AA'),
('2022-05-01', '1INFOC', 'Tech.Web', 'Justifieé', 'aa'),
('2022-05-01', 'aa CHEHINE', 'Tech.Web', 'Justifieé', ''),
('2022-05-24', 'CHEHINEaaaa', 'Tech.Web', 'NoNJustifieé', ''),
('2022-05-01', 'CHEHINEaaaa', 'Tech.Web', 'Justifieé', ''),
('2022-05-01', 'aa', 'Tech.Web', 'Justifieé', ''),
('2022-05-01', '1INFOA', 'Tech.Web', 'Justifieé', 'aa'),
('0000-00-00', '1INFOC', 'Stat', 'NoNJustifieé', 'BEN SALAH'),
('2022-05-01', '1INFOA', 'Tech.Web', 'Justifieé', 'aa'),
('2022-05-01', '1INFOA', 'Tech.Web', 'Justifieé', 'aa'),
('2022-05-01', '1INFOA', 'Tech.Web', 'Justifieé', 'aa'),
('2022-05-01', '1INFOA', 'Tech.Web', 'Justifieé', 'aa'),
('2022-05-01', '1INFOA', 'Tech.Web', 'Justifieé', 'aa'),
('2022-05-01', '1INFOA', 'Tech.Web', 'Justifieé', 'aa'),
('0000-00-00', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `name_classe` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`name_classe`) VALUES
('1.INFO.A'),
('1.INFO.E'),
('1.MECA.D'),
('1INFOA'),
('1INFOC'),
('2.GSIL.C'),
('2.MECA.C'),
('3.INFO.A'),
('3.MECA.A');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `date`, `nom`, `prenom`, `login`, `pass`) VALUES
(1, '2022-03-12 15:58:08', 'Saad', 'Walid', 'walid.saadd@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(2, '2022-05-05 21:52:41', 'chehine', 'chehine', 'chehine@gmail.com', 'c183d2410b9e02f6ea0f2a8b4e73e606'),
(3, '2022-05-06 21:10:34', 'hamza', 'kouki', 'hamza@hamza.com', '8ce87b8ec346ff4c80635f667d1592ae'),
(4, '2022-05-08 09:21:08', 'BEN SALAH', 'CHEHINE', 'bensalahchahine5@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `cin` int(8) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cpassword` varchar(40) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `Classe` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`cin`, `email`, `password`, `cpassword`, `nom`, `prenom`, `adresse`, `Classe`) VALUES
(11111113, 'chehine@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '8ce87b8ec346ff4c80635f667d1592ae', 'aaaa', 'hamza', 'tunis', 'INFO 1 E'),
(11111114, 'bensalahchahine5@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '8ce87b8ec346ff4c80635f667d1592ae', 'BEN SALAH', 'CHEHINE', 'BINZART', '1INFOA'),
(11111115, 'bensalahchahine5@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '8ce87b8ec346ff4c80635f667d1592ae', 'BEN SALAH', 'CHEHINE', 'BINZART', '1INFOC'),
(11111119, 'bensalahchahine5@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '8ce87b8ec346ff4c80635f667d1592ae', 'CHEHINEaaaaaaaaaaaaa', 'CHEHINEaaaaaaaaaaaaa', 'BINZART', '1INFOA'),
(11111121, 'bensalahchahine5@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '8ce87b8ec346ff4c80635f667d1592ae', 'chehine', 'CHEH', 'aaaaaa', '1INFOC'),
(11111131, 'bensalahchahine5@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '8ce87b8ec346ff4c80635f667d1592ae', 'CHEHINEaaaaaaaaaaaaa', 'CHEHINEaaaaaaaaaaaaa', 'BINZART', '1INFOC'),
(11111141, 'bensalahchahine5@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '8ce87b8ec346ff4c80635f667d1592ae', 'CHEHINEaaaaaaaaaaaaa', 'CHEHINEaaaaaaaaaaaaa', 'BINZART', '1INFOC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`name_classe`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`cin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
