-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Lut 2022, 00:37
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wypozyczalnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Comdey'),
(2, 'Action'),
(3, 'TV serie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `entities`
--

CREATE TABLE `entities` (
  `id` int(11) NOT NULL,
  `con` varchar(32) NOT NULL,
  `categoryId` varchar(32) NOT NULL,
  `limit` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `thumbnail` varchar(32) NOT NULL,
  `preview` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `entities`
--

INSERT INTO `entities` (`id`, `con`, `categoryId`, `limit`, `name`, `thumbnail`, `preview`) VALUES
(1, 'Home Alone', '1', '1', 'Home Alone', 'entities/thumbnails/ha.jpg', 'entities	humbnailsha.jpg'),
(2, '2012', '2', '', '2012', 'entities/thumbnails/2012.jpg', ''),
(4, 'BNN', '3', '1', 'Brooklyn Nine Nine', 'entities/thumbnails/bnn.jpg', 'TV serie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Surname` varchar(32) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL,
  `profiePic` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `Username`, `password`, `Name`, `Surname`, `Email`, `date`, `profiePic`) VALUES
(0, 'Adrian', '21232f297a57a5a743894a0e4a801fc3', 'Adrian', 'Adrian', 'adrian@adrian.pl', '2022-02-09', 'assets/images/ProfilePic.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `videoprogress`
--

CREATE TABLE `videoprogress` (
  `ID` int(11) NOT NULL,
  `videoId` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `finished` int(11) NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(32) NOT NULL,
  `filePath` varchar(32) NOT NULL,
  `episode` varchar(32) NOT NULL,
  `season` varchar(32) NOT NULL,
  `entityId` varchar(32) NOT NULL,
  `isMovie` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `filePath`, `episode`, `season`, `entityId`, `isMovie`) VALUES
(1, 'Home Alone', 'Comedy', 'entities\\thumbnails\\ha.jpg', '', '', '1', 1),
(2, '2012', 'Action film', 'entities	humbnails2012.jpg', '', '', '2', 1),
(3, 'Brooklyn Nine Nine', 'TV serie', '', '32', '2', '3', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
