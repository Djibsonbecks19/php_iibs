<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Détails de la Commande #<?= htmlspecialchars($command['commande_id']) ?></h5>
                <span class="badge bg-white text-primary fs-6">
                    <?= date('d/m/Y H:i', strtotime($command['date_commande'])) ?>
                </span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row g-3">

                <!-- Client Section -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-3">
                                <i class="bi bi-person-circle me-2"></i>Client
                            </h6>
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width:40px;height:40px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0 fw-bold">Client ID: <?= htmlspecialchars($command['client_id']) ?></p>
                                    <small class="text-muted">Informations client</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Products Section: affichage détaillé -->
                <div class="col-12">
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-3">
                                <i class="bi bi-box-seam me-2"></i>Produits commandés (<?= count($command['produits']) ?>)
                            </h6>

                            <?php foreach ($command['produits'] as $prod): ?>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= htmlspecialchars($prod['product_image']) ?>" 
                                         alt="<?= htmlspecialchars($prod['product_name']) ?>" 
                                         style="width:50px; height:50px; object-fit:cover; border-radius:5px;">
                                    <div class="ms-3">
                                        <p class="mb-0 fw-bold"><?= htmlspecialchars($prod['product_name']) ?></p>
                                        <small class="text-muted">
                                            Quantité : <?= (int)$prod['quantite'] ?> - 
                                            Prix total : <?= number_format($prod['prix_total'], 0, ',', ' ') ?> FCFA
                                        </small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Status Section -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-3">
                                <i class="bi bi-info-circle me-2"></i>Statut
                            </h6>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-pill fs-6 text-bg-<?= 
                                    match(strtolower($command['statut'])) {
                                        'en attente' => 'warning',
                                        'validée' => 'success',
                                        'expédiée' => 'info',
                                        'livrée' => 'primary',
                                        'annulée' => 'danger',
                                        default => 'secondary'
                                    }
                                ?>">
                                    <?= htmlspecialchars($command['statut']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Amount Section -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-3">
                                <i class="bi bi-currency-exchange me-2"></i>Montant
                            </h6>
                            <h4 class="text-primary fw-bold">
                                <?= number_format($command['montant_total'], 2, ',', ' ') ?> FCFA
                            </h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
            <a href="index.php?action=listCommands" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour à la liste
            </a>
            <div>
                <a href="#" class="btn btn-outline-primary me-2">
                    <i class="bi bi-printer me-1"></i> Imprimer
                </a>
                <a href="#" class="btn btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</div>
