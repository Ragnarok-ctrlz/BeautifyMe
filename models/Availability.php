<?php
class Availability {
    private $conn;
    private $table_name = "disponibilites";

    public $id;
    public $jour;
    public $heureDebut;
    public $heureFin;
    public $institut_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readByInstitute($institut_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE institut_id = ? ORDER BY 
                  FIELD(jour, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $institut_id);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET jour=:jour, heureDebut=:heureDebut, heureFin=:heureFin, 
                institut_id=:institut_id, created_at=NOW()";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyage des données
        $this->jour = htmlspecialchars(strip_tags($this->jour));
        $this->heureDebut = htmlspecialchars(strip_tags($this->heureDebut));
        $this->heureFin = htmlspecialchars(strip_tags($this->heureFin));
        $this->institut_id = htmlspecialchars(strip_tags($this->institut_id));
        
        // Liaison des paramètres
        $stmt->bindParam(":jour", $this->jour);
        $stmt->bindParam(":heureDebut", $this->heureDebut);
        $stmt->bindParam(":heureFin", $this->heureFin);
        $stmt->bindParam(":institut_id", $this->institut_id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET jour=:jour, heureDebut=:heureDebut, heureFin=:heureFin, 
                institut_id=:institut_id
                WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyage des données
        $this->jour = htmlspecialchars(strip_tags($this->jour));
        $this->heureDebut = htmlspecialchars(strip_tags($this->heureDebut));
        $this->heureFin = htmlspecialchars(strip_tags($this->heureFin));
        $this->institut_id = htmlspecialchars(strip_tags($this->institut_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Liaison des paramètres
        $stmt->bindParam(":jour", $this->jour);
        $stmt->bindParam(":heureDebut", $this->heureDebut);
        $stmt->bindParam(":heureFin", $this->heureFin);
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

    public function deleteByInstitute($institut_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE institut_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $institut_id = htmlspecialchars(strip_tags($institut_id));
        $stmt->bindParam(1, $institut_id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    public function readOne() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $this->jour = $row['jour'];
        $this->heureDebut = $row['heureDebut'];
        $this->heureFin = $row['heureFin'];
        $this->institut_id = $row['institut_id'];
        $this->created_at = $row['created_at'];
        return true;
    }
    
    return false;
}
}
?>