<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User {
    private $pseudo;
    private $password;
    private $salt;
    private $profile;
    private $picture_path;
    
    public function __construct(Array $userData) {
        $this->pseudo       = $userData['pseudo'];
        $this->password     = $userData['password'];
        //$this->salt         = $userData['salt'];
        $this->profile      = $userData['profile'];
        $this->picture_path = $userData['picture_path'];
    }
    
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }
    public function getPseudo() {
        return $this->pseudo;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setSalt($salt) {
        $this->salt = $salt;
    }
    public function getSalt() {
        return $this->salt;
    }
    public function setProfile($profil) {
        $this->profile = $profil;
    }
    public function getProfile() {
        return $this->profile;
    }
    public function setPicturePath($picture_path) {
        $this->picture_path = $picture_path;
    }
    public function getPicturePath() {
        return $this->picture_path;
    }
}

class UserManager {
    private $db;
    
    public function __construct(DBManager $db) {
        $this->db = $db;
    }
    
    public function getUsersList() {
        $users = array();
        $data = $this->db->request('SELECT * FROM members');
        
        foreach($data as $user) {
            $users[] = new User($user);
        }
        
        return $users;
    }
    
    public function getUser($pseudo) {
        return new User($this->db->request('SELECT * FROM members WHERE pseudo = ?', array("$pseudo"), "fetch"));
    }
    
    public function getUserFriends(User $user) {
        return 0;
    }
}
