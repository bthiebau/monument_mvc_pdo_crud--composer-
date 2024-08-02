<?php

namespace App;

use PDO;
use PDOException;
/**
 * singleton 
 */
class Database{
    private static ?PDO $pdoInstance = null;

    private function __construct(){

    }
        public static function getConnection(): PDO {

            if(self::$pdoInstance === null){
                try {
                    self::$pdoInstance = new PDO ('mysql:host=127.0.0.1:3306;charset=utf8mb4;dbname=mainbddpdo', 'root');
                } catch (PDOException $e) {
                die('Erreur : '.$e->getMessage());
                }
            }
            return self::$pdoInstance;  
        }
}