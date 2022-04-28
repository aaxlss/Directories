<?php

namespace Model;

use PDO;

class Connection {

    private $host;
    private $dbname;
    private $user;
    private $password;
    private $dns;


    public function __construct(){
        $this->db_connection();
    }

    private function db_connection(){
        $this->host = 'localhost';
        $this->dbname = 'innodb';
        $this->user = 'root';
        $this->password = '12345';

        $this->dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;

        return $this->dns;
    }


    public function getInfo($sql){
        $pdo = new PDO($this->dsn, $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo->query($sql);
    }
}

?>