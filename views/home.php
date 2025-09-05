<?php include 'views/templates/header.php'; ?>

<div class="hero-section">
    <div class="container">
        <h1 class="display-4">Bienvenue sur BeautifyMe</h1>
        <p class="lead">La plateforme de réservation pour instituts de beauté</p>
        <a href="index.php?page=institutes&action=index" class="btn btn-primary btn-lg">Découvrir les instituts</a>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Instituts de qualité</h5>
                    <p class="card-text">Découvrez les meilleurs instituts de beauté près de chez vous.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Réservation facile</h5>
                    <p class="card-text">Réservez vos soins en quelques clics, sans compte.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Disponibilités en temps réel</h5>
                    <p class="card-text">Consultez les créneaux disponibles en direct.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h2>Comment ça marche</h2>
        </div>
        <div class="col-md-6">
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">Choisissez un institut</li>
                <li class="list-group-item">Sélectionnez un service</li>
                <li class="list-group-item">Choisissez un créneau</li>
                <li class="list-group-item">Remplissez vos informations</li>
                <li class="list-group-item">Confirmez votre réservation</li>
            </ol>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-mobile-alt fa-5x text-primary mb-3"></i>
                    <p>Une interface simple et intuitive pour une expérience utilisateur optimale.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/templates/footer.php'; ?>