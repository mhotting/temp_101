<?php

require_once('./model/Manager.php');

final class UserManager extends Manager {
    // Returns all the information about a given user in the database (according to mail)
    public function ft_user_info($usermail) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT * FROM user WHERE mailUser = :mailUser;');
        $query->execute(array('mailUser' => $usermail));
        return ($query);
    }

    // Adds a new user in the database
    public function ft_adduser($username, $mail, $password, $activationKey, $forgottenKey) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('INSERT INTO user(nameUser, mailUser, passwordUser, activationKey, forgottenKey) VALUES (:nameUser, :mailUser, :passwordUser, :activationKey, :forgottenKey);');
        $query->execute(array('nameUser' => $username, 'mailUser' => $mail, 'passwordUser' => $password, 'activationKey' => $activationKey, 'forgottenKey' => $forgottenKey));
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
    public function ft_check_password($username, $pwd) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE nameUser = :nameUser AND passwordUser = :password;');
        $query->execute(array('nameUser' => $username, 'password' => $pwd));
        return ($query);
    }

    // Checks if the username corresponds to an active account
    public function ft_check_active($username) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE nameUser = :nameUser AND active = TRUE;');
        $query->execute(array('nameUser' => $username));
        return ($query);
    }

    // Checks if the activationkey of the given user is correct
    public function ft_check_activationkey($username, $key) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE nameUser = :nameUser AND activationKey = :activationKey;');
        $query->execute(array('nameUser' => $username, 'activationKey' => $key));
        return ($query);
    }

    // Activates the given user in the DB
    public function ft_activate($username) {
        $db = $this->ft_connect_db();
        $query = $db->prepare('UPDATE user SET active = TRUE WHERE nameUser = :nameUser;');
        $query->execute(array('nameUser' => $username));
        $query->closeCursor();
    }
}