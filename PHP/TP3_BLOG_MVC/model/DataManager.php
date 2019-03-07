<?php

abstract class DataManager {
    // Connection to the database using PDO
    protected function ft_connect_db() {
        $db = new PDO('mysql:host=localhost;dbname=blog_ocr;charset=utf8', 'root', '');
        return ($db);
    }
}