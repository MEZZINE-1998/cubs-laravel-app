-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 06 oct. 2021 à 15:39
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
-- Base de données :  "cubs"
--

-- --------------------------------------------------------

--
-- Structure de la table "absences"
--

CREATE TABLE "absences" (
  "id" bigint(20) UNSIGNED NOT NULL,
  "date" timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  "absences" json DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table "absences"
--

INSERT INTO "absences" ("id", "date", "absences", "created_at", "updated_at") VALUES
(38, '2021-10-04 21:20:38', '[15]', '2021-10-04 20:20:38', '2021-10-04 20:20:38'),
(37, '2021-10-04 20:26:22', '[2]', '2021-10-04 19:26:22', '2021-10-04 19:26:22'),
(40, '2021-10-05 17:20:01', '[3]', '2021-10-05 16:20:01', '2021-10-05 16:20:01');

-- --------------------------------------------------------

--
-- Structure de la table "events"
--

CREATE TABLE "events" (
  "id" bigint(20) UNSIGNED NOT NULL,
  "title" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "startdate" datetime NOT NULL,
  "enddate" datetime NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  "categorie" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "description" varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "sexe" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "categorie_joueur" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "rencontre_joueur" int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table "events"
--

INSERT INTO "events" ("id", "title", "startdate", "enddate", "created_at", "updated_at", "categorie", "description", "sexe", "categorie_joueur", "rencontre_joueur") VALUES
(62, 'rer', '2021-10-09 17:05:00', '2021-10-10 17:05:00', '2021-10-05 15:05:08', '2021-10-05 15:05:08', 'Entrainement', 'ergzer', 'Femme', 'U10', 0),
(61, 'match 1', '2021-10-06 16:59:00', '2021-10-07 16:59:00', '2021-10-05 14:59:33', '2021-10-05 14:59:33', 'Match', 'description eioze dhzle zrvijzemv vzrv aerva', 'Femme', 'U8', 0),
(63, 'rencontre', '2021-10-14 17:13:00', '2021-10-15 17:13:00', '2021-10-05 15:13:57', '2021-10-05 15:13:57', 'Rencontre', 'rerer', 'x', 'x', 3);

-- --------------------------------------------------------

--
-- Structure de la table "migrations"
--

CREATE TABLE "migrations" (
  "id" int(10) UNSIGNED NOT NULL,
  "migration" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "batch" int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table "migrations"
--

INSERT INTO "migrations" ("id", "migration", "batch") VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_09_22_195209_create_events_table', 2),
(4, '2021_09_24_134446_create_absences_table', 3),
(5, '2021_09_25_094636_create_tests_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table "password_resets"
--

CREATE TABLE "password_resets" (
  "email" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "token" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table "tests"
--

CREATE TABLE "tests" (
  "id" bigint(20) UNSIGNED NOT NULL,
  "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "id_joueur" int(11) DEFAULT NULL,
  "test" json DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table "tests"
--

INSERT INTO "tests" ("id", "date", "id_joueur", "test", "created_at", "updated_at") VALUES
(47, '2021-10-04 20:59:47', 14, '{\"id_joueur\": 14, \"fou_critere\": {\"titre\": \"Qualités physiques\", \"sous_criteres\": [{\"notes\": [{\"note1\": \"0\", \"titre\": \"Motricité\", \"commentaire\": \"Tu dois poursuivre le travail de maîtrise des appuis et ta coordination œil/pied.\"}, {\"note1\": \"0\", \"titre\": \"Vivacité\", \"commentaire\": \"Moyen. Poursuis ton travail d\'appuis. Compléter par un travail de gainage que nous allons entreprendre.\"}, {\"note1\": \"0\", \"titre\": \"Vitesse\", \"commentaire\": \"Moyen. Tu dois compenser une vitesse moyenne par un très bon placement.\"}, {\"note1\": \"0\", \"titre\": \"Endurance\", \"commentaire\": \"J\'attends encore plus de toi dans la répétition des efforts donc ton volume de jeu.\"}, {\"note1\": \"0\", \"titre\": \"Puissance\", \"commentaire\": \"\"}, {\"note1\": \"0\", \"titre\": \"Souplesse\", \"commentaire\": \"\"}], \"titre\": \"Etat physique\"}]}, \"sec_critere\": {\"titre\": \"Habiletés Techniques\", \"sous_criteres\": [{\"notes\": [{\"note1\": \"0\", \"titre\": \"Position des épaules/jeu de corps\", \"commentaire\": \"Bonne utilisation de ton corps dans les différents aspects du jeu.\"}], \"titre\": \"Orientation du corps\"}, {\"notes\": [{\"note1\": \"0\", \"titre\": \"Jonglage\", \"commentaire\": \"Tes résultats au gonglage sont insuffisantes Tu peux les développer(pied faible et tête). J\'attends plus de toi\"}, {\"note1\": \"0\", \"titre\": \"Conduite de balle\", \"commentaire\": \"Tu dois améliorer les changements de direction et la vitesse d\'éxécution.\"}, {\"note1\": \"0\", \"titre\": \"Dribbles et feintes\", \"commentaire\": \"Correct en général. Tu doit penser à enrichir ton arsenal technique.\"}, {\"note1\": \"0\", \"titre\": \"Protection de Ballon\", \"commentaire\": \"Bon usage de ton corps obstacle. \"}, {\"note1\": \"0\", \"titre\": \"Première touche \", \"commentaire\": \"Bonne première touche qui te permet d\'enchaîner rapidement.\"}, {\"note1\": \"0\", \"titre\": \"Contrôles  orientés \", \"commentaire\": \"Tu as compris que le ballon devait rester en mouvement.\"}, {\"note1\": \"0\", \"titre\": \"Contrôles  aériens\", \"commentaire\": \"Peu utilisé. Mais cela le deviendra avec le jeu à 11 \"}], \"titre\": \"maitrise individuelle\"}, {\"notes\": [{\"note1\": \"0\", \"titre\": \"Passes courtes\", \"commentaire\": \"Bon niveau qui permet de construire nos actions depuis le GK. Continue de développer pied faible.\"}, {\"note1\": \"0\", \"titre\": \"Passes moyennes\", \"commentaire\": \"Bon niveau qui te permet d\'augmenter et élargir tes choix.Continue de travailler pied faible.\"}, {\"note1\": \"0\", \"titre\": \"Passes longues\", \"commentaire\": \"Peu exploité. Mais doit être travaillé.\"}, {\"note1\": \"0\", \"titre\": \"Centres\", \"commentaire\": \"\"}, {\"note1\": \"0\", \"titre\": \"Volée \", \"commentaire\": \"\"}, {\"note1\": \"0\", \"titre\": \"Tirs\", \"commentaire\": \"Bonne qualité de tirs, tu dois pouvoir trouver des situations de tirs lors des matchs\"}, {\"note1\": \"0\", \"titre\": \"Jeu de tête\", \"commentaire\": \"Peu utilisé.\"}, {\"note1\": \"0\", \"titre\": \"Pied Faible\", \"commentaire\": \"Tu dois encore travailler le pied faible.\"}], \"titre\": \"Technique de frappe\"}, {\"notes\": [{\"note1\": \"0\", \"titre\": \"1 c 1\", \"commentaire\": \"Bonne intelligence de jeu pour gagner les duels défensifs.\"}], \"titre\": \"Technique défensive\"}]}, \"thi_critere\": {\"titre\": \"Habiletés Tactiques\", \"sous_criteres\": [{\"notes\": [{\"note1\": \"0\", \"titre\": \"Vision de jeu \", \"commentaire\": \"Bonne Prise d\'information qui doit te permettre d\'élargir plus ton registre de jeu\"}, {\"note1\": \"0\", \"titre\": \"Créativité et prise d\'initiatives\", \"commentaire\": \"Ta prise d\'initiatives est bonne. J\'attends encore plus de toi.\"}, {\"note1\": \"0\", \"titre\": \"Placement\", \"commentaire\": \"Tu as bien compris le positionnement de ta zone de jeu.\"}, {\"note1\": \"0\", \"titre\": \"Déplacement\", \"commentaire\": \"J\'attends encore plus de toi dans la notion d\'aide au porteur.\"}], \"titre\": \"Implication dans le jeu offensif\"}, {\"notes\": [{\"note1\": \"0\", \"titre\": \"Attitude à la perte de balle\", \"commentaire\": \"Reste attentif aux transitions attaque/défense.\"}, {\"note1\": \"0\", \"titre\": \"Mise en pratique des principes de zone (cadrage, couverture, coulissage…)\", \"commentaire\": \"Tu as bien compris les grands principes d\'une défense en zone.En cours d\'acquisition.\"}, {\"note1\": \"0\", \"titre\": \"Anticipation\", \"commentaire\": \"En améliorant ta lecture de jeu, ton anticipation sera meilleure.\"}, {\"note1\": \"0\", \"titre\": \"Replacement\", \"commentaire\": \"J\'attends plus de toi à la perte de balle.\"}], \"titre\": \"Implication dans le jeu défensif\"}]}, \"first_critere\": {\"titre\": \"Qualités mentales\", \"sous_criteres\": [{\"notes\": [{\"note1\": \"0\", \"titre\": \"Confiance en soi \", \"commentaire\": \"Joueur bien dans sa peau et dans sa tête\"}, {\"note1\": \"0\", \"titre\": \"Goût de l"effort \", \"commentaire\": \"Bonne capacité à répéter les efforts.\"}, {\"note1\": \"0\", \"titre\": \"Concentration\", \"commentaire\": \"Bonne concentration. Tu peux  encore progresser dans ce domaine.\"}, {\"note1\": \"0\", \"titre\": \"Application\", \"commentaire\": \"Bonne application générale.\"}, {\"note1\": \"0\", \"titre\": \"Joueur Équipier\", \"commentaire\": \"J\'attends encore plus de toi dans ce domaine pour être un leader d\'équipe\"}], \"titre\": \"Etat d"esprit\"}]}}', '2021-10-04 19:59:47', '2021-10-04 19:59:47');

-- --------------------------------------------------------

--
-- Structure de la table "users"
--

CREATE TABLE "users" (
  "id" bigint(20) UNSIGNED NOT NULL,
  "name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "email" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "email_verified_at" timestamp NULL DEFAULT NULL,
  "password" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "gender" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "remember_token" varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  "categorie" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "matricule" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "categorie_joueur" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'x'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table "users"
--

INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "gender", "remember_token", "created_at", "updated_at", "categorie", "matricule", "categorie_joueur") VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$ebFkxGbgVRFN6yhzTv8YmersLK18lZY4oG5TM7m2ycJ4o4Q9fRaaS', 'Homme', NULL, '2021-08-31 23:00:00', '2021-10-02 22:44:24', 'Admin', 'JMNU676kk6HKLJL', 'x'),
(2, 'abderrahim ouijjan', 'abderrahim@gmail.com', NULL, '$2y$10$unEZ//.oym9xggND0jCpUOKN96YfMLrfox/McHKR6KeAJLQdKPzjq', 'Homme', NULL, '2021-10-02 22:19:35', '2021-10-02 22:19:35', 'Joueur', 'lzjldajkz', 'U10'),
(3, 'hanane', 'hanane@gmail.com', NULL, '$2y$10$0mLX/D5wcTeimefkMVi5FO4uCxh9XJDa//AXYBWnYk3OVhoJcrYzC', 'Femme', NULL, '2021-10-02 22:19:02', '2021-10-02 22:19:02', 'Joueur', 'kqkdjz', 'U8'),
(14, 'smail', 'smail@gmail.com', NULL, '$2y$10$Q3VrGcXfYBxtQ9kYX.qOxe5dA9YQ.6gN5bpWPIc0VWsqubG/8r8x.', 'Homme', NULL, '2021-10-04 19:45:44', '2021-10-04 19:45:44', 'Joueur', 'lkemlakealz', 'U12'),
(15, 'idbnjaa', 'idbnjaa@gmail.com', NULL, '$2y$10$1hoaC/aNEegYS2L8AnIc7uEU6hPU..KDYcs/sQAyBEtCOr3xuc4RC', 'Homme', NULL, '2021-10-04 20:04:32', '2021-10-04 20:04:32', 'Educateur', 'zzefze123', 'x');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table "absences"
--
ALTER TABLE "absences"
  ADD PRIMARY KEY ("id");

--
-- Index pour la table "events"
--
ALTER TABLE "events"
  ADD PRIMARY KEY ("id");

--
-- Index pour la table "migrations"
--
ALTER TABLE "migrations"
  ADD PRIMARY KEY ("id");

--
-- Index pour la table "tests"
--
ALTER TABLE "tests"
  ADD PRIMARY KEY ("id");

--
-- Index pour la table "users"
--
ALTER TABLE "users"
  ADD PRIMARY KEY ("id");

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table "absences"
--
ALTER TABLE "absences"
  MODIFY "id" bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table "events"
--
ALTER TABLE "events"
  MODIFY "id" bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT pour la table "migrations"
--
ALTER TABLE "migrations"
  MODIFY "id" int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table "tests"
--
ALTER TABLE "tests"
  MODIFY "id" bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table "users"
--
ALTER TABLE "users"
  MODIFY "id" bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
