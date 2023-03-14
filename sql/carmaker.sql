-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.info.unicaen.fr:3306
-- Généré le : lun. 28 nov. 2022 à 13:21
-- Version du serveur :  10.5.11-MariaDB-1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `22003660_0`
--

-- --------------------------------------------------------

--
-- Structure de la table `carmaker`
--

CREATE TABLE `carmaker` (
  `id` int(11) NOT NULL,
  `constructeur` varchar(255) DEFAULT NULL,
  `championship` varchar(255) DEFAULT NULL,
  `win` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `carmaker`
--

INSERT INTO `carmaker` (`id`, `constructeur`, `championship`, `win`) VALUES
(1, 'Ferrari', 'F1', 15),
(2, 'Mercedes', 'F1', 10),
(3, 'Renault', 'F1', 2),
(6, '&lt;script&gt;alert(', 'ecz', 99),
(8, 'Lamborghini', 'GT3', 7),
(11, 'Haas', 'F1', 0),
(12, '&lt;script&gt;alert(\'coucou\')&lt;/script&gt;', 'ecz', 9),
(13, 'Porsche', '24h du Mans', 19),
(14, 'Aston Martin', 'F1', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `carmaker`
--
ALTER TABLE `carmaker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `carmaker`
--
ALTER TABLE `carmaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
