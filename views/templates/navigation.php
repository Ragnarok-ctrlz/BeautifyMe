<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-spa me-2"></i>BeautifyMe
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=institutes&action=index">Instituts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=services&action=index">Services</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="index.php?page=institutes&action=create" class="btn btn-outline-light me-2">
                    <i class="fas fa-plus me-1"></i> Ajouter un institut
                </a>
                <a href="index.php?page=services&action=create" class="btn btn-outline-light">
                    <i class="fas fa-plus me-1"></i> Ajouter un service
                </a>
            </div>
        </div>
    </div>
</nav>