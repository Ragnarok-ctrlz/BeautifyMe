<?php include 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="text-danger">Erreur</h1>
            <p class="lead"><?php echo isset($error) ? $error : "Une erreur s'est produite."; ?></p>
            <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
        </div>
    </div>
</div>

<?php include 'views/templates/footer.php'; ?>