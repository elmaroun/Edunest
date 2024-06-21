-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 12, 2024 at 07:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edunest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `photo_de_profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`prenom`, `nom`, `email`, `password`, `photo_de_profile`) VALUES
('Admin', '1', 'admin@1.com', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'profile-admin.jpg'),
('Admin', '2', 'admin@2.com', '315f166c5aca63a157f7d41007675cb44a948b33', 'profile-admin.jpg'),
('Admin', '3', 'admin@3.com', '33aab3c7f01620cade108f488cfd285c0e62c1ec', 'profile-admin.jpg'),
('Admin', '4', 'admin@4.com', 'ea053d11a8aad1ccf8c18f9241baeb9ec47e5d64', 'profile-admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement` varchar(255) NOT NULL,
  `cours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement`, `cours`) VALUES
('Quel est le rôle des enzymes dans les réactions biochimiques?', 'Biochimie Fondamentale'),
('Quel est le rôle des enzymes dans les réactions biochimiques?', 'Biochimie Fondamentale'),
('Exercice  a faire .', 'Informatique'),
('AI & Ethics : Vous devrez faire une présentation en anglais sur ce sujet.', 'Intelligence Artificielle');

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `mots_cles` text NOT NULL,
  `public_vise` varchar(40) NOT NULL,
  `prerequis` text NOT NULL,
  `email` varchar(35) NOT NULL,
  `nombre_pdf` int(11) NOT NULL,
  `nombre_link` int(11) NOT NULL,
  `nombre_videos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`titre`, `description`, `mots_cles`, `public_vise`, `prerequis`, `email`, `nombre_pdf`, `nombre_link`, `nombre_videos`) VALUES
('Algorithmes Avancés', 'Exploration des techniques avancées d algorithmique, incluant tri, recherche, et programmation dynamique.', 'Algorithmes, Complexité, Programmation, Tri, Recherche.', 'cp1', 'Algorithmes de base, Structures de données.', 'sarah.johnson@university.edu', 2, 1, 1),
('Biochimie Fondamentale', 'Étude approfondie des processus biochimiques vitaux, incluant biomolécules, régulation métabolique, et applications médicales.', 'Biochimie, Métabolisme, Biomolécules, Régulation, Applications médicales.', 'cp1', 'Chimie organique, Biologie cellulaire.', 'david.rodriguez@university.edu', 1, 1, 1),
('Écologie Marine', 'Exploration des écosystèmes marins, incluant les communautés biologiques, les interactions écologiques, et les impacts humains sur les océans.', 'Écologie marine, Océans, Biodiversité, Interactions écologiques, Conservation.', 'cp1', 'Biologie marine, Écologie.', 'emily.patel@university.edu', 1, 1, 1),
('Génie Logiciel', 'Étude des principes et des méthodes du développement de logiciels, incluant l analyse des besoins, la conception, la programmation, et le test.', 'Génie logiciel, Développement de logiciels, Analyse des besoins, Conception, Test.', 'GI1', 'Programmation, Génie informatique.', 'david.rodriguez@university.edu', 0, 0, 0),
('Informatique', 'La description de informatique. Informatique est la science de traitement de l`information.', 'Info, C, web, Java ...', 'GI1', 'Algorithmes ...', 'alex.david@university.edu', 1, 1, 1),
('Intelligence Artificielle', 'Exploration des techniques d intelligence artificielle, incluant l apprentissage automatique, les réseaux de neurones, et les systèmes experts.', 'Intelligence artificielle, Apprentissage automatique, Réseaux de neurones, Systèmes experts.', 'cp1', 'Programmation avancée, Algèbre linéaire.', 'alberto.jira@university.edu', 1, 0, 0),
('Marketing Stratégique', 'Étude des stratégies marketing pour entreprises, couvrant l analyse de marché, développement de produits, et communication.', 'Marketing, Stratégie, Communication, Analyse de marché, Développement de produits.', 'cp1', 'Marketing de base, Comportement du consommateur.', 'sarah.johnson@university.edu', 1, 1, 1),
('Neurobiologie Cellulaire', 'Exploration des principes fondamentaux de la neurobiologie au niveau cellulaire, y compris la structure neuronale, les processus de signalisation et les mécanismes de plasticité.', 'Neurobiologie, Cellules nerveuses, Signalisation neuronale, Plasticité.', 'cp1', 'Biologie cellulaire, Chimie organique.', 'emily.patel@university.edu', 1, 1, 1),
('Physique Quantique', 'Introduction aux principes de la physique quantique et ses applications, incluant mécanique quantique et systèmes quantiques.', 'Physique, Quantique, Applications, Mécanique quantique, Systèmes quantiques.', 'cp1', 'Physique classique, Calcul différentiel.', 'david.rodriguez@university.edu', 1, 1, 1),
('Psychologie Cognitive', 'Analyse des processus mentaux humains, incluant la perception, l attention, la mémoire, le langage et la résolution de problèmes.', 'Psychologie cognitive, Perception, Mémoire, Langage, Résolution de problèmes.', 'cp1', 'Psychologie de base, Neurosciences.', 'emily.patel@university.edu', 3, 1, 1),
('Psychologie de l Enfant', 'Exploration du développement psychologique de l enfant, incluant la cognition, l émotion, et la socialisation.', 'Psychologie de l enfant, Développement cognitif, Émotions, Socialisation, Apprentissage.', 'cp1', 'Psychologie du développement, Psychologie de l apprentissage.', 'david.rodriguez@university.edu', 1, 0, 0),
('Systèmes Informatiques Distribués', 'Étude des architectures et des protocoles des systèmes informatiques distribués, incluant la communication interprocessus, la synchronisation et la tolérance aux pannes.', 'Informatique distribuée, Réseaux, Communication, Synchronisation, Tolérance aux pannes.', 'cp1', 'Systèmes d exploitation, Réseaux informatiques.', 'michael.lee@university.edu', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cours_students`
--

CREATE TABLE `cours_students` (
  `titre` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cours_students`
--

INSERT INTO `cours_students` (`titre`, `email`) VALUES
('Biochimie Fondamentale', 'john.miler@student.university.edu'),
('Génie Logiciel', 'john.miler@student.university.edu'),
('Informatique', 'adam.smith@student.university.edu'),
('Systèmes Informatiques Distribués', 'adam.smith@student.university.edu'),
('Marketing Stratégique', 'adam.smith@student.university.edu'),
('Informatique', 'light.kaynn@student.university.edu'),
('Systèmes Informatiques Distribués', 'light.kaynn@student.university.edu'),
('Psychologie Cognitive', 'yoru.alrety@student.university.edu'),
('Intelligence Artificielle', 'simba.let@student.university.edu'),
('Psychologie Cognitive', 'simba.let@student.university.edu');

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE `demandes` (
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `titre` varchar(100) NOT NULL,
  `nom_link` varchar(100) NOT NULL,
  `sous_titre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`titre`, `nom_link`, `sous_titre`) VALUES
('Physique Quantique', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Physique Quantique Link'),
('Algorithmes Avancés', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Algorithmes Avancés Link'),
('Marketing Stratégique', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Marketing Stratégique Link'),
('Neurobiologie Cellulaire', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Neurobiologie Cellulaire Link'),
('Psychologie Cognitive', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Psychologie Cognitive Link'),
('Écologie Marine', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Écologie Marine Link'),
('Systèmes Informatiques Distribués', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Systèmes Informatiques Distribués Link'),
('Biochimie Fondamentale', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Biochimie Fondamentale Link'),
('Informatique', 'https://www.canva.com/design/DAGE62mcM5Q/qCyWkKHf5MCSvdTKLKfViQ/view?utm_content=DAGE62mcM5Q&utm_cam', 'Informatique Link');

-- --------------------------------------------------------

--
-- Table structure for table `pdf`
--

CREATE TABLE `pdf` (
  `titre` varchar(100) NOT NULL,
  `nom_pdf` varchar(100) NOT NULL,
  `sous_titre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf`
--

INSERT INTO `pdf` (`titre`, `nom_pdf`, `sous_titre`) VALUES
('Physique Quantique', 'Cours 2.pdf', 'Physique Quantique PDF'),
('Algorithmes Avancés', 'Cours 5.pdf', 'Algorithmes Avancés PDF'),
('Algorithmes Avancés', 'Cours 4.pdf', 'Algorithmes Avancés PDF'),
('Marketing Stratégique', 'Cours 2.pdf', 'Marketing Stratégique PDF'),
('Neurobiologie Cellulaire', 'Cours 3.pdf', 'Neurobiologie Cellulaire Pdf'),
('Psychologie Cognitive', 'Cours 1.pdf', 'Psychologie Cognitive PDF 1'),
('Psychologie Cognitive', 'Cours 2.pdf', 'Psychologie Cognitive PDF 2'),
('Psychologie Cognitive', 'Cours 3.pdf', 'Psychologie Cognitive PDF 3'),
('Écologie Marine', 'Cours 4.pdf', 'Écologie Marine  PDF'),
('Systèmes Informatiques Distribués', 'Cours 4.pdf', 'Systèmes Informatiques Distribués PDF '),
('Biochimie Fondamentale', 'Cours 2.pdf', 'Biochimie Fondamentale PDF'),
('Informatique', 'Cours 2.pdf', 'Informatique PDF'),
('Intelligence Artificielle', 'Cours 4.pdf', 'Intelligence Artificielle PDF');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `photo_de_profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`prenom`, `nom`, `email`, `password`, `photo_de_profile`) VALUES
('Alberto', 'Jira', 'alberto.jira@university.edu', 'c1a4158909d6c23f73df353c7cc0bbe963891a65', 'profile-professor.jpg'),
('Alex', 'David', 'alex.david@university.edu', '60c6d277a8bd81de7fdde19201bf9c58a3df08f4', 'profile-professor.jpg'),
('David', 'Rodriguez', 'david.rodriguez@university.edu', 'aa743a0aaec8f7d7a1f01442503957f4d7a2d634', 'profile-professor.jpg'),
('Davin', 'Andrews', 'davin.andrews@university.edu', '083f905cff3a845ae6c3f8ea91fb9864b2ad08af', 'profile-professor.jpg'),
('Emily', 'Patel', 'emily.patel@university.edu', '47e68180813c48be2408b98f5577fb058975820e', 'profile-professor.jpg'),
('Michael', 'Lee ', 'michael.lee@university.edu', '17b9e1c64588c7fa6419b4d29dc1f4426279ba01', 'profile-professor.jpg'),
('Samantha', 'Smith', 'samantha.smith@university.edu', 'ec5a7c3e21436a8e76716710ce551356f9aa745e', 'profile-professor.jpg'),
(' Sarah', 'Johnson', 'sarah.johnson@university.edu', 'be8ec20d52fdf21c23e83ba2bb7446a7fecb32ac', 'profile-professor.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `email_sender` varchar(35) NOT NULL,
  `email_receiver` varchar(35) NOT NULL,
  `cours` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question`, `answer`, `email_sender`, `email_receiver`, `cours`) VALUES
('Quel est le rôle des enzymes dans les réactions biochimiques?', 'Elles permettent d\'accélérer ces réactions chimiques : ce sont des biocatalyseurs.', 'john.miler@student.university.edu', 'david.rodriguez@university.edu', 'Biochimie Fondamentale'),
('Quelles sont les principales classes de biomolécules?', '', 'john.miler@student.university.edu', 'david.rodriguez@university.edu', 'Biochimie Fondamentale'),
('C qoui informatique ??', '', 'adam.smith@student.university.edu', 'alex.david@university.edu', 'Informatique'),
('Il y a le TP demain ??', 'Oui.', 'adam.smith@student.university.edu', 'alex.david@university.edu', 'Informatique'),
('Jolie Cours !', '', 'adam.smith@student.university.edu', 'sarah.johnson@university.edu', 'Marketing Stratégique'),
('C est quoi informatique ? et algorithmes est important??', '', 'light.kaynn@student.university.edu', 'alex.david@university.edu', 'Informatique'),
('Quelle heure la présentation ?', '', 'simba.let@student.university.edu', 'alberto.jira@university.edu', 'Intelligence Artificielle'),
('Pourquoi Psychologie est différente ? ', '', 'simba.let@student.university.edu', 'emily.patel@university.edu', 'Psychologie Cognitive');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `photo_de_profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`prenom`, `nom`, `email`, `password`, `photo_de_profile`) VALUES
('Adam', 'Smith', 'adam.smith@student.university.edu', '0e18f44c1fec03ec4083422cb58ba6a09ac4fb2a', 'profile-student.jpg'),
('Albert', 'Dolly', 'albert.dolly@student.university.edu', '7aa129f67fde68c6d88aa58b8b8c5c28eb7dd3a3', 'profile-student.jpg'),
('Alex', 'Johnson', 'alex.johnson@student.university.edu', '60c6d277a8bd81de7fdde19201bf9c58a3df08f4', 'profile-student.jpg'),
('David', 'Wilson', 'david.wilson@student.university.edu', 'aa743a0aaec8f7d7a1f01442503957f4d7a2d634', 'profile-student.jpg'),
('Emily', 'Davis', 'emily.davis@student.university.edu', '47e68180813c48be2408b98f5577fb058975820e', 'profile-student.jpg'),
('John', 'Miler', 'john.miler@student.university.edu', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501', 'profile-student.jpg'),
('Light', 'Kaynn', 'light.kaynn@student.university.edu', 'dfccc06f14414bff5a59be7fc90abf4404b47fc8', 'profile-student.jpg'),
('Simba', 'Let', 'simba.let@student.university.edu', '43216f3592f37d744f7d544614a2f997a5739641', 'profile-student.jpg'),
('Yoru', 'Alrety', 'yoru.alrety@student.university.edu', 'a31cfa539d8670023a6a2116dddbf3cbf0143d26', 'profile-student.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `titre` varchar(100) NOT NULL,
  `nom_video` varchar(100) NOT NULL,
  `sous_titre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`titre`, `nom_video`, `sous_titre`) VALUES
('Physique Quantique', 'Video Thank You.mp4', 'Physique Quantique Video'),
('Algorithmes Avancés', 'Video Thank You.mp4', 'Algorithmes Avancés Video'),
('Marketing Stratégique', 'Video Thank You.mp4', 'Marketing Stratégique Video'),
('Neurobiologie Cellulaire', 'Video Thank You.mp4', 'Neurobiologie Cellulaire Video'),
('Psychologie Cognitive', 'Video Thank You.mp4', 'Psychologie Cognitive Video'),
('Écologie Marine', 'Video Thank You.mp4', 'Écologie Marine Video'),
('Systèmes Informatiques Distribués', 'Video Thank You.mp4', 'Systèmes Informatiques Distribués Video'),
('Biochimie Fondamentale', 'Video Thank You.mp4', 'Biochimie Fondamentale Video'),
('Informatique', 'Video Thank You.mp4', 'Informatique Video');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD KEY `cours` (`cours`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`titre`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `cours_students`
--
ALTER TABLE `cours_students`
  ADD KEY `email` (`email`),
  ADD KEY `titre` (`titre`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD KEY `titre` (`titre`);

--
-- Indexes for table `pdf`
--
ALTER TABLE `pdf`
  ADD KEY `titre` (`titre`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD KEY `email_sender` (`email_sender`),
  ADD KEY `email_receiver` (`email_receiver`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD KEY `titre` (`titre`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`cours`) REFERENCES `cours` (`titre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`email`) REFERENCES `professors` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cours_students`
--
ALTER TABLE `cours_students`
  ADD CONSTRAINT `cours_students_ibfk_1` FOREIGN KEY (`email`) REFERENCES `students` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cours_students_ibfk_2` FOREIGN KEY (`titre`) REFERENCES `cours` (`titre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`titre`) REFERENCES `cours` (`titre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pdf`
--
ALTER TABLE `pdf`
  ADD CONSTRAINT `pdf_ibfk_1` FOREIGN KEY (`titre`) REFERENCES `cours` (`titre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`email_sender`) REFERENCES `students` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`email_receiver`) REFERENCES `professors` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`titre`) REFERENCES `cours` (`titre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
