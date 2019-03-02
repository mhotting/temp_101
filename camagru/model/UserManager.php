<?php

require_once('./model/Manager.php');

final class UserManager extends Manager {
    // Adds a new user in the database
    public function ft_adduser($username, $mail, $password, $key) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('INSERT INTO user(nameUser, mailUser, passwordUser, activationKey) VALUES (:nameUser, :mailUser, :passwordUser, :activationKey);');
        $query->execute(array('nameUser' => $username, 'mailUser' => $mail, 'passwordUser' => $password, 'activationKey' => $key));
        $query->closeCursor();
    }

    // Returns the number of user matching the given username
    public function ft_username_exists($username) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE nameUser = :nameUser;');
        $query->execute(array('nameUser' => $username));
        return ($query);
    }

    // Returns the number of user matching the giver mail
    public function ft_mail_exists($mail) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE mailUser = :mailUser;');
        $query->execute(array('mailUser' => $mail));
        return ($query);
    }

    // Checks if the password of the given user is correct
    function ft_check_password($username, $pwd) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE nameUser = :nameUser AND passwordUser = :password;');
        $query->execute(array('nameUser' => $username, 'password' => $pwd));
        return ($query);
    }

    // Checks if the username corresponds to an active account
    function ft_check_active($username) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE nameUser = :nameUser AND active = TRUE;');
        $query->execute(array('nameUser' => $username));
        return ($query);
    }
}