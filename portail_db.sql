-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 12 juin 2021 à 11:45
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portail_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `certificats`
--

CREATE TABLE `certificats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL,
  `titrec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentairec` text COLLATE utf8mb4_unicode_ci,
  `villec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debutc` date DEFAULT NULL,
  `finc` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `certificats`
--

INSERT INTO `certificats` (`id`, `cv_id`, `titrec`, `commentairec`, `villec`, `debutc`, `finc`, `created_at`, `updated_at`) VALUES
(44, 47, 'Cisco Networking Basics specialization', 'five course specialization focused on how computer networks work.\ncourse 1 : Internet Connection: How to Get Online?\ncourse 2 : Network Protocols and Architecture\ncourse 3 : Data Communications and Network Services\ncourse 4 : Home Networking Basics\ncourse 5 : Introduction to Cisco Networking', 'Coursera', '2021-05-31', '2021-07-07', '2021-06-02 21:33:45', '2021-06-02 21:33:45'),
(46, 47, 'mlkmlerk', 'mlkmler', 'mlùemr', '2021-06-23', '2021-06-16', '2021-06-03 08:46:18', '2021-06-03 08:46:18'),
(47, 54, 'title 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Organization name', '2021-07-05', '2021-07-30', '2021-06-03 18:36:19', '2021-06-03 18:36:19'),
(48, 56, 'titre', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'test', '2021-05-31', '2021-06-30', '2021-06-06 12:55:01', '2021-06-06 12:55:01'),
(49, 56, 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'test', '2021-06-02', '2021-06-23', '2021-06-06 12:55:53', '2021-06-06 12:55:53'),
(50, 56, 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'test', '2021-06-02', '2021-06-23', '2021-06-06 12:55:56', '2021-06-06 12:55:56');

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id`, `cv_id`, `commentaire`, `created_at`, `updated_at`) VALUES
(65, 47, 'WEB DEVE\nHTML5, CSS3, PHP, JavaScript, MySQL, Laravel, Vue JS, Bootstrap', '2021-06-02 21:30:14', '2021-06-03 08:48:28'),
(68, 54, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2021-06-03 18:36:25', '2021-06-03 18:36:25'),
(69, 56, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2021-06-06 12:56:06', '2021-06-06 12:56:06'),
(70, 56, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2021-06-06 12:56:08', '2021-06-06 12:56:08'),
(71, 56, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2021-06-06 12:56:09', '2021-06-06 12:56:09'),
(72, 56, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2021-06-06 12:56:11', '2021-06-06 12:56:11');

-- --------------------------------------------------------

--
-- Structure de la table `condidats`
--

CREATE TABLE `condidats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_recrutement` int(11) NOT NULL,
  `id_ingenieur` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commentaire` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_entreprise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom_entreprise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id`, `commentaire`, `id_entreprise`, `created_at`, `updated_at`, `nom_entreprise`) VALUES
(17, 'Hi,\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '52', '2021-06-03 18:23:27', '2021-06-03 18:23:27', 'oracle');

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `experiences`
--

INSERT INTO `experiences` (`id`, `cv_id`, `titre`, `commentaire`, `ville`, `debut`, `fin`, `created_at`, `updated_at`) VALUES
(174, 54, 'Title 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Company name', '2021-05-31', '2021-07-11', '2021-06-03 18:35:05', '2021-06-03 18:35:05'),
(175, 56, 'titre 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'test', '2021-05-31', '2021-06-30', '2021-06-06 12:52:44', '2021-06-06 12:52:44'),
(163, 47, 'Tweets Classification', 'Binary Classification for tweets (Politics or Sports) using Machine Learning and Deep Learing models.\nkeywords : Deep Lerning, Keras, Machine Learning, MultinomialNB, Logistic, Dataframe, Pandas, Numpy, prediction ...', 'INPT', '2021-06-28', '2021-07-01', '2021-06-02 21:31:30', '2021-06-02 21:31:30'),
(176, 56, 'titre 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'test 2', '2021-05-31', '2021-06-23', '2021-06-06 12:53:04', '2021-06-06 12:53:04');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL,
  `titref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentairef` text COLLATE utf8mb4_unicode_ci,
  `villef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debutf` date DEFAULT NULL,
  `finf` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `cv_id`, `titref`, `commentairef`, `villef`, `debutf`, `finf`, `created_at`, `updated_at`) VALUES
(46, 47, 'lskdmlkd', 'mlkmlekr', 'ùmlùmler', NULL, NULL, '2021-06-03 08:53:29', '2021-06-03 08:53:29'),
(47, 54, 'title 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'School name', '2021-05-31', '2021-07-11', '2021-06-03 18:35:47', '2021-06-03 18:35:47'),
(48, 56, 'titre 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'test 1', '2021-06-29', '2021-06-30', '2021-06-06 12:53:40', '2021-06-06 12:53:40'),
(49, 56, 'titre 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'test 2', '2021-06-10', '2021-06-30', '2021-06-06 12:54:19', '2021-06-06 12:54:19');

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL,
  `langue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recrutements`
--

CREATE TABLE `recrutements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_validation` timestamp NULL DEFAULT NULL,
  `post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom_entreprise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_condidats` json DEFAULT NULL,
  `duree_entretien` time DEFAULT NULL,
  `fin_entretien` int(2) DEFAULT NULL,
  `valide` int(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recrutements`
--

INSERT INTO `recrutements` (`id`, `date_validation`, `post`, `description`, `id_entreprise`, `created_at`, `updated_at`, `nom_entreprise`, `id_condidats`, `duree_entretien`, `fin_entretien`, `valide`) VALUES
(307, '2021-06-30 19:20:00', 'Telco Cloud', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 52, '2021-06-03 18:20:24', '2021-06-03 18:21:10', 'oracle', '[{\"id\": 46, \"age\": null, \"name\": \"nourddine\", \"post\": \"Ingenieur\", \"dispo\": 1, \"email\": \"nourddine.ait.massaoud@gmail.com\", \"image\": \"image/avatar.jpg\", \"tarif\": null, \"titre\": \"not defined\", \"adresse\": \"not defined\", \"telephone\": null, \"created_at\": \"2021-05-26 20:13:56\", \"updated_at\": \"2021-06-03 19:14:55\", \"add_to_cart\": 1, \"description\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s\", \"fin_entretien\": 0, \"valide_id_ent\": 52, \"date_entretien\": \"2021-06-18T20:17\", \"email_verified_at\": null, \"add_to_cart_id_ent\": 52}]', '01:25:00', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'image/avatar.jpg',
  `age` int(11) DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not defined',
  `telephone` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not defined',
  `add_to_cart` int(11) NOT NULL DEFAULT '0',
  `dispo` int(2) NOT NULL DEFAULT '1',
  `tarif` int(11) DEFAULT NULL,
  `add_to_cart_id_ent` int(11) DEFAULT NULL,
  `valide_id_ent` int(11) DEFAULT NULL,
  `date_entretien` datetime DEFAULT NULL,
  `fin_entretien` int(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `post`, `description`, `image`, `age`, `adresse`, `telephone`, `titre`, `add_to_cart`, `dispo`, `tarif`, `add_to_cart_id_ent`, `valide_id_ent`, `date_entretien`, `fin_entretien`) VALUES
(1, 'Digiwise recruitment', 'mezzine321@gmail.com', NULL, '$2y$10$WtfaUKOPbIfhxei.Cf5e4eJUZd2IOr8kNOixbdSytJcIZ3k4pUYCG', NULL, '2021-05-11 19:23:25', '2021-05-20 08:43:22', 'admin', 'Acteur national mais aussi régional (Afrique francophone), Digiwise ne cesse de s’affirmer sur un marché très concurrentiel comme un acteur', 'image/avatar.jpg', NULL, 'Rabat - Salé - Kénitra', '+212 690099637', 'position', 0, 1, 0, NULL, NULL, NULL, 0),
(56, 'ABDELLATIF MEZZINE', 'mezzine@gmail.com', NULL, '$2y$10$dzEKez8eEKe4sE/NcimiYu0DK.x3kWTaqCvjbdj2ZLMzt.ZKtrZRG', NULL, '2021-06-06 12:46:33', '2021-06-06 12:47:35', 'Ingenieur', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'image/AZdUCWu5uJXaYQhiQYyy2YRq3SJhHG1WBFUvP5tF.png', 23, 'HAY TOUGHZA AOURIR AGADIR', '+212690099637', 'MLOps', 0, 1, NULL, NULL, NULL, NULL, 0),
(57, 'Oracle communication', 'oracle@gmail.com', NULL, '$2y$10$08hmnf2ACYBsjcRzsf4.qOVpWRVMbJnD7s/VNHqS./LztlvuICOZe', NULL, '2021-06-06 12:57:05', '2021-06-06 12:57:05', 'Entreprise', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'image/avatar.jpg', NULL, 'not defined', '', 'not defined', 0, 1, NULL, NULL, NULL, NULL, 0),
(54, 'User', 'user1@gmail.com', NULL, '$2y$10$3yjyY0qoRXCkgveT.a7dm.76jAk5nUxetiU6dyB9buAvwvHcQo3ee', NULL, '2021-06-03 17:57:26', '2021-06-04 09:49:12', 'Ingenieur', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'image/avatar.jpg', NULL, 'not defined', '', 'not defined', 0, 1, NULL, 52, NULL, NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `certificats`
--
ALTER TABLE `certificats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formations_cv_id_foreign` (`cv_id`);

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competences_cv_id_foreign` (`cv_id`);

--
-- Index pour la table `condidats`
--
ALTER TABLE `condidats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_cv_id_foreign` (`cv_id`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formations_cv_id_foreign` (`cv_id`);

--
-- Index pour la table `recrutements`
--
ALTER TABLE `recrutements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `certificats`
--
ALTER TABLE `certificats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT pour la table `condidats`
--
ALTER TABLE `condidats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT pour la table `recrutements`
--
ALTER TABLE `recrutements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
