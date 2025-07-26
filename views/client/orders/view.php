<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Détails de la Commande #<?= str_pad($command['commande_id'], 6, '0', STR_PAD_LEFT) ?></h5>
                <span class="badge bg-white text-primary fs-6">
                    <?= date('d/m/Y H:i', strtotime($command['date_commande'])) ?>
                </span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row g-3 mb-4">
                <!-- Client Info -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-3">
                                <i class="bi bi-person-circle me-2"></i> Client
                            </h6>
                            <p class="mb-1 fw-bold"><?= htmlspecialchars($command['client_nom'] ?? 'Nom Client') ?> <?= htmlspecialchars($command['client_prenom'] ?? '') ?></p>
                            <small class="text-muted">ID Client : <?= $command['client_id'] ?></small>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-3">
                                <i class="bi bi-info-circle me-2"></i> Statut
                            </h6>
                            <span class="badge rounded-pill fs-6 text-bg-<?= 
                                match(strtolower($command['statut'])) {
                                    'en attente' => 'warning',
                                    'payée' => 'success',
                                    'validée' => 'primary',
                                    'expédiée' => 'info',
                                    'annulée' => 'danger',
                                    default => 'secondary'
                                }
                            ?>">
                                <?= ucfirst($command['statut']) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="mb-3">Produits commandés :</h6>

            <div class="list-group mb-4">
                <?php foreach ($command['produits'] as $prod): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-3">
                    <div>
                        <h6 class="mb-1"><?= htmlspecialchars($prod['product_name']) ?></h6>
                        <small class="text-muted">Quantité: <?= $prod['quantite'] ?></small>
                    </div>
                    <div class="fw-bold text-danger">
                        <?= number_format($prod['prix_total'], 0, ',', ' ') ?> FCFA
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="d-flex justify-content-end">
                <div class="fs-4 fw-bold text-primary">
                    Total : <?= number_format($command['montant_total'], 0, ',', ' ') ?> FCFA
                </div>
            </div>
        </div>
        
        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
            <a href="index.php?action=listCommandesClients" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour à la liste
            </a>
            <div>
               <a href="index.php?action=facture&commande_id=<?= $command['commande_id'] ?? '' ?>" class="btn btn-outline-primary me-2">
                    <i class="bi bi-printer me-1"></i> Imprimer
                </a>

                <a href="#" class="btn btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</div>
