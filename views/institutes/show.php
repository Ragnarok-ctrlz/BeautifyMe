<?php 
// Vérifier que l'institut existe avant d'afficher la page
if (!isset($institute) || !$institute) {
    http_response_code(404);
    include 'views/404.php';
    exit;
}

include 'views/templates/header.php'; 
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?page=institutes&action=index">Instituts</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($institute->nom); ?></li>
        </ol>
    </nav>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <?php if (!empty($institute->image)): ?>
                    <img src="<?php echo htmlspecialchars($institute->image); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($institute->nom); ?>" style="height: 300px; object-fit: cover;">
                <?php else: ?>
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="fas fa-spa fa-5x text-light"></i>
                    </div>
                <?php endif; ?>
                
                <div class="card-body">
                    <h1 class="card-title"><?php echo htmlspecialchars($institute->nom); ?></h1>
                    <p class="card-text"><?php echo htmlspecialchars($institute->description); ?></p>
                    
                    <div class="mt-4">
                        <h4>Informations de contact</h4>
                        <p><i class="fas fa-map-marker-alt"></i> <strong>Adresse:</strong> <?php echo htmlspecialchars($institute->adresse); ?></p>
                        <p><i class="fas fa-phone"></i> <strong>Téléphone:</strong> <?php echo htmlspecialchars($institute->telephone); ?></p>
                        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <?php echo htmlspecialchars($institute->email); ?></p>
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="index.php?page=institutes&action=edit&id=<?php echo $institute->id; ?>" class="btn btn-secondary">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="index.php?page=institutes&action=delete&id=<?php echo $institute->id; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet institut?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </a>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Services proposés</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($services) && count($services) > 0): ?>
                        <div class="row">
                            <?php foreach ($services as $service): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 service-card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($service['nom']); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($service['description']); ?></p>
                                            <p class="card-text">
                                                <strong>Prix:</strong> <?php echo formatPrice($service['prix']); ?><br>
                                                <strong>Durée:</strong> <?php echo formatDuration($service['duree']); ?>
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="index.php?page=reservations&action=create&service_id=<?php echo $service['id']; ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-calendar-check"></i> Réserver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Aucun service disponible pour le moment.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Horaires d'ouverture</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($disponibilites) && count($disponibilites) > 0): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($disponibilites as $disponibilite): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-capitalize"><?php echo htmlspecialchars($disponibilite['jour']); ?></span>
                                    <span><?php echo substr($disponibilite['heureDebut'], 0, 5); ?> - <?php echo substr($disponibilite['heureFin'], 0, 5); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Les horaires ne sont pas encore définis.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <<!-- Dans la section des actions -->
            <div class="card">
                <div class="card-header">
                    <h4>Actions</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="index.php?page=services&action=create&institute_id=<?php echo $institute->id; ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Ajouter un service
                        </a>
                        <a href="index.php?page=availability&action=create&institute_id=<?php echo $institute->id; ?>" class="btn btn-secondary">
                            <i class="fas fa-clock"></i> Gérer les horaires
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/templates/footer.php'; ?>