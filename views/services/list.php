<?php include 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Services <?php echo isset($institute) ? "de " . $institute->nom : ""; ?></h1>
        <a href="index.php?page=services&action=create" class="btn btn-primary">Ajouter un service</a>
    </div>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="row">
        <?php if (count($services) > 0): ?>
            <?php foreach ($services as $service): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $service['nom']; ?></h5>
                            <p class="card-text"><?php echo $service['description']; ?></p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Prix: <?php echo $service['prix']; ?> €</li>
                                <li class="list-group-item">Durée: <?php echo $service['duree']; ?> minutes</li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a href="index.php?page=reservations&action=create&service_id=<?php echo $service['id']; ?>" class="btn btn-success">Réserver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">Aucun service disponible pour le moment.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'views/templates/footer.php'; ?>