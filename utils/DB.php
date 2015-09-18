<?php
class DB {
    public static function getConnect($h = 'localhost', $u = "root", $p = "lol", $db = "myedu_rest") {
        $conn = new PDO ( "mysql:host=$h;dbname=$db", $u, $p, array (
                PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8" 
        ) );
        $conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        return $conn;
    }
    
    
}