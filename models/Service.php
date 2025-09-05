<?php
class Service {
    private $conn;
    private $table_name = "services";

    public $id;
    public $nom;
    public $description;
    public $prix;
    public $duree;
    public $institut_id;
    public $created_at;
    public $institut_nom;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readByInstitute($institut_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE institut_id = ? ORDER BY nom ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $institut_id);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
    $query = "SELECT s.*, i.nom as institut_nom 
              FROM " . $this->table_name . " s 
              LEFT JOIN institutes i ON s.institut_id = i.id 
              WHERE s.id = ? LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $this->nom = $row['nom'];
        $this->description = $row['description'];
        $this->prix = $row['prix'];
        $this->duree = $row['duree'];
        $this->institut_id = $row['institut_id'];
        $this->institut_nom = $row['institut_nom'];  // Assignation de la nouvelle propriété
        $this->created_at = $row['created_at'];
        return true;
    }
    
    return false;
}

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET nom=:nom, description=:description, prix=:prix, 
                duree=:duree, institut_id=:institut_id, created_at=NOW()";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyage des données
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prix = htmlspecialchars(strip_tags($this->prix));
        $this->duree = htmlspecialchars(strip_tags($this->duree));
        $this->institut_id = htmlspecialchars(strip_tags($this->institut_id));
        
        // Liaison des paramètres
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":prix", $this->prix);
        $stmt->bindParam(":duree", $this->duree);
        $stmt->bindParam(":institut_id", $this->institut_id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET nom=:nom, description=:description, prix=:prix, 
                duree=:duree, institut_id=:institut_id
                WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyage des données
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prix = htmlspecialchars(strip_tags($this->prix));
        $this->duree = htmlspecialchars(strip_tags($this->duree));
        $this->institut_id = htmlspecialchars(strip_tags($this->institut_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Liaison des paramètres
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":prix", $this->prix);
        $stmt->bindParam(":duree", $this->duree);
        $stmt->bindParam(":institut_id", $this->institut_id);
        $stmt->bindParam(":id", $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>