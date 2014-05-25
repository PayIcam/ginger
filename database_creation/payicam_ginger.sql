-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 25 Mai 2014 à 09:55
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `payicam_ginger`
--
CREATE DATABASE IF NOT EXISTS `payicam_ginger` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `payicam_ginger`;

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `app_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id interne de l''application',
  `app_url` varchar(255) DEFAULT NULL COMMENT 'url du service autorisé',
  `app_key` char(32) NOT NULL,
  `app_name` varchar(100) NOT NULL,
  `app_desc` text,
  `app_creator` varchar(8) NOT NULL COMMENT 'Login de l''utilisateur ayant crÃ©e la clef.',
  `app_lastuse` datetime NOT NULL COMMENT 'Date de la dernière utilisation de cette clef.',
  `app_created` datetime NOT NULL COMMENT 'Date de création de la clef',
  `app_removed` datetime DEFAULT NULL COMMENT 'Est ce que la clef est supprimée.',
  PRIMARY KEY (`app_id`),
  UNIQUE KEY `app_key` (`app_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Liste des applications et leurs clefs.' ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `login` varchar(105) NOT NULL DEFAULT '',
  `nom` varchar(55) DEFAULT NULL,
  `prenom` varchar(55) DEFAULT NULL,
  `mail` varchar(105) DEFAULT NULL,
  `badge_uid` varchar(8) DEFAULT NULL,
  `expiration_badge` date DEFAULT NULL,
  PRIMARY KEY (`login`),
  UNIQUE KEY `badge_uid` (`badge_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;