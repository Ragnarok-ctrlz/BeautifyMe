<?php include 'views/templates/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Liste des Instituts</h1>
    
    <a href="index.php?page=institutes&action=create" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Créer un institut
    </a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="row">
        <?php if (count($institutes) > 0): ?>
            <?php foreach ($institutes as $institute): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 institute-card">
                        <?php if (!empty($institute['image'])): ?>
                            <img src="<?php echo $institute['image']; ?>" class="card-img-top" alt="<?php echo $institute['nom']; ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-spa fa-3x text-light"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $institute['nom']; ?></h5>
                            <p class="card-text"><?php echo substr($institute['description'], 0, 100); ?>...</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> <?php echo $institute['adresse']; ?>
                                </small>
                            </p>
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <a href="index.php?page=institutes&action=show&id=<?php echo $institute['id']; ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Voir détails
                            </a>
                            <a href="index.php?page=institutes&action=edit&id=<?php echo $institute['id']; ?>" class="btn btn-secondary btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">
                    Aucun institut disponible pour le moment.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'views/templates/footer.php'; ?>