<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="bi bi-truck text-primary me-2"></i>Mes Livraisons
        </h1>
        <a href="index.php?action=listProduitsClients" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i> Retour boutique
        </a>
    </div>

    <?php if (empty($livraisons)): ?>
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body text-center py-5">
                <i class="bi bi-truck text-muted" style="font-size: 3rem;"></i>
                <h5 class="mt-3">Aucune livraison en cours</h5>
                <p class="text-muted">Vous n'avez aucune commande en livraison pour le moment.</p>
                <a href="index.php?action=listProduitsClients" class="btn btn-primary mt-2">
                    <i class="bi bi-cart me-1"></i> Faire des achats
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($livraisons as $livraison): ?>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 rounded-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="badge bg-<?= getStatusColor($livraison['commande_statut']) ?> mb-2">
                                        <?= htmlspecialchars($livraison['commande_statut']) ?>
                                    </span>
                                    <h5 class="mb-1">Commande #<?= htmlspecialchars($livraison['commande_id']) ?></h5>
                                    <small class="text-muted">
                                        Livraison prévue: <?= date('d/m/Y', strtotime($livraison['date_livraison'])) ?>
                                    </small>
                                </div>
                                <span class="fs-4 fw-bold"><?= number_format($livraison['montant_total'], 0, ',', ' ') ?> FCFA</span>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle p-2 me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Adresse de livraison</h6>
                                    <p class="mb-0"><?= htmlspecialchars($livraison['adresse_livraison']) ?></p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle p-2 me-3">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Livreur</h6>
                                    <p class="mb-0">
                                        <?= htmlspecialchars($livraison['livreur_prenom'] . ' ' . $livraison['livreur_nom']) ?>
                                        <span class="text-muted ms-2">
                                            <i class="bi bi-telephone"></i> <?= htmlspecialchars($livraison['livreur_telephone']) ?>
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <?php if ($livraison['commande_statut'] == 'Validée' && empty($livraison['paiement_id'])): ?>
                                <a href="index.php?action=processPayment&commande_id=<?= $livraison['commande_id'] ?>" 
                                   class="btn btn-success w-100 mt-2">
                                    <i class="bi bi-credit-card me-1"></i> Payer maintenant
                                </a>
                            <?php elseif ($livraison['payée'] == 1): ?>
                                <div class="alert alert-success mt-3 mb-0">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Payé le <?= date('d/m/Y', strtotime($livraison['date_paiement'])) ?> 
                                    (<?= htmlspecialchars($livraison['mode_paiement']) ?>)
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
function getStatusColor($status) {
    switch ($status) {
        case 'en attente': return 'warning';
        case 'payée': return 'success';
        case 'validée': return 'primary';
        case 'livrée': return 'success';
        default: return 'secondary';
    }
}
?>