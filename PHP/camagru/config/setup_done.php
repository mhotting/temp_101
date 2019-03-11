<?php

require_once('./config/database.php');

// Creates the Camagru Database
function ft_create_db() {
    global $DB_DSN_INIT, $DB_DSN, $DB_USER, $DB_PASSWORD;

    // Database creation
    $db = new PDO($DB_DSN_INIT, $DB_USER, $DB_PASSWORD);
    $db->exec('
        DROP DATABASE IF EXISTS camagru;
        CREATE DATABASE IF NOT EXISTS camagru CHARACTER SET UTF8mb4 COLLATE utf8mb4_bin;
        USE camagru;
    ');

    // Table creation
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $db->exec('
        CREATE TABLE image (
            idImage INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nameImage VARCHAR(255) NOT NULL,
            urlImage VARCHAR(255) NOT NULL
        );
        CREATE TABLE user (
            idUser INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nameUser VARCHAR(255) NOT NULL,
            mailUser VARCHAR(255) NOT NULL,
            passwordUser VARCHAR(255) NOT NULL,
            active BOOLEAN DEFAULT FALSE NOT NULL,
            activationKey VARCHAR(255) NOT NULL,
            forgottenKey VARCHAR(255) NOT NULL,
            creationDate DATETIME DEFAULT NOW() NOT NULL
        );
        CREATE TABLE photo (
            idPhoto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            photoName VARCHAR(255) NOT NULL,
            idUser INT NOT NULL
        );
        CREATE TABLE comment (
            idComment INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            textComment TEXT NOT NULL,
            idUser INT NOT NULL,
            idPhoto INT NOT NULL
        );
        CREATE TABLE enjoy (
            idEnjoy INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            idUser INT NOT NULL,
            idPhoto INT NOT NULL
        );
        CREATE TABLE follow (
            idFollow INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            idUser INT NOT NULL,
            idFollower INT NOT NULL
        );
    ');

    $db->exec('
        ALTER TABLE photo
        ADD FOREIGN KEY (idUser) REFERENCES user(idUser)
        ON DELETE CASCADE;
        ALTER TABLE comment
        ADD FOREIGN KEY (idUser) REFERENCES user(idUser)
        ON DELETE CASCADE;
        ALTER TABLE comment
        ADD FOREIGN KEY (idPhoto) REFERENCES photo(idPhoto)
        ON DELETE CASCADE;
        ALTER TABLE enjoy
        ADD FOREIGN KEY (idUser) REFERENCES user(idUser);
        ALTER TABLE enjoy
        ADD FOREIGN KEY (idPhoto) REFERENCES photo(idPhoto)
        ON DELETE CASCADE;
        ALTER TABLE follow
        ADD FOREIGN KEY (idUser) REFERENCES user(idUser)
        ON DELETE CASCADE;
        ALTER TABLE follow
        ADD FOREIGN KEY (idFollower) REFERENCES user(idUser)
        ON DELETE CASCADE;
    ');
}