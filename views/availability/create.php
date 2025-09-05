<?php 
// Vérifier que l'institut existe
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
            <li class="breadcrumb-item"><a href="index.php?page=institutes&action=show&id=<?php echo $institute->id; ?>"><?php echo htmlspecialchars($institute->nom); ?></a></li>
            <li class="breadcrumb-item active">Ajouter des horaires</li>
        </ol>
    </nav>

    <h1>Ajouter des horaires pour <?php echo htmlspecialchars($institute->nom); ?></h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="index.php?page=availability&action=create&institute_id=<?php echo $institute->id; ?>" method="post">
        <div class="mb-3">
            <label for="jour" class="form-label">Jour *</label>
            <select class="form-control" id="jour" name="jour" required>
                <option value="">Sélectionnez un jour</option>
                <option value="lundi">Lundi</option>
                <option value="mardi">Mardi</option>
                <option value="mercredi">Mercredi</option>
                <option value="jeudi">Jeudi</option>
                <option value="vendredi">Vendredi</option>
                <option value="samedi">Samedi</option>
                <option value="dimanche">Dimanche</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="heureDebut" class="form-label">Heure de début *</label>
            <input type="time" class="form-control" id="heureDebut" name="heureDebut" required>
        </div>

        <div class="mb-3">
            <label for="heureFin" class="form-label">Heure de fin *</label>
            <input type="time" class="form-control" id="heureFin" name="heureFin" required>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="index.php?page=institutes&action=show&id=<?php echo $institute->id; ?>" class="btn btn-secondary me-md-2">Annuler</a>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>

<?php include 'views/templates/footer.php'; ?>