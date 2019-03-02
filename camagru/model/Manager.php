<?php

require_once('./config/database.php');

abstract class Manager {
    // Connects to the database
    protected function ft_connect_db() {
        global $DB_DSN, $DB_USER, $DB_PASSWORD;
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        return ($db);
    }
}