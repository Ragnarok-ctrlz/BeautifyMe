<?php
class Reservation {
    private $conn;
    private $table_name = "reservations";

    public $id;
    public $nomClient;
    public $emailClient;
    public $telephoneClient;
    public $dateHeure;
    public $commentaire;
    public $statut;
    public $service_id;
    public $created_at;
    public $service_nom;
    public $institut_nom;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT r.*, s.nom as service_nom, i.nom as institut_nom 
                  FROM " . $this->table_name . " r 
                  LEFT JOIN services s ON r.service_id = s.id 
                  LEFT JOIN institutes i ON s.institut_id = i.id 
                  ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readByService($service_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE service_id = ? ORDER BY dateHeure DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $service_id);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
    $query = "SELECT r.*, s.nom as service_nom, i.nom as institut_nom 
              FROM " . $this->table_name . " r 
              LEFT JOIN services s ON r.service_id = s.id 
              LEFT JOIN institutes i ON s.institut_id = i.id 
              WHERE r.id = ? LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $this->nomClient = $row['nomClient'];
        $this->emailClient = $row['emailClient'];
        $this->telephoneClient = $row['telephoneClient'];
        $this->dateHeure = $row['dateHeure'];
        $this->commentaire = $row['commentaire'];
        $this->statut = $row['statut'];
        $this->service_id = $row['service_id'];
        $this->service_nom = $row['service_nom'];       // Assignation de la nouvelle propriété
        $this->institut_nom = $row['institut_nom'];     // Assignation de la nouvelle propriété
        $this->created_at = $row['created_at'];
        return true;
    }
    
    return false;
}

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET nomClient=:nomClient, emailClient=:emailClient, telephoneClient=:telephoneClient, 
                dateHeure=:dateHeure, commentaire=:commentaire, statut=:statut, 
                service_id=:service_id, created_at=NOW()";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyage des données
        $this->nomClient = htmlspecialchars(strip_tags($this->nomClient));
        $this->emailClient = htmlspecialchars(strip_tags($this->emailClient));
        $this->telephoneClient = htmlspecialchars(strip_tags($this->telephoneClient));
        $this->dateHeure = htmlspecialchars(strip_tags($this->dateHeure));
        $this->commentaire = htmlspecialchars(strip_tags($this->commentaire));
        $this->statut = htmlspecialchars(strip_tags($this->statut));
        $this->service_id = htmlspecialchars(strip_tags($this->service_id));
        
        // Liaison des paramètres
        $stmt->bindParam(":nomClient", $this->nomClient);
        $stmt->bindParam(":emailClient", $this->emailClient);
        $stmt->bindParam(":telephoneClient", $this->telephoneClient);
        $stmt->bindParam(":dateHeure", $this->dateHeure);
        $stmt->bindParam(":commentaire", $this->commentaire);
        $stmt->bindParam(":statut", $this->statut);
        $stmt->bindParam(":service_id", $this->service_id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET nomClient=:nomClient, emailClient=:emailClient, telephoneClient=:telephoneClient, 
                dateHeure=:dateHeure, commentaire=:commentaire, statut=:statut, 
                service_id=:service_id
                WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyage des données
        $this->nomClient = htmlspecialchars(strip_tags($this->nomClient));
        $this->emailClient = htmlspecialchars(strip_tags($this->emailClient));
        $this->telephoneClient = htmlspecialchars(strip_tags($this->telephoneClient));
        $this->dateHeure = htmlspecialchars(strip_tags($this->dateHeure));
        $this->commentaire = htmlspecialchars(strip_tags($this->commentaire));
        $this->statut = htmlspecialchars(strip_tags($this->statut));
        $this->service_id = htmlspecialchars(strip_tags($this->service_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Liaison des paramètres
        $stmt->bindParam(":nomClient", $this->nomClient);
        $stmt->bindParam(":emailClient", $this->emailClient);
        $stmt->bindParam(":telephoneClient", $this->telephoneClient);
        $stmt->bindParam(":dateHeure", $this->dateHeure);
        $stmt->bindParam(":commentaire", $this->commentaire);
        $stmt->bindParam(":statut", $this->statut);
        $stmt->bindParam(":service_id", $this->service_id);
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

    public function deleteByService($service_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE service_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $service_id = htmlspecialchars(strip_tags($service_id));
        $stmt->bindParam(1, $service_id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>