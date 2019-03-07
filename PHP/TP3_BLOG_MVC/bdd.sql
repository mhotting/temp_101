CREATE DATABASE blog_ocr;
USE blog_ocr;

CREATE TABLE IF NOT EXISTS post (
    idPost INT PRIMARY KEY AUTO_INCREMENT,
    datePost DATETIME NOT NULL,
    titlePost VARCHAR(255) NOT NULL,
    contentPost TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS comment (
    idComment INT PRIMARY KEY AUTO_INCREMENT,
    idPost INT NOT NULL,
    dateComment DATETIME NOT NULL,
    contentComment TEXT NOT NULL,
    FOREIGN KEY (idPost) REFERENCES post(idPost)
);

INSERT INTO post(datePost, titlePost, contentPost)
VALUES
    (NOW(), 'Titre Test', 'Ce premier post est un test pour voir si cela fonctionne.'),
    (NOW(), 'Titre Test2', 'Ce second post est un test pour voir si cela fonctionne aussi.');

INSERT INTO comment(idPost, dateComment, contentComment)
VALUES
    (1, NOW(), 'Je kiffe ce post!'),
    (1, NOW(), 'Je kiffe trop ce post!'),
    (2, NOW(), 'Je kiffe ce post aussi!'),
    (2, NOW(), 'Je kiffe ce post mais pas trop...'),
    (2, NOW(), 'Ma Maman mange des pommes de terre.');