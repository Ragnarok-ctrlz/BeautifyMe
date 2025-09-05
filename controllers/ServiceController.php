<?php
require_once 'models/Service.php';
require_once 'models/Institute.php';
require_once 'models/Database.php';

class ServiceController {
    private $db;
    private $service;
    private $institute;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->service = new Service($this->db);
        $this->institute = new Institute($this->db);
    }

    public function index() {
        $institute_id = isset($_GET['institute_id']) ? $_GET['institute_id'] : null;
        
        if ($institute_id) {
            $stmt = $this->service->readByInstitute($institute_id);
            $this->institute->id = $institute_id;
            $this->institute->readOne();
        } else {
            $stmt = $this->service->read();
        }
        
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/services/list.php';
    }

    public function create() {
        // Récupérer tous les instituts pour le formulaire
        $institutes_stmt = $this->institute->read();
        $institutes = $institutes_stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($_POST) {
            $this->service->nom = $_POST['nom'];
            $this->service->description = $_POST['description'];
            $this->service->prix = $_POST['prix'];
            $this->service->duree = $_POST['duree'];
            $this->service->institut_id = $_POST['institut_id'];
            
            if ($this->service->create()) {
                header("Location: index.php?page=services&action=index&institute_id=" . $_POST['institut_id']);
            } else {
                $error = "Impossible de créer le service.";
            }
        }
        
        include 'views/services/create.php';
    }
}
?>