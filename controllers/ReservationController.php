<?php
require_once 'models/Reservation.php';
require_once 'models/Service.php';
require_once 'models/Institute.php';
require_once 'models/Database.php';

class ReservationController {
    private $db;
    private $reservation;
    private $service;
    private $institute;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->reservation = new Reservation($this->db);
        $this->service = new Service($this->db);
        $this->institute = new Institute($this->db);
    }

    public function create() {
    $service_id = isset($_GET['service_id']) ? $_GET['service_id'] : null;
    
    if ($service_id) {
        $this->service->id = $service_id;
        if (!$this->service->readOne()) {
            $error = "Service non trouvé.";
            include 'views/error.php';
            return;
        }
        
        // Récupérer l'institut associé
        $this->institute->id = $this->service->institut_id;
        if (!$this->institute->readOne()) {
            $error = "Institut non trouvé.";
            include 'views/error.php';
            return;
        }
    } else {
        $error = "ID de service manquant.";
        include 'views/error.php';
        return;
    }
    
    // Passer les variables à la vue
    $service = $this->service;
    $institute = $this->institute;
    
    if ($_POST) {
        $this->reservation->nomClient = $_POST['nomClient'];
        $this->reservation->emailClient = $_POST['emailClient'];
        $this->reservation->telephoneClient = $_POST['telephoneClient'];
        $this->reservation->dateHeure = $_POST['dateHeure'];
        $this->reservation->commentaire = $_POST['commentaire'];
        $this->reservation->statut = 'attente';
        $this->reservation->service_id = $_POST['service_id'];
        
        if ($this->reservation->create()) {
            header("Location: index.php?page=reservations&action=confirmation&id=" . $this->db->lastInsertId());
            exit;
        } else {
            $error = "Impossible de créer la réservation.";
        }
    }
    
    include 'views/reservations/create.php';
}

    public function confirmation() {
    $reservation_id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if ($reservation_id) {
        $this->reservation->id = $reservation_id;
        if (!$this->reservation->readOne()) {
            $error = "Réservation non trouvée.";
            include 'views/error.php';
            return;
        }
        
        // Récupérer le service associé
        $this->service->id = $this->reservation->service_id;
        if (!$this->service->readOne()) {
            $error = "Service non trouvé.";
            include 'views/error.php';
            return;
        }
        
        // Récupérer l'institut associé
        $this->institute->id = $this->service->institut_id;
        if (!$this->institute->readOne()) {
            $error = "Institut non trouvé.";
            include 'views/error.php';
            return;
        }
    } else {
        $error = "ID de réservation manquant.";
        include 'views/error.php';
        return;
    }
    
    // Passer les variables à la vue
    $reservation = $this->reservation;
    $service = $this->service;
    $institute = $this->institute;
    
    include 'views/reservations/confirmation.php';
}
}
?>