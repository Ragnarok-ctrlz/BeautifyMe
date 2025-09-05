<?php
require_once 'models/Availability.php';
require_once 'models/Institute.php';
require_once 'models/Database.php';

class AvailabilityController {
    private $db;
    private $availability;
    private $institute;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->availability = new Availability($this->db);
        $this->institute = new Institute($this->db);
    }

    public function create() {
        $institute_id = isset($_GET['institute_id']) ? $_GET['institute_id'] : null;
        
        if ($institute_id) {
            $this->institute->id = $institute_id;
            if (!$this->institute->readOne()) {
                $error = "Institut non trouvé.";
                include 'views/error.php';
                return;
            }
        } else {
            $error = "ID de l'institut manquant.";
            include 'views/error.php';
            return;
        }
        
        if ($_POST) {
            $this->availability->jour = $_POST['jour'];
            $this->availability->heureDebut = $_POST['heureDebut'];
            $this->availability->heureFin = $_POST['heureFin'];
            $this->availability->institut_id = $institute_id;
            
            if ($this->availability->create()) {
                header("Location: index.php?page=institutes&action=show&id=" . $institute_id);
                exit;
            } else {
                $error = "Impossible de créer la disponibilité.";
            }
        }
        
        // Passer les variables à la vue
        $institute = $this->institute;
        include 'views/availability/create.php';
    }

    public function edit() {
        $availability_id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if ($availability_id) {
            $this->availability->id = $availability_id;
            // Note: Vous devrez ajouter une méthode readOne() au modèle Availability
            if (!$this->availability->readOne()) {
                $error = "Disponibilité non trouvée.";
                include 'views/error.php';
                return;
            }
            
            $this->institute->id = $this->availability->institut_id;
            if (!$this->institute->readOne()) {
                $error = "Institut non trouvé.";
                include 'views/error.php';
                return;
            }
        } else {
            $error = "ID de disponibilité manquant.";
            include 'views/error.php';
            return;
        }
        
        if ($_POST) {
            $this->availability->jour = $_POST['jour'];
            $this->availability->heureDebut = $_POST['heureDebut'];
            $this->availability->heureFin = $_POST['heureFin'];
            
            if ($this->availability->update()) {
                header("Location: index.php?page=institutes&action=show&id=" . $this->availability->institut_id);
                exit;
            } else {
                $error = "Impossible de mettre à jour la disponibilité.";
            }
        }
        
        // Passer les variables à la vue
        $availability = $this->availability;
        $institute = $this->institute;
        include 'views/availability/edit.php';
    }

    public function delete() {
        $availability_id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if ($availability_id) {
            $this->availability->id = $availability_id;
            // Note: Vous devrez ajouter une méthode readOne() au modèle Availability
            if ($this->availability->readOne()) {
                $institute_id = $this->availability->institut_id;
                
                if ($this->availability->delete()) {
                    header("Location: index.php?page=institutes&action=show&id=" . $institute_id);
                    exit;
                } else {
                    $error = "Impossible de supprimer la disponibilité.";
                }
            } else {
                $error = "Disponibilité non trouvée.";
            }
        } else {
            $error = "ID de disponibilité manquant.";
        }
        
        if (isset($error)) {
            include 'views/error.php';
        }
    }
}
?>