<?php
require_once('Config.php');

class DBManager {
    private $pdo;
    private $host;
    private $db;
    private $user;
    private $password;
    
    public function __construct() {
        $this->host     = Config::$HOST;
        $this->db       = Config::$DB;
        $this->user     = Config::$USER;
        $this->password = Config::$PASSWORD;
        
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", "$this->user", "$this->password");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            die('[FATAL ERROR] Can\'t connect to the database - Reason : '. $ex);
        }
        
    }
    
    public function request($request = false, $attr = null, $statement = null, $option = null) {
        if(!$request) {
            die('[FATAL ERROR] SQL Request failed - Request must be defined');
        }
        
        if($attr != null) {
            if(!is_array($attr)) {
                die('[FATAL ERROR] SQL Request failed - Reason : Attributes has to be an Array');
            } else {
                $attr = $this->sanitizer($attr);
            }
        }
        
        try {
            $query = $this->pdo->prepare($request);
            $query->execute($attr);

            switch($statement) {
                case "fetch":
                    return $query->fetch($option);
                default: 
                    return $query->fetchAll($option);
            }
        } catch (Exception $ex) {
            die('[FATAL ERROR] SQL Request failed - Reason : '. $ex);
        }
    }
    
    public function sanitizeInput($input) {
        $input = stripslashes($input);
        $input = strip_tags($input);
        $input = htmlentities($input);
        
        return $input;
    }
    
    public function sanitizer($arrayInput) {
        foreach($arrayInput as $key => $value) {
            $arrayInput[$key] = $this->sanitizeInput($value);
        }
        
        return $arrayInput;
    }
}