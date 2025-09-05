<?php
class Institute {
    private $conn;
    private $table_name = "institutes";

    public $id;
    public $nom;
    public $slug;
    public $description;
    public $adresse;
    public $telephone;
    public $email;
    public $image;
    public $themeCouleur;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

  public function read() {
    $query = "SELECT * FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}
   public function readOne() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $this->nom = $row['nom'];
        $this->slug = $row['slug'];
        $this->description = $row['description'];
        $this->adresse = $row['adresse'];
        $this->telephone = $row['telephone'];
        $this->email = $row['email'];
        $this->image = $row['image'];
        $this->themeCouleur = $row['themeCouleur'];
        return true;
    }
    
    return false;
}

    public function readBySlug() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE slug = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->slug);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->slug = $row['slug'];
            $this->description = $row['description'];
            $this->adresse = $row['adresse'];
            $this->telephone = $row['telephone'];
            $this->email = $row['email'];
            $this->image = $row['image'];
            $this->themeCouleur = $row['themeCouleur'];
            $this->created_at = $row['created_at'];
            return true;
        }
        
        return false;
    }

    public function create() {
    $query = "INSERT INTO " . $this->table_name . "
            SET nom=:nom, slug=:slug, description=:description, 
            adresse=:adresse, telephone=:telephone, email=:email, 
            image=:image, themeCouleur=:themeCouleur";
    
    $stmt = $this->conn->prepare($query);
    
    // Nettoyage des données
    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->slug = htmlspecialchars(strip_tags($this->slug));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->adresse = htmlspecialchars(strip_tags($this->adresse));
    $this->telephone = htmlspecialchars(strip_tags($this->telephone));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->image = htmlspecialchars(strip_tags($this->image));
    $this->themeCouleur = htmlspecialchars(strip_tags($this->themeCouleur));
    
    // Liaison des paramètres
    $stmt->bindParam(":nom", $this->nom);
    $stmt->bindParam(":slug", $this->slug);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":adresse", $this->adresse);
    $stmt->bindParam(":telephone", $this->telephone);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":themeCouleur", $this->themeCouleur);
    
    if ($stmt->execute()) {
        return true;
    }
    
    return false;
}

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET nom=:nom, slug=:slug, description=:description, 
                adresse=:adresse, telephone=:telephone, email=:email, 
                image=:image, themeCouleur=:themeCouleur
                WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyage des données
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->slug = htmlspecialchars(strip_tags($this->slug));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->adresse = htmlspecialchars(strip_tags($this->adresse));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->themeCouleur = htmlspecialchars(strip_tags($this->themeCouleur));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Liaison des paramètres
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":slug", $this->slug);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":adresse", $this->adresse);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":themeCouleur", $this->themeCouleur);
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