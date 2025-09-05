<?php include 'views/templates/header.php'; ?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?page=institutes&action=index">Instituts</a></li>
            <li class="breadcrumb-item active">Créer un institut</li>
        </ol>
    </nav>
    
    <h1 class="mb-4">Créer un institut</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="index.php?page=institutes&action=create" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'institut *</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse *</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone *</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Image (URL)</label>
                    <input type="url" class="form-control" id="image" name="image">
                </div>
                
                <div class="mb-3">
                    <label for="themeCouleur" class="form-label">Couleur principale</label>
                    <input type="color" class="form-control form-control-color" id="themeCouleur" name="themeCouleur" value="#007bff" title="Choisissez une couleur">
                </div>
            </div>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="index.php?page=institutes&action=index" class="btn btn-secondary me-md-2">Annuler</a>
            <button type="submit" class="btn btn-primary">Créer l'institut</button>
        </div>
    </form>
</div>

<?php include 'views/templates/footer.php'; ?>