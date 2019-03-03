CREATE DATABASE ocr_chat;
USE ocr_chat;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `dateMessage` datetime NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `fk_idUser` (`idUser`);
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `message`
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE;
INSERT INTO `user` (`idUser`, `pseudo`, `password`) VALUES
(14, 'mad', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6');
INSERT INTO `message` (`idMessage`, `idUser`, `dateMessage`, `contenu`) VALUES
(22, 14, '2019-02-14 13:34:39', 'Bonjour, bienvenue sur mon chat.'),
(23, 14, '2019-02-14 13:34:59', 'J\'espère que vous le trouverez sympa, j\'essaye de me remettre un peu dans la prog web :)'),
(24, 14, '2019-02-14 13:35:05', 'Bonne correction!');
COMMIT;