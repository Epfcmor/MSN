<?php
require_once('UserManager.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SessionManager {
    private $db;
    private $session;
    private $user = false;
    private $expires;
    
    public function __construct(DBManager $db, $session) {
        $this->db = $db;
        $this->session = $session;
        
        if(isset($session['pseudo'])) {
            $UM = new UserManager($db);
            $this->user = $UM->getUser($session['pseudo']);
        }
    }
    
    public function isAuthenticated() {
        return ($this->user) ? true : false;
    }
    public function redirect($page) {
        
    }
}