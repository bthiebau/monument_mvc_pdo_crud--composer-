<?php

try {
    //Port par défaut
    $db = new PDO('mysql:host=127.0.0.1:3306;charset=utf8mb4;dbname=mainbddpdo', 'root');

} catch (PDOException $e) {

    die('Erreur : '.$e->getMessage());

}