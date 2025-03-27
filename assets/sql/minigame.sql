-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 27. 22:16
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `minigame`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `friends`
--

CREATE TABLE `friends` (
  `id` int(255) NOT NULL,
  `toid` int(255) NOT NULL,
  `fromid` int(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `friends`
--

INSERT INTO `friends` (`id`, `toid`, `fromid`, `status`) VALUES
(1, 5, 8, 1),
(2, 2, 1, 1),
(3, 13, 12, 1),
(4, 6, 2, 1),
(5, 3, 11, 1),
(6, 7, 6, 1),
(7, 10, 3, 1),
(8, 12, 4, 1),
(9, 8, 10, 1),
(10, 1, 7, 1),
(11, 11, 5, 1),
(12, 9, 10, 1),
(13, 4, 13, 1),
(14, 10, 11, 1),
(15, 13, 3, 1),
(16, 12, 7, 1),
(17, 13, 1, 1),
(18, 7, 4, 1),
(19, 10, 9, 1),
(20, 9, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `score` int(11) DEFAULT 0,
  `games_played` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `draws` int(11) DEFAULT 0,
  `losses` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `game`
--

INSERT INTO `game` (`id`, `username`, `score`, `games_played`, `wins`, `draws`, `losses`) VALUES
(1, 'doomhyena', 100, 13, 10, 0, 3),
(2, 'humbi28', 135, 14, 13, 1, 0),
(3, 'ecstaticguineapig', 40, 5, 4, 0, 1),
(4, 'blanddevil', 35, 9, 0, 7, 2),
(5, 'computerarrow', 10, 5, 1, 0, 4),
(6, 'hawkeye', 45, 11, 4, 1, 6),
(7, 'heavyalmond', 10, 8, 0, 2, 6),
(8, 'salamaniac', 85, 11, 7, 3, 1),
(9, 'sharctic', 20, 7, 2, 0, 5),
(10, 'llamaths', 50, 11, 1, 8, 2),
(11, 'rivercharger', 25, 15, 2, 1, 12);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstanme` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstanme`, `username`, `password`) VALUES
(1, 'Csontos', 'Kincső', 'doomhyena', '$2y$10$rnuZFvqW9rwqwj4RaoHlNu32zXFtx0.xhW9hwnL0QGhzVsbvW5LKK'),
(2, 'Hujber ', 'Balázs', 'humbi28', '$2y$10$tKIJidPjDkVUH2ABaKJ/sORFb1daaInfLLzoipJwE0PV7hbgx7h2i'),
(3, 'Balogh', 'Levente', 'llamaths', '$2y$10$QwndkjyNR0OpkVuN6QP7h.rXivUyO4sSBBeU43Nxs7e1c5Jcyitn6'),
(4, 'Farkas', 'Tamás', 'salamaniac', '$2y$10$ATaOJjSIvIC6LO2lfB0TxutHf8GOaqcaw2.LBtjFThie6SOGtYPZG'),
(5, 'Jakab', 'Ákos', 'sharctic', '$2y$10$oL5w2A3GhYr1h0OBiPbtc.AXnPz0Cp5lqh6s2ophAsNrets51ACUy'),
(6, 'Bálint', 'Ármin', 'hawkeye', '$2y$10$dnEKCC3xpcrAhNGkWzVXruu1i70PZGjx30qOcdu9fAK8/CoASX2N.'),
(7, 'Barna', 'Barnabás', 'rivercharger', '$2y$10$xyp2dP5pmemBTwrsFfsfoODvqn7YI83ikw5s.IOt/gVb2sSVLaYo6'),
(8, 'Pataki', 'Csongor', 'ecstaticguineapig', '$2y$10$jFlgkfmuwkepHeEiKZF66.bR.BC0xn/qzZWiF99KHS2bojcE2U87i'),
(9, 'Hegedüs', 'Kevin', 'heavyalmond', '$2y$10$qGJ7to2i5nBl8CBCECdw4ukvpqvwcPHzvNi2kSGsdfyQOfgUepQxS'),
(10, 'Soós', 'Jakab', 'blanddevil', '$2y$10$mtb.nGsSyeUn0qAXl3.aDO/r8jaogFFUCPsDh2tUDjJLMYQJgEhPu'),
(11, 'Váradi', 'Dénes', 'computerarrow', '$2y$10$NV1pVLaT.t564sz0KY4p3e76HbcjBHRbntLtd7LYdDcJUSkNpCbva');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
