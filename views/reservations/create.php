<?php 
// Vérifier que le service et l'institut existent
if (!isset($service) || !$service || !isset($institute) || !$institute) {
    http_response_code(404);
    include 'views/404.php';
    exit;
}

include 'views/templates/header.php'; 
?>

<div class="container mt-4">
    <h1>Réserver <?php echo htmlspecialchars($service->nom); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($institute->nom); ?></p>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Détails du service</h5>
                    <p class="card-text"><?php echo htmlspecialchars($service->description); ?></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Prix: <?php echo formatPrice($service->prix); ?></li>
                        <li class="list-group-item">Durée: <?php echo formatDuration($service->duree); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Formulaire de réservation</h5>
                    <form action="index.php?page=reservations&action=create&service_id=<?php echo $service->id; ?>" method="post">
                        <input type="hidden" name="service_id" value="<?php echo $service->id; ?>">
                        
                        <div class="mb-3">
                            <label for="nomClient" class="form-label">Nom complet *</label>
                            <input type="text" class="form-control" id="nomClient" name="nomClient" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="emailClient" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="emailClient" name="emailClient" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telephoneClient" class="form-label">Téléphone *</label>
                            <input type="tel" class="form-control" id="telephoneClient" name="telephoneClient" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="dateHeure" class="form-label">Date et heure *</label>
                            <input type="datetime-local" class="form-control" id="dateHeure" name="dateHeure" required>
                            <small class="form-text text-muted">Format: jj/mm/aaaa --:--</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Commentaire (optionnel)</label>
                            <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Réserver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/templates/footer.php'; ?>