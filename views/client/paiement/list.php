<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">
                <i class="bi bi-credit-card text-primary me-2"></i> Historique de Paiements
            </h1>
            <p class="text-muted mb-0">Tous vos paiements enregistrés</p>
        </div>
        <a href="index.php?action=listeProduitsClients" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i> Retour boutique
        </a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Paiement réussi !</strong> Votre paiement a été enregistré.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($paiements)): ?>
        <div class="card border-0 shadow-sm rounded-3 text-center py-5">
            <div class="card-body">
                <i class="bi bi-credit-card text-muted" style="font-size: 3rem;"></i>
                <h5 class="mt-3">Aucun paiement enregistré</h5>
                <p class="text-muted">Vous n'avez effectué aucun paiement pour le moment.</p>
                <a href="index.php?action=listeProduitsClients" class="btn btn-primary mt-2">
                    <i class="bi bi-cart me-1"></i> Faire des achats
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($paiements as $paiement): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-muted mb-1">Réf. #<?= htmlspecialchars($paiement['id']) ?></h6>
                                    <small class="text-muted"><?= date('d/m/Y H:i', strtotime($paiement['date_paiement'])) ?></small>
                                </div>
                                <h5 class="fw-bold text-dark">CMD-<?= htmlspecialchars($paiement['commande_id']) ?></h5>
                                <p class="mb-1 text-muted">Montant : 
                                    <span class="fw-semibold text-danger">
                                        <?= number_format($paiement['montant'], 0, ',', ' ') ?> FCFA
                                    </span>
                                </p>
                                <p class="mb-1 text-muted">Méthode : 
                                    <span class="badge bg-light text-dark border small">
                                        <i class="bi bi-<?= getPaymentIcon($paiement['mode_paiement']) ?> me-1"></i>
                                        <?= htmlspecialchars($paiement['mode_paiement']) ?>
                                    </span>
                                </p>
                                <p class="mb-1 text-muted">Statut : 
                                    <span class="badge bg-<?= getStatusColor($paiement['commande_statut']) ?> px-3">
                                        <?= htmlspecialchars($paiement['commande_statut']) ?>
                                    </span>
                                </p>
                            </div>
                            <a href="index.php?action=facture&commande_id=<?= $paiement['commande_id'] ?>" class="btn btn-sm btn-outline-primary w-100 mt-auto">
                                <i class="bi bi-receipt"></i> Voir la facture
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php

function getPaymentIcon($method) {
    switch ($method) {
        case 'Carte Bancaire': return 'credit-card';
        case 'Mobile Money': return 'phone';
        case 'Espèces': return 'cash';
        default: return 'wallet';
    }
}

function getStatusColor($status) {
    switch ($status) {
        case 'en attente': return 'warning';
        case 'payée': return 'success';
        case 'validée': return 'primary';
        case 'livrée': return 'primary';
        default: return 'secondary';
    }
}
?>