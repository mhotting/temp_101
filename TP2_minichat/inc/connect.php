<?php

// Creates a connection to DB using pdo -> returns Null if connection failed
function ft_connect_db() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=ocr_chat;charset=utf8', 'root', '');
    } catch(Exception $e) {
        echo('Error: ' . $e->getMessage());
        $db = Null;
    }
    return ($db);
}

?>