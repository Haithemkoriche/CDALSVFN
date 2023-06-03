-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 03 juin 2023 à 18:31
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cdals`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `ID_act` int(10) NOT NULL,
  `titre_act` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_act` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_act` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_ate_foreign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`ID_act`, `titre_act`, `description_act`, `image_act`, `ID_ate_foreign`) VALUES
(1, 'Informatique et programmation', ' Apprenez les bases de la programmation et développez vos compétences en informatique.', 'c-2.jpg', 5),
(2, 'Robotique ', 'Construisez et programmez des robots pour relever des défis passionnants.', 'aldebaran-image-400px.jpg', 5),
(3, 'Astronomie ', ' Explorez l\'univers et découvrez les merveilles du ciel étoilé.', '329569907_2655648727911720_265626239557020255_n.jpg', 5),
(4, 'Géologie ', 'Plongez dans le monde des roches, minéraux et fossiles.\r\n', 'DSC04569..jpg', 5),
(5, 'Biologie ', 'Découvrez les mystères de la vie à travers des expériences et des observations.', 'depositphotos_271128260-stock-photo-happy-children-use-tubes-back.jpg', 5),
(6, 'Physique amusante', ' Participez à des expériences fascinantes pour comprendre les lois de la physique.', 'physique-amusante.jpg', 5),
(7, 'Arts plastiques ', 'Exprimez-vous à travers les arts plastiques. Explorez différentes techniques telles que la peinture, le dessin, la sculpture et le collage. Développez votre sens artistique, apprenez à observer le monde qui vous entoure et créez des œuvres uniques qui reflètent votre vision artistique.', 'art-plastique-enfant.jpg', 6),
(8, 'Photographie numérique', 'Maîtrisez les techniques de la photographie et développez votre créativité.', '1200x768_voici-selection-meilleurs-appareils-photo-enfant (1).jpg', 7),
(9, 'mathématiques divertissantes', 'Jeux et énigmes mathématiques pour développer les compétences en résolution de problèmes.', 'c-4.jpg', 5);

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `ID_admin` int(10) NOT NULL,
  `Nom_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephon_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`ID_admin`, `Nom_admin`, `email`, `telephon_admin`, `password`) VALUES
(2, 'koriche haithem', 'admin@cdals.com', '0796130346', 'admin1234');

-- --------------------------------------------------------

--
-- Structure de la table `animateurs`
--

CREATE TABLE `animateurs` (
  `ID_Anim` int(10) NOT NULL,
  `Nom_anim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_anim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email_anim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephon_anim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animateurs`
--

INSERT INTO `animateurs` (`ID_Anim`, `Nom_anim`, `prenom_anim`, `Email_anim`, `telephon_anim`) VALUES
(1, 'Quia ex blanditiis n', 'Quo atque veniam po', 'zakaki@mailinator.com', '+1 (647) 486-2519'),
(2, 'Rerum qui minima ist', 'Veniam ad sed qui q', 'buwo@mailinator.com', '+1 (831) 382-2298');

-- --------------------------------------------------------

--
-- Structure de la table `ateliers`
--

CREATE TABLE `ateliers` (
  `ID_ate` int(10) NOT NULL,
  `intitule_ate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_ate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_form_foreign` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ateliers`
--

INSERT INTO `ateliers` (`ID_ate`, `intitule_ate`, `image_ate`, `description_ate`, `ID_form_foreign`) VALUES
(5, 'Ateliers scientifiques', '330235282_1301270213752586_9125893448818367354_n.jpg', 'Nos ateliers scientifiques sont conçus pour éveiller la curiosité des jeunes et les immerger dans le monde passionnant de la science. Chaque atelier offre une expérience interactive et pratique, permettant aux participants d\'explorer divers domaines scientifiques et de développer leurs compétences analytiques et techniques.', 1),
(6, 'Ateliers culturels', '320832142_664200618825720_8176764258807195150_n.jpg', 'Nos ateliers culturels offrent une immersion dans le monde riche et diversifié de la culture. Chaque atelier vise à élargir les horizons des participants, à favoriser la découverte de différentes formes artistiques et à promouvoir l\'expression créative.', 1),
(7, 'Ateliers artistiques ', '330660720_519989893612274_9203671738810558503_n.jpg', 'Nos ateliers artistiques sont conçus pour nourrir votre passion pour les arts et vous permettre d\'explorer votre créativité. Que vous soyez novice ou que vous ayez déjà une expérience dans un domaine artistique, nos ateliers vous offrent une opportunité d\'apprendre, de vous exprimer et de développer vos compétences artistiques.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `carousels`
--

CREATE TABLE `carousels` (
  `ID_carousel` int(10) NOT NULL,
  `titre_car` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_car` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_car` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carousels`
--

INSERT INTO `carousels` (`ID_carousel`, `titre_car`, `description_car`, `path_car`) VALUES
(6, 'Explorez votre créativité avec nos Ateliers Artistiques', 'Plongez dans un univers artistique inspirant avec nos ateliers de dessin, de peinture, de sculpture, de photographie et bien plus encore. Développez vos compétences artistiques, exprimez votre créativité et créez des œuvres uniques qui reflètent votre style personnel.', '330235282_1301270213752586_9125893448818367354_n.jpg'),
(7, 'Enrichissez votre esprit avec nos Ateliers Culturels', ' Plongez dans la diversité culturelle à travers nos ateliers culturels. Découvrez de nouvelles langues, explorez des traditions ancestrales, participez à des échanges interculturels et élargissez vos horizons. Nos ateliers vous offrent une expérience immersive pour éveiller vos sens et nourrir votre curiosité.', '330249605_3338748173050576_2888687962863861_n.jpg'),
(8, 'Stimulez votre esprit avec nos Ateliers Scientifiques', ' Explorez le monde fascinant de la science à travers nos ateliers scientifiques. Plongez dans des expériences captivantes, découvrez les mystères de l\'univers, expérimentez avec les technologies de pointe et développez votre esprit critique. Nos ateliers vous permettent d\'exprimer votre passion pour la science et d\'élargir vos connaissances.', '330271561_861799555078995_6749950599400254573_n.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id_contact` bigint(20) NOT NULL,
  `name_contact` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id_contact`, `name_contact`, `email_contact`, `phone_contact`, `message_contact`) VALUES
(1, 'Thor Macdonald', 'wobamafug@mailinator.com', '+1 (262) 728-3196', 'Ea quaerat ad dolor '),
(3, 'Stephen Watts', 'movyj@mailinator.com', '+1 (819) 634-2119', 'Sint quas aspernatur');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `ID_E` int(10) NOT NULL,
  `intitule_E` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_E` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_E` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_d_E` date NOT NULL,
  `date_f_E` date NOT NULL,
  `ID_Anim_foreign` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`ID_E`, `intitule_E`, `description_E`, `image_E`, `date_d_E`, `date_f_E`, `ID_Anim_foreign`) VALUES
(5, 'Journée de sensibilisation environnementale', 'Engagez-vous pour la protection de l\'environnement à travers des activités de nettoyage et de sensibilisation.', '5550eaf92cfe1ab426699a95c6aed26a_M.jpg', '2023-09-02', '2023-09-03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `formateurs`
--

CREATE TABLE `formateurs` (
  `ID_form` int(10) NOT NULL,
  `Nom_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephon_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formateurs`
--

INSERT INTO `formateurs` (`ID_form`, `Nom_form`, `prenom_form`, `Email_form`, `telephon_form`) VALUES
(1, 'Asperiores enim volu', 'Velit elit asperior', 'taracug@mailinator.com', '+1 (428) 394-2339'),
(2, 'Cumque asperiores la', 'Dolore dolor duis ea', 'miwivus@mailinator.com', '+1 (472) 953-9382');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `ID_grp` int(10) NOT NULL,
  `int_grp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_deb_grp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`ID_grp`, `int_grp`, `date_deb_grp`) VALUES
(1, 'Eos incididunt iure ', '1973-07-31'),
(2, 'samedi a 8H', '2023-07-01');

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

CREATE TABLE `participants` (
  `ID_p` int(10) NOT NULL,
  `Nom_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addres_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephon_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_n_p` date NOT NULL,
  `lieu_n_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_act_foreign` int(11) DEFAULT NULL,
  `ID_grp_foreign` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participants`
--

INSERT INTO `participants` (`ID_p`, `Nom_p`, `prenom_p`, `addres_p`, `Email_p`, `telephon_p`, `date_n_p`, `lieu_n_p`, `ID_act_foreign`, `ID_grp_foreign`) VALUES
(37, 'Koriche', 'Haithem', 'Rue rahmania douera', 'korichehaithem2018@gmail.com', '0555725285', '2012-11-22', 'Error maiores itaque', 9, 1),
(38, 'Enim perspiciatis s', 'Minus quos non dicta', 'Illum et culpa alia', 'typimu@mailinator.com', '+1 (368) 682-1441', '2021-04-03', 'Quos ipsum labore ea', 5, 1),
(39, 'Koriche', 'Haithem', 'Rue rahmania douera', 'korichehaithem2018@gmail.com', '0555725285', '2021-04-03', 'Quos ipsum labore ea', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participant_evenement`
--

CREATE TABLE `participant_evenement` (
  `id_p_e` int(11) NOT NULL,
  `nom_p_e` varchar(255) NOT NULL,
  `prenom_p_e` varchar(255) NOT NULL,
  `email_p_e` varchar(255) NOT NULL,
  `telephone_p_e` varchar(20) NOT NULL,
  `adresse_p_e` varchar(255) NOT NULL,
  `evenement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `participant_evenement`
--

INSERT INTO `participant_evenement` (`id_p_e`, `nom_p_e`, `prenom_p_e`, `email_p_e`, `telephone_p_e`, `adresse_p_e`, `evenement_id`) VALUES
(1, 'Voluptates nisi et f', 'Ipsa similique et e', 'gofekug@mailinator.com', '+1 (773) 491-8437', 'Adipisci sit dolori', 5),
(2, 'Voluptates nisi et f', 'Ipsa similique et e', 'gofekug@mailinator.com', '+1 (773) 491-8437', 'Adipisci sit dolori', 5),
(3, 'Koriche', 'Haithem', 'korichehaithem2018@gmail.com', '0555725285', 'Rue rahmania douera', 5),
(4, '', '', '', '', '', 5),
(7, 'Sint pariatur Tene', 'In enim magna commod', 'pahe@mailinator.com', '+1 (186) 946-7158', 'Qui totam asperiores', 5),
(8, 'Cupiditate vitae adi', 'Maiores sit quisqua', 'huzugejog@mailinator.com', '+1 (343) 378-8532', 'Est possimus enim ', 5),
(9, 'Ullam deserunt quibu', 'Molestiae voluptatem', 'mywo@mailinator.com', '+1 (412) 404-2477', 'Aut atque eum aliqua', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ID_act`),
  ADD KEY `ID_act` (`ID_act`),
  ADD KEY `ID_ate_foreign` (`ID_ate_foreign`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID_admin`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `ID_admin` (`ID_admin`);

--
-- Index pour la table `animateurs`
--
ALTER TABLE `animateurs`
  ADD PRIMARY KEY (`ID_Anim`),
  ADD UNIQUE KEY `animateurs_email_anim_unique` (`Email_anim`),
  ADD KEY `ID_Anim` (`ID_Anim`);

--
-- Index pour la table `ateliers`
--
ALTER TABLE `ateliers`
  ADD PRIMARY KEY (`ID_ate`),
  ADD KEY `ID_ate` (`ID_ate`),
  ADD KEY `fk_ateliers_form` (`ID_form_foreign`);

--
-- Index pour la table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`ID_carousel`),
  ADD KEY `ID_carousel` (`ID_carousel`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id_contact`),
  ADD KEY `id_contact` (`id_contact`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`ID_E`),
  ADD KEY `ID_E` (`ID_E`),
  ADD KEY `fk_evenements_anim` (`ID_Anim_foreign`);

--
-- Index pour la table `formateurs`
--
ALTER TABLE `formateurs`
  ADD PRIMARY KEY (`ID_form`),
  ADD UNIQUE KEY `formateurs_email_form_unique` (`Email_form`),
  ADD KEY `ID_form` (`ID_form`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`ID_grp`),
  ADD KEY `ID_grp` (`ID_grp`);

--
-- Index pour la table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`ID_p`),
  ADD KEY `ID_p` (`ID_p`),
  ADD KEY `fk_participants_group` (`ID_grp_foreign`),
  ADD KEY `fk_participants_act` (`ID_act_foreign`);

--
-- Index pour la table `participant_evenement`
--
ALTER TABLE `participant_evenement`
  ADD PRIMARY KEY (`id_p_e`),
  ADD KEY `evenement_id` (`evenement_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `ID_act` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `animateurs`
--
ALTER TABLE `animateurs`
  MODIFY `ID_Anim` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ateliers`
--
ALTER TABLE `ateliers`
  MODIFY `ID_ate` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `ID_carousel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id_contact` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ID_E` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `formateurs`
--
ALTER TABLE `formateurs`
  MODIFY `ID_form` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `ID_grp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `participants`
--
ALTER TABLE `participants`
  MODIFY `ID_p` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `participant_evenement`
--
ALTER TABLE `participant_evenement`
  MODIFY `id_p_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ateliers`
--
ALTER TABLE `ateliers`
  ADD CONSTRAINT `fk_ateliers_form` FOREIGN KEY (`ID_form_foreign`) REFERENCES `formateurs` (`ID_form`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `fk_evenements_anim` FOREIGN KEY (`ID_Anim_foreign`) REFERENCES `animateurs` (`ID_Anim`);

--
-- Contraintes pour la table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `fk_participants_act` FOREIGN KEY (`ID_act_foreign`) REFERENCES `activities` (`ID_act`),
  ADD CONSTRAINT `fk_participants_group` FOREIGN KEY (`ID_grp_foreign`) REFERENCES `groups` (`ID_grp`);

--
-- Contraintes pour la table `participant_evenement`
--
ALTER TABLE `participant_evenement`
  ADD CONSTRAINT `participant_evenement_ibfk_1` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`ID_E`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
