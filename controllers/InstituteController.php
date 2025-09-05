<?php
require_once 'models/Institute.php';
require_once 'models/Service.php';
require_once 'models/Availability.php';
require_once 'models/Database.php';

class InstituteController {
    private $db;
    private $institute;
    private $service;
    private $availability;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->institute = new Institute($this->db);
        $this->service = new Service($this->db);
        $this->availability = new Availability($this->db);
    }

    public function index() {
        $stmt = $this->institute->read();
        $institutes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/institutes/list.php';
    }

    public function show() {
    $this->institute->id = isset($_GET['id']) ? $_GET['id'] : die('ID manquant');
    
    if (!$this->institute->readOne()) {
        http_response_code(404);
        include 'views/404.php';
        return;
    }
    
    // Récupérer les services de l'institut
    $services_stmt = $this->service->readByInstitute($this->institute->id);
    $services = $services_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Récupérer les disponibilités de l'institut
    $availability_stmt = $this->availability->readByInstitute($this->institute->id);
    $disponibilites = $availability_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Passer les variables à la vue
    $institute = $this->institute;
    include 'views/institutes/show.php';
}

    public function create() {
        if ($_POST) {
            $this->institute->nom = $_POST['nom'];
            $this->institute->slug = generateSlug($_POST['nom']);
            $this->institute->description = $_POST['description'];
            $this->institute->adresse = $_POST['adresse'];
            $this->institute->telephone = $_POST['telephone'];
            $this->institute->email = $_POST['email'];
            $this->institute->image = $_POST['image'];
            $this->institute->themeCouleur = $_POST['themeCouleur'];
            
            if ($this->institute->create()) {
                header("Location: index.php?page=institutes&action=index");
                exit;
            } else {
                $error = "Impossible de créer l'institut.";
            }
        }
        
        include 'views/institutes/create.php';
    }

    public function edit() {
        $this->institute->id = isset($_GET['id']) ? $_GET['id'] : die('ID manquant');
        
        if (!$this->institute->readOne()) {
            http_response_code(404);
            include 'views/404.php';
            return;
        }
        
        if ($_POST) {
            $this->institute->nom = $_POST['nom'];
            $this->institute->slug = generateSlug($_POST['nom']);
            $this->institute->description = $_POST['description'];
            $this->institute->adresse = $_POST['adresse'];
            $this->institute->telephone = $_POST['telephone'];
            $this->institute->email = $_POST['email'];
            $this->institute->image = $_POST['image'];
            $this->institute->themeCouleur = $_POST['themeCouleur'];
            
            if ($this->institute->update()) {
                header("Location: index.php?page=institutes&action=show&id=" . $this->institute->id);
                exit;
            } else {
                $error = "Impossible de mettre à jour l'institut.";
            }
        }
        
        include 'views/institutes/edit.php';
    }

    public function delete() {
        $this->institute->id = isset($_GET['id']) ? $_GET['id'] : die('ID manquant');
        
        if ($this->institute->delete()) {
            header("Location: index.php?page=institutes&action=index");
            exit;
        } else {
            $error = "Impossible de supprimer l'institut.";
            include 'views/institutes/show.php';
        }
    }
}
?>