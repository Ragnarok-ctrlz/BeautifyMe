<?php 
// Vérifier que les variables nécessaires existent
if (!isset($reservation) || !$reservation || !isset($service) || !$service || !isset($institute) || !$institute) {
    http_response_code(404);
    include 'views/404.php';
    exit;
}

include 'views/templates/header.php'; 
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <h2>Réservation confirmée</h2>
                </div>
                <div class="card-body">
                    <div class="alert alert-success text-center">
                        <h4 class="alert-heading">Merci pour votre réservation !</h4>
                        <p>Votre réservation a été enregistrée avec succès.</p>
                    </div>

                    <h4 class="mt-4">Détails de la réservation</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Réservation #</th>
                            <td><?php echo htmlspecialchars($reservation->id); ?></td>
                        </tr>
                        <tr>
                            <th>Service</th>
                            <td><?php echo htmlspecialchars($service->nom); ?></td>
                        </tr>
                        <tr>
                            <th>Institut</th>
                            <td><?php echo htmlspecialchars($institute->nom); ?></td>
                        </tr>
                        <tr>
                            <th>Date et heure</th>
                            <td>
                                <?php 
                                if ($reservation->dateHeure) {
                                    echo date('d/m/Y H:i', strtotime($reservation->dateHeure));
                                } else {
                                    echo 'Non spécifié';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Nom du client</th>
                            <td><?php echo htmlspecialchars($reservation->nomClient); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($reservation->emailClient); ?></td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><?php echo htmlspecialchars($reservation->telephoneClient); ?></td>
                        </tr>
                        <tr>
                            <th>Statut</th>
                            <td>
                                <span class="badge bg-<?php 
                                switch($reservation->statut) {
                                    case 'confirmee': echo 'success'; break;
                                    case 'annulee': echo 'danger'; break;
                                    default: echo 'warning';
                                } ?>">
                                    <?php echo htmlspecialchars($reservation->statut); ?>
                                </span>
                            </td>
                        </tr>
                    </table>

                    <div class="text-center mt-4">
                        <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/templates/footer.php'; ?>