-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 mars 2025 à 18:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `atlantik`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `IDENTIFIANT` varchar(40) NOT NULL,
  `MOTDEPASSE` varchar(60) NOT NULL,
  `PROFIL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `NOBATEAU` int(11) NOT NULL,
  `NOM` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`NOBATEAU`, `NOM`) VALUES
(1, 'Kor’ Ant'),
(2, 'Ar Solen'),
(3, 'Al’xi'),
(4, 'Luce isle'),
(5, 'Maëllys'),
(21, 'Bonjour'),
(22, 'Petit');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `LETTRECATEGORIE` char(1) NOT NULL,
  `LIBELLE` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`LETTRECATEGORIE`, `LIBELLE`) VALUES
('A', 'Passager'),
('B', 'Véh.inf.2m'),
('C', 'Véh.sup.2m');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `NOCLIENT` int(11) NOT NULL,
  `NOM` varchar(60) NOT NULL,
  `PRENOM` varchar(60) NOT NULL,
  `ADRESSE` varchar(128) NOT NULL,
  `CODEPOSTAL` int(11) NOT NULL,
  `VILLE` varchar(80) NOT NULL,
  `TELEPHONEFIXE` varchar(16) DEFAULT NULL,
  `TELEPHONEMOBILE` varchar(16) DEFAULT NULL,
  `MEL` varchar(80) DEFAULT NULL,
  `MOTDEPASSE` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`NOCLIENT`, `NOM`, `PRENOM`, `ADRESSE`, `CODEPOSTAL`, `VILLE`, `TELEPHONEFIXE`, `TELEPHONEMOBILE`, `MEL`, `MOTDEPASSE`) VALUES
(1, 'TIPREZ', 'Yann', '15 rue de l\'industrie', 19290, 'PEYRELEVADE', '02.96.10.10.10', '06.96.10.10.10', 'tiprez@rabelais.fr', '$argon2i$v=19$m=65536,t=4,p=1$a0ZyUWVQbHNBSXVORHJlaA$D9BPfz30uma3u97Z3VkrXZPkIWmBgysxEofteqtjx3U'),
(2, 'WISSER', 'Titouan', 'Le Grand Champ', 22120, 'Hillion', '0636936372', '0617486176', 'titouanwisser@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$OVY1aVlLSzQ2TEpudm1RUg$2V8wZl9F0rEGV+eFiLA1PV4sZVJxtJjRDaKxBsLH7aU'),
(4, 'Toto', 'Toto', 'Mars', 27000, 'Mars', NULL, NULL, 'toto@rabelais.fr', '$argon2i$v=19$m=65536,t=4,p=1$M3Z3cm1OMzFsSnJzMEhvMQ$q9Kbm7qS4JEkmvFUW6lLMye6oYjUOKrnvD7cE+QmLmw'),
(5, 'Rabelais', 'François', '8 Rue Rabelais', 22022, 'Saint-Brieuc', '7777777777', '', 'rabelais@rabelais.fr', '$argon2i$v=19$m=65536,t=4,p=1$YUp3cXF2LkF4elhqNDNySw$sjx2+oAN2B1QtCvyxMQIKZ9BmaRzwUzOj6/O+l6B5rI');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `LETTRECATEGORIE` char(1) NOT NULL,
  `NOBATEAU` int(11) NOT NULL,
  `CAPACITEMAX` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`LETTRECATEGORIE`, `NOBATEAU`, `CAPACITEMAX`) VALUES
('A', 1, 100),
('A', 2, 200),
('A', 3, 300),
('A', 4, 400),
('A', 5, 500),
('A', 22, 10),
('B', 1, 10),
('B', 2, 20),
('B', 3, 30),
('B', 4, 40),
('B', 5, 50),
('B', 22, 45),
('C', 1, 1),
('C', 2, 2),
('C', 3, 3),
('C', 4, 4),
('C', 5, 5),
('C', 22, 20);

-- --------------------------------------------------------

--
-- Structure de la table `enregistrer`
--

CREATE TABLE `enregistrer` (
  `NORESERVATION` int(11) NOT NULL,
  `LETTRECATEGORIE` char(1) NOT NULL,
  `NOTYPE` smallint(6) NOT NULL,
  `QUANTITERESERVEE` int(11) NOT NULL,
  `QUANTITEEMBARQUEE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enregistrer`
--

INSERT INTO `enregistrer` (`NORESERVATION`, `LETTRECATEGORIE`, `NOTYPE`, `QUANTITERESERVEE`, `QUANTITEEMBARQUEE`) VALUES
(1, 'A', 1, 2, 0),
(1, 'A', 2, 1, 0),
(1, 'A', 3, 2, 0),
(1, 'B', 2, 1, 0),
(9, 'A', 1, 2, 0),
(9, 'A', 2, 1, 0),
(9, 'A', 3, 2, 0),
(9, 'B', 1, 1, 0),
(39, 'A', 1, 2, 0),
(39, 'A', 2, 4, 0),
(39, 'A', 3, 2, 0),
(39, 'B', 2, 2, 0),
(40, 'B', 1, 3, 0),
(41, 'B', 1, 3, 0),
(42, 'B', 1, 3, 0),
(43, 'B', 2, 2, 0),
(44, 'A', 2, 1, 0),
(45, 'A', 3, 2, 0),
(46, 'A', 3, 2, 0),
(47, 'A', 3, 2, 0),
(48, 'A', 3, 2, 0),
(49, 'A', 3, 2, 0),
(50, 'A', 3, 2, 0),
(51, 'A', 3, 2, 0),
(52, 'A', 1, 2, 0),
(52, 'A', 2, 2, 0),
(52, 'A', 3, 2, 0),
(52, 'B', 1, 2, 0),
(52, 'B', 2, 2, 0),
(52, 'C', 2, 1, 0),
(53, 'A', 1, 1, 0),
(54, 'A', 1, 1, 0),
(55, 'A', 1, 1, 0),
(56, 'A', 1, 1, 0),
(57, 'A', 1, 1, 0),
(58, 'A', 1, 1, 0),
(59, 'A', 1, 2, 0),
(60, 'A', 1, 2, 0),
(61, 'A', 1, 2, 0),
(62, 'A', 1, 2, 0),
(63, 'A', 3, 1, 0),
(64, 'A', 3, 1, 0),
(65, 'A', 3, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `liaison`
--

CREATE TABLE `liaison` (
  `NOLIAISON` int(11) NOT NULL,
  `NOPORT_DEPART` int(11) NOT NULL,
  `NOSECTEUR` int(11) NOT NULL,
  `NOPORT_ARRIVEE` int(11) NOT NULL,
  `DISTANCE` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liaison`
--

INSERT INTO `liaison` (`NOLIAISON`, `NOPORT_DEPART`, `NOSECTEUR`, `NOPORT_ARRIVEE`, `DISTANCE`) VALUES
(1, 1, 3, 2, 8.30),
(2, 2, 3, 1, 9.00),
(3, 1, 3, 3, 8.00),
(4, 3, 3, 1, 7.90),
(5, 6, 6, 7, 7.70),
(6, 7, 6, 6, 7.40),
(9, 9, 3, 3, 50.00),
(10, 9, 1, 6, 15.00),
(11, 6, 1, 5, 20.00),
(12, 2, 1, 4, 45.00);

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `NOIDENTIFIANT` smallint(6) NOT NULL,
  `SITE_PB` varchar(20) DEFAULT NULL,
  `RANG_PB` varchar(128) DEFAULT NULL,
  `IDENTIFIANT_PB` varchar(20) DEFAULT NULL,
  `CLEHMAC_PB` varchar(255) DEFAULT NULL,
  `ENPRODUCTION` tinyint(1) DEFAULT NULL,
  `MELSITE` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`NOIDENTIFIANT`, `SITE_PB`, `RANG_PB`, `IDENTIFIANT_PB`, `CLEHMAC_PB`, `ENPRODUCTION`, `MELSITE`) VALUES
(1, '164994', 'aBhjdzLKxzSJid78dzljSè_', '44579534619', '164795499555495757', 1, 'atlantik@armor.fr');

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `NORESERVATION` int(11) NOT NULL,
  `NUMERO` smallint(6) NOT NULL,
  `LETTRECATEGORIE` char(1) NOT NULL,
  `NOTYPE` smallint(6) NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `PRENOM` varchar(50) NOT NULL,
  `DATENAISSANCE` date NOT NULL,
  `EMBARQUE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE `periode` (
  `NOPERIODE` smallint(6) NOT NULL,
  `DATEDEBUT` date NOT NULL,
  `DATEFIN` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`NOPERIODE`, `DATEDEBUT`, `DATEFIN`) VALUES
(1, '2025-01-01', '2025-02-01'),
(2, '2025-02-02', '2025-06-15'),
(3, '2026-06-16', '2026-09-15'),
(4, '2026-09-16', '2026-05-31');

-- --------------------------------------------------------

--
-- Structure de la table `port`
--

CREATE TABLE `port` (
  `NOPORT` int(11) NOT NULL,
  `NOM` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `port`
--

INSERT INTO `port` (`NOPORT`, `NOM`) VALUES
(1, 'Quiberon'),
(2, 'Le Palais'),
(3, 'Sauzon'),
(4, 'Vannes'),
(5, 'Port St Gildas'),
(6, 'Lorient'),
(7, 'Port-Tudy'),
(9, 'Rabelais');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `NORESERVATION` int(11) NOT NULL,
  `NOTRAVERSEE` int(11) NOT NULL,
  `NOCLIENT` int(11) NOT NULL,
  `DATEHEURE` datetime NOT NULL,
  `MONTANTTOTAL` double NOT NULL,
  `PAYE` tinyint(1) NOT NULL,
  `MODEREGLEMENT` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`NORESERVATION`, `NOTRAVERSEE`, `NOCLIENT`, `DATEHEURE`, `MONTANTTOTAL`, `PAYE`, `MODEREGLEMENT`) VALUES
(1, 1, 1, '2021-04-28 19:20:00', 209.1, 1, 'CB'),
(9, 14, 2, '2025-03-02 22:58:22', 380, 1, 'CB'),
(11, 14, 2, '2025-03-02 23:02:21', 1700, 1, 'CB'),
(39, 14, 2, '2025-03-03 11:13:47', 660, 1, 'CB'),
(40, 14, 2, '2025-03-03 12:38:40', 240, 1, 'CB'),
(41, 14, 2, '2025-03-03 12:39:33', 240, 1, 'ESPECES'),
(42, 14, 2, '2025-03-03 12:40:10', 240, 1, 'CB'),
(43, 14, 2, '2025-03-03 13:37:54', 180, 0, 'ESPECES'),
(44, 14, 4, '2025-03-03 13:42:07', 60, 0, 'ESPECES'),
(45, 14, 2, '2025-03-04 12:41:35', 140, 0, 'ESPECES'),
(46, 14, 2, '2025-03-04 12:42:46', 140, 0, 'ESPECES'),
(47, 14, 2, '2025-03-04 12:50:01', 140, 0, 'ESPECES'),
(48, 14, 2, '2025-03-04 12:50:09', 140, 0, 'ESPECES'),
(49, 14, 2, '2025-03-04 12:51:11', 140, 0, 'ESPECES'),
(50, 14, 2, '2025-03-04 13:34:04', 140, 0, 'ESPECES'),
(51, 14, 2, '2025-03-04 13:43:46', 140, 0, 'ESPECES'),
(52, 14, 5, '2025-03-04 14:04:29', 810, 0, 'ESPECES'),
(53, 14, 2, '2025-03-04 15:48:46', 50, 0, 'ESPECES'),
(54, 14, 2, '2025-03-04 15:49:02', 50, 0, 'ESPECES'),
(55, 14, 2, '2025-03-04 15:49:16', 50, 0, 'ESPECES'),
(56, 14, 2, '2025-03-04 16:02:23', 50, 0, 'ESPECES'),
(57, 14, 2, '2025-03-04 16:02:39', 50, 0, 'ESPECES'),
(58, 14, 2, '2025-03-04 16:03:55', 50, 0, 'ESPECES'),
(59, 14, 2, '2025-03-04 21:28:06', 100, 0, 'ESPECES'),
(60, 14, 2, '2025-03-04 21:32:46', 100, 0, 'ESPECES'),
(61, 14, 2, '2025-03-04 21:34:44', 100, 0, 'ESPECES'),
(62, 14, 2, '2025-03-04 21:47:51', 100, 0, 'ESPECES'),
(63, 14, 2, '2025-03-04 21:54:25', 70, 0, 'ESPECES'),
(64, 14, 2, '2025-03-04 21:55:19', 70, 0, 'ESPECES'),
(65, 14, 2, '2025-03-04 22:01:39', 70, 0, 'ESPECES');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `NOSECTEUR` int(11) NOT NULL,
  `NOM` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`NOSECTEUR`, `NOM`) VALUES
(1, 'Aix'),
(2, 'Batz'),
(3, 'Belle-Ile-en-Mer'),
(4, 'Bréhat'),
(5, 'Houat'),
(6, 'Ile de Groix'),
(7, 'Molène'),
(8, 'Ouessant'),
(9, 'Sein'),
(10, 'Yeu'),
(15, 'bidon'),
(16, 'Secteur');

-- --------------------------------------------------------

--
-- Structure de la table `tarifer`
--

CREATE TABLE `tarifer` (
  `NOPERIODE` smallint(6) NOT NULL,
  `LETTRECATEGORIE` char(1) NOT NULL,
  `NOTYPE` smallint(6) NOT NULL,
  `NOLIAISON` int(11) NOT NULL,
  `TARIF` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tarifer`
--

INSERT INTO `tarifer` (`NOPERIODE`, `LETTRECATEGORIE`, `NOTYPE`, `NOLIAISON`, `TARIF`) VALUES
(1, 'A', 1, 1, 17.00),
(1, 'A', 1, 5, 21.50),
(1, 'A', 1, 6, 21.50),
(1, 'A', 2, 1, 10.10),
(1, 'A', 2, 5, 19.80),
(1, 'A', 2, 6, 19.80),
(1, 'A', 3, 1, 4.60),
(1, 'A', 3, 5, 13.20),
(1, 'A', 3, 6, 13.20),
(1, 'B', 1, 1, 76.00),
(1, 'B', 1, 5, 69.00),
(1, 'B', 1, 6, 69.00),
(1, 'B', 2, 1, 119.00),
(1, 'B', 2, 5, 119.00),
(1, 'B', 2, 6, 119.00),
(1, 'C', 1, 1, 179.00),
(1, 'C', 1, 5, 154.00),
(1, 'C', 1, 6, 154.00),
(1, 'C', 2, 1, 195.00),
(1, 'C', 2, 5, 199.00),
(1, 'C', 2, 6, 199.00),
(1, 'C', 3, 1, 258.00),
(1, 'C', 3, 5, 249.00),
(1, 'C', 3, 6, 249.00),
(2, 'A', 1, 1, 18.00),
(2, 'A', 1, 4, 700.00),
(2, 'A', 1, 6, 29.50),
(2, 'A', 1, 10, 50.00),
(2, 'A', 1, 11, 85.00),
(2, 'A', 1, 12, 75.00),
(2, 'A', 2, 1, 11.10),
(2, 'A', 2, 4, 700.00),
(2, 'A', 2, 6, 23.80),
(2, 'A', 2, 10, 60.00),
(2, 'A', 2, 11, 85.00),
(2, 'A', 2, 12, 75.00),
(2, 'A', 3, 1, 5.60),
(2, 'A', 3, 4, 700.00),
(2, 'A', 3, 6, 17.20),
(2, 'A', 3, 10, 70.00),
(2, 'A', 3, 11, 85.00),
(2, 'A', 3, 12, 75.00),
(2, 'B', 1, 1, 86.00),
(2, 'B', 1, 4, 700.00),
(2, 'B', 1, 6, 76.00),
(2, 'B', 1, 10, 80.00),
(2, 'B', 1, 11, 85.00),
(2, 'B', 1, 12, 75.00),
(2, 'B', 2, 1, 129.00),
(2, 'B', 2, 4, 700.00),
(2, 'B', 2, 6, 129.00),
(2, 'B', 2, 10, 90.00),
(2, 'B', 2, 11, 85.00),
(2, 'B', 2, 12, 75.00),
(2, 'C', 1, 1, 189.00),
(2, 'C', 1, 4, 700.00),
(2, 'C', 1, 6, 169.00),
(2, 'C', 1, 10, 100.00),
(2, 'C', 1, 11, 85.00),
(2, 'C', 1, 12, 75.00),
(2, 'C', 2, 1, 205.00),
(2, 'C', 2, 4, 900.00),
(2, 'C', 2, 6, 215.00),
(2, 'C', 2, 10, 110.00),
(2, 'C', 2, 12, 75.00),
(2, 'C', 3, 1, 268.00),
(2, 'C', 3, 4, 900.00),
(2, 'C', 3, 6, 275.99),
(2, 'C', 3, 10, 120.00),
(2, 'C', 3, 12, 75.00),
(3, 'A', 1, 1, 20.00),
(3, 'A', 1, 9, 9.00),
(3, 'A', 1, 10, 10.00),
(3, 'A', 2, 1, 13.10),
(3, 'A', 2, 9, 9.00),
(3, 'A', 2, 10, 10.00),
(3, 'A', 3, 1, 7.00),
(3, 'A', 3, 9, 9.00),
(3, 'A', 3, 10, 10.00),
(3, 'B', 1, 1, 95.00),
(3, 'B', 1, 9, 9.00),
(3, 'B', 1, 10, 10.00),
(3, 'B', 2, 1, 142.00),
(3, 'B', 2, 9, 9.00),
(3, 'B', 2, 10, 10.00),
(3, 'C', 1, 1, 208.00),
(3, 'C', 1, 9, 9.00),
(3, 'C', 1, 10, 10.00),
(3, 'C', 2, 1, 226.00),
(3, 'C', 2, 9, 9.00),
(3, 'C', 2, 10, 10.00),
(3, 'C', 3, 1, 295.00),
(3, 'C', 3, 9, 9.00),
(3, 'C', 3, 10, 10.00),
(4, 'A', 1, 1, 19.00),
(4, 'A', 2, 1, 12.10),
(4, 'A', 3, 1, 6.40),
(4, 'B', 1, 1, 91.00),
(4, 'B', 2, 1, 136.00),
(4, 'C', 1, 1, 199.00),
(4, 'C', 2, 1, 216.00),
(4, 'C', 3, 1, 282.00);

-- --------------------------------------------------------

--
-- Structure de la table `traversee`
--

CREATE TABLE `traversee` (
  `NOTRAVERSEE` int(11) NOT NULL,
  `NOLIAISON` int(11) NOT NULL,
  `NOBATEAU` int(11) NOT NULL,
  `DATEHEUREDEPART` datetime NOT NULL,
  `DATEHEUREARRIVEE` datetime NOT NULL,
  `CLOTUREEMBARQUEMENT` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `traversee`
--

INSERT INTO `traversee` (`NOTRAVERSEE`, `NOLIAISON`, `NOBATEAU`, `DATEHEUREDEPART`, `DATEHEUREARRIVEE`, `CLOTUREEMBARQUEMENT`) VALUES
(1, 1, 1, '2021-07-10 07:45:00', '2021-07-10 09:00:00', 0),
(2, 1, 2, '2021-07-10 09:45:00', '2021-07-10 11:00:00', 0),
(3, 1, 3, '2021-07-10 11:45:00', '2021-07-10 13:00:00', 0),
(4, 1, 4, '2021-07-10 13:45:00', '2021-07-10 15:00:00', 0),
(5, 1, 1, '2021-07-10 15:45:00', '2021-07-10 17:00:00', 0),
(6, 1, 2, '2021-07-10 17:45:00', '2021-07-10 19:00:00', 0),
(10, 1, 4, '2025-01-17 14:32:10', '2025-01-19 14:32:10', 0),
(11, 1, 4, '2025-05-15 11:38:57', '2025-05-17 11:38:57', 0),
(12, 5, 5, '2025-03-11 15:00:00', '2025-03-11 19:00:00', 0),
(13, 5, 5, '2025-02-25 13:38:46', '2025-02-25 13:38:46', 0),
(14, 10, 4, '2025-02-28 13:51:41', '2025-02-28 13:51:41', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `LETTRECATEGORIE` char(1) NOT NULL,
  `NOTYPE` smallint(6) NOT NULL,
  `LIBELLE` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`LETTRECATEGORIE`, `NOTYPE`, `LIBELLE`) VALUES
('A', 1, 'Adulte'),
('A', 2, 'Junior 8 à 18 ans'),
('A', 3, 'Enfant 0 à 7 ans'),
('B', 1, 'Voiture long.inf.4m'),
('B', 2, 'Voiture long.inf.5m'),
('C', 1, 'Fourgon'),
('C', 2, 'Camping Car'),
('C', 3, 'Camion');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `NORESERVATION` int(11) NOT NULL,
  `IMMATRICULATION` varchar(15) NOT NULL,
  `LETTRECATEGORIE` char(1) NOT NULL,
  `NOTYPE` smallint(6) NOT NULL,
  `EMBARQUE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`IDENTIFIANT`);

--
-- Index pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD PRIMARY KEY (`NOBATEAU`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`LETTRECATEGORIE`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`NOCLIENT`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`LETTRECATEGORIE`,`NOBATEAU`),
  ADD KEY `I_FK_CONTENIR_CATEGORIE` (`LETTRECATEGORIE`),
  ADD KEY `I_FK_CONTENIR_BATEAU` (`NOBATEAU`);

--
-- Index pour la table `enregistrer`
--
ALTER TABLE `enregistrer`
  ADD PRIMARY KEY (`NORESERVATION`,`LETTRECATEGORIE`,`NOTYPE`),
  ADD KEY `I_FK_ENREGISTRER_RESERVATION` (`NORESERVATION`),
  ADD KEY `I_FK_ENREGISTRER_TYPE` (`LETTRECATEGORIE`,`NOTYPE`);

--
-- Index pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD PRIMARY KEY (`NOLIAISON`),
  ADD KEY `I_FK_LIAISON_PORT_DEPART` (`NOPORT_DEPART`),
  ADD KEY `I_FK_LIAISON_SECTEUR` (`NOSECTEUR`),
  ADD KEY `I_FK_LIAISON_PORT_ARRIVEE` (`NOPORT_ARRIVEE`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`NOIDENTIFIANT`);

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`NORESERVATION`,`NUMERO`),
  ADD KEY `I_FK_PASSAGER_TYPE` (`LETTRECATEGORIE`,`NOTYPE`),
  ADD KEY `I_FK_PASSAGER_RESERVATION` (`NORESERVATION`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`NOPERIODE`);

--
-- Index pour la table `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`NOPORT`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`NORESERVATION`),
  ADD KEY `I_FK_RESERVATION_TRAVERSEE` (`NOTRAVERSEE`),
  ADD KEY `I_FK_RESERVATION_CLIENT` (`NOCLIENT`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`NOSECTEUR`);

--
-- Index pour la table `tarifer`
--
ALTER TABLE `tarifer`
  ADD PRIMARY KEY (`NOPERIODE`,`LETTRECATEGORIE`,`NOTYPE`,`NOLIAISON`),
  ADD KEY `I_FK_TARIFER_PERIODE` (`NOPERIODE`),
  ADD KEY `I_FK_TARIFER_TYPE` (`LETTRECATEGORIE`,`NOTYPE`),
  ADD KEY `I_FK_TARIFER_LIAISON` (`NOLIAISON`);

--
-- Index pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD PRIMARY KEY (`NOTRAVERSEE`),
  ADD KEY `I_FK_TRAVERSEE_LIAISON` (`NOLIAISON`),
  ADD KEY `I_FK_TRAVERSEE_BATEAU` (`NOBATEAU`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`LETTRECATEGORIE`,`NOTYPE`),
  ADD KEY `I_FK_TYPE_CATEGORIE` (`LETTRECATEGORIE`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`NORESERVATION`,`IMMATRICULATION`),
  ADD KEY `I_FK_VEHICULE_TYPE` (`LETTRECATEGORIE`,`NOTYPE`),
  ADD KEY `I_FK_VEHICULE_RESERVATION` (`NORESERVATION`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bateau`
--
ALTER TABLE `bateau`
  MODIFY `NOBATEAU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `NOCLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `liaison`
--
ALTER TABLE `liaison`
  MODIFY `NOLIAISON` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `port`
--
ALTER TABLE `port`
  MODIFY `NOPORT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `NORESERVATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `NOSECTEUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `traversee`
--
ALTER TABLE `traversee`
  MODIFY `NOTRAVERSEE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR_BATEAU` FOREIGN KEY (`NOBATEAU`) REFERENCES `bateau` (`NOBATEAU`),
  ADD CONSTRAINT `FK_CONTENIR_CATEGORIE` FOREIGN KEY (`LETTRECATEGORIE`) REFERENCES `categorie` (`LETTRECATEGORIE`);

--
-- Contraintes pour la table `enregistrer`
--
ALTER TABLE `enregistrer`
  ADD CONSTRAINT `FK_ENREGISTRER_RESERVATION` FOREIGN KEY (`NORESERVATION`) REFERENCES `reservation` (`NORESERVATION`),
  ADD CONSTRAINT `FK_ENREGISTRER_TYPE` FOREIGN KEY (`LETTRECATEGORIE`,`NOTYPE`) REFERENCES `type` (`LETTRECATEGORIE`, `NOTYPE`);

--
-- Contraintes pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD CONSTRAINT `FK_LIAISON_PORT_ARRIVEE` FOREIGN KEY (`NOPORT_ARRIVEE`) REFERENCES `port` (`NOPORT`),
  ADD CONSTRAINT `FK_LIAISON_PORT_DEPART` FOREIGN KEY (`NOPORT_DEPART`) REFERENCES `port` (`NOPORT`),
  ADD CONSTRAINT `FK_LIAISON_SECTEUR` FOREIGN KEY (`NOSECTEUR`) REFERENCES `secteur` (`NOSECTEUR`);

--
-- Contraintes pour la table `passager`
--
ALTER TABLE `passager`
  ADD CONSTRAINT `FK_PASSAGER_RESERVATION` FOREIGN KEY (`NORESERVATION`) REFERENCES `reservation` (`NORESERVATION`),
  ADD CONSTRAINT `FK_PASSAGER_TYPE` FOREIGN KEY (`LETTRECATEGORIE`,`NOTYPE`) REFERENCES `type` (`LETTRECATEGORIE`, `NOTYPE`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_RESERVATION_CLIENT` FOREIGN KEY (`NOCLIENT`) REFERENCES `client` (`NOCLIENT`),
  ADD CONSTRAINT `FK_RESERVATION_TRAVERSEE` FOREIGN KEY (`NOTRAVERSEE`) REFERENCES `traversee` (`NOTRAVERSEE`);

--
-- Contraintes pour la table `tarifer`
--
ALTER TABLE `tarifer`
  ADD CONSTRAINT `FK_TARIFER_LIAISON` FOREIGN KEY (`NOLIAISON`) REFERENCES `liaison` (`NOLIAISON`),
  ADD CONSTRAINT `FK_TARIFER_PERIODE` FOREIGN KEY (`NOPERIODE`) REFERENCES `periode` (`NOPERIODE`),
  ADD CONSTRAINT `FK_TARIFER_TYPE` FOREIGN KEY (`LETTRECATEGORIE`,`NOTYPE`) REFERENCES `type` (`LETTRECATEGORIE`, `NOTYPE`);

--
-- Contraintes pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD CONSTRAINT `FK_TRAVERSEE_BATEAU` FOREIGN KEY (`NOBATEAU`) REFERENCES `bateau` (`NOBATEAU`),
  ADD CONSTRAINT `FK_TRAVERSEE_LIAISON` FOREIGN KEY (`NOLIAISON`) REFERENCES `liaison` (`NOLIAISON`);

--
-- Contraintes pour la table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `FK_TYPE_CATEGORIE` FOREIGN KEY (`LETTRECATEGORIE`) REFERENCES `categorie` (`LETTRECATEGORIE`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `FK_VEHICULE_RESERVATION` FOREIGN KEY (`NORESERVATION`) REFERENCES `reservation` (`NORESERVATION`),
  ADD CONSTRAINT `FK_VEHICULE_TYPE` FOREIGN KEY (`LETTRECATEGORIE`,`NOTYPE`) REFERENCES `type` (`LETTRECATEGORIE`, `NOTYPE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
