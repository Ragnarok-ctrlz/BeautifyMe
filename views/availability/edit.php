<?php 
// Vérifier que l'institut et la disponibilité existent
if (!isset($institute) || !$institute || !isset($availability) || !$availability) {
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
            <li class="breadcrumb-item active">Modifier les horaires</li>
        </ol>
    </nav>

    <h1>Modifier les horaires pour <?php echo htmlspecialchars($institute->nom); ?></h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="index.php?page=availability&action=edit&id=<?php echo $availability->id; ?>" method="post">
        <div class="mb-3">
            <label for="jour" class="form-label">Jour *</label>
            <select class="form-control" id="jour" name="jour" required>
                <option value="lundi" <?php echo $availability->jour == 'lundi' ? 'selected' : ''; ?>>Lundi</option>
                <option value="mardi" <?php echo $availability->jour == 'mardi' ? 'selected' : ''; ?>>Mardi</option>
                <option value="mercredi" <?php echo $availability->jour == 'mercredi' ? 'selected' : ''; ?>>Mercredi</option>
                <option value="jeudi" <?php echo $availability->jour == 'jeudi' ? 'selected' : ''; ?>>Jeudi</option>
                <option value="vendredi" <?php echo $availability->jour == 'vendredi' ? 'selected' : ''; ?>>Vendredi</option>
                <option value="samedi" <?php echo $availability->jour == 'samedi' ? 'selected' : ''; ?>>Samedi</option>
                <option value="dimanche" <?php echo $availability->jour == 'dimanche' ? 'selected' : ''; ?>>Dimanche</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="heureDebut" class="form-label">Heure de début *</label>
            <input type="time" class="form-control" id="heureDebut" name="heureDebut" value="<?php echo htmlspecialchars($availability->heureDebut); ?>" required>
        </div>

        <div class="mb-3">
            <label for="heureFin" class="form-label">Heure de fin *</label>
            <input type="time" class="form-control" id="heureFin" name="heureFin" value="<?php echo htmlspecialchars($availability->heureFin); ?>" required>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="index.php?page=institutes&action=show&id=<?php echo $institute->id; ?>" class="btn btn-secondary me-md-2">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>

<?php include 'views/templates/footer.php'; ?>