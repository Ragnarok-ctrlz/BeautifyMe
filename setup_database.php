<?php
require_once 'config/database.php';

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    // Script SQL de création des tables
    $sql = "
    CREATE TABLE IF NOT EXISTS institutes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        description TEXT,
        adresse VARCHAR(255),
        telephone VARCHAR(20),
        email VARCHAR(255),
        image VARCHAR(255),
        themeCouleur VARCHAR(7) DEFAULT '#007bff',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    
    CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT,
        prix DECIMAL(10, 2) NOT NULL,
        duree INT NOT NULL,
        institut_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (institut_id) REFERENCES institutes(id) ON DELETE CASCADE
    );
    
    CREATE TABLE IF NOT EXISTS disponibilites (
        id INT AUTO_INCREMENT PRIMARY KEY,
        jour ENUM('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche') NOT NULL,
        heureDebut TIME NOT NULL,
        heureFin TIME NOT NULL,
        institut_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (institut_id) REFERENCES institutes(id) ON DELETE CASCADE
    );
    
    CREATE TABLE IF NOT EXISTS reservations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nomClient VARCHAR(255) NOT NULL,
        emailClient VARCHAR(255) NOT NULL,
        telephoneClient VARCHAR(20) NOT NULL,
        dateHeure DATETIME NOT NULL,
        commentaire TEXT,
        statut ENUM('attente', 'confirmee', 'annulee') DEFAULT 'attente',
        service_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
    );
    ";
    
    // Exécution des requêtes
    $conn->exec($sql);
    echo "Base de données et tables créées avec succès!";
    
} catch(PDOException $e) {
    echo "Erreur lors de la création de la base de données: " . $e->getMessage();
}
?>