<?php include 'views/templates/header.php'; ?>

<div class="container mt-4">
    <h1>Ajouter un service</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="index.php?page=services&action=create" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du service</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
        </div>
        
        <div class="mb-3">
            <label for="duree" class="form-label">Durée (minutes)</label>
            <input type="number" class="form-control" id="duree" name="duree" required>
        </div>
        
        <div class="mb-3">
            <label for="institut_id" class="form-label">Institut</label>
            <select class="form-control" id="institut_id" name="institut_id" required>
                <option value="">Sélectionnez un institut</option>
                <?php foreach ($institutes as $institut): ?>
                    <option value="<?php echo $institut['id']; ?>"><?php echo $institut['nom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="index.php?page=services&action=index" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include 'views/templates/footer.php'; ?>