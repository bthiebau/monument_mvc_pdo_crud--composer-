<?php

// --------------------------------
// Manager des monuments
// --------------------------------

namespace App\Model;
use App\Database;
use PDO;
use Exception;

class MonumentManager {

    public static function getAll() : array {
        $db = Database::getConnection();
        $stmt = $db->query('SELECT * FROM monument');
        return $stmt->fetchAll(PDO::FETCH_CLASS, Monument::class); // Reviens a écrire composer start'App\\Model\\Monument'
    }

    public static function getOne(int $monumentId) : Monument {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM monument WHERE id = ?');
        $stmt->execute([$monumentId]);
        $result = $stmt->fetchObject(Monument::class);
        if($result == false) {
            throw new Exception("Monument non trouvé");
        } else {
            return $result;
        }
    }

    public static function create(Monument $monument) : void {
        $db = Database::getConnection();
        $stmt = $db->prepare('INSERT INTO monument (nom, pays, ville, nbVisitesAn) VALUES (?,?,?,?)');
        $stmt->execute([$monument->getNom(), $monument->getPays(), $monument->getVille(), $monument->getNbVisitesAn()]);
    }

    public static function update(Monument $monument) : void {
        $db = Database::getConnection(); // Ne pas faire de require_once, à cause du getOne()
        $stmt = $db->prepare('UPDATE monument SET nom = ?, pays = ?, ville = ?, nbVisitesAn = ? WHERE id = ?');
        $stmt->execute([$monument->getNom(), $monument->getPays(), $monument->getVille(), $monument->getNbVisitesAn(), $monument->getId()]);
    }
    
    public static function delete(Monument $monument) : void {
        $db = Database::getConnection(); // Ne pas faire de require_once, à cause du getOne()
        $stmt = $db->prepare('DELETE FROM monument WHERE id =?');
        $stmt->execute([$monument->getId()]);
    }
}
