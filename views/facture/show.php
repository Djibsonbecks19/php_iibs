<div class="container my-5">
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

    <div class="card-header bg-primary text-white py-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 mb-0"><i class="bi bi-receipt me-2"></i>Facture #<?= $facture['commande_id'] ?></h2>
                    <p class="mb-0 opacity-75">Date: <?= date('d/m/Y', strtotime($facture['date_paiement'])) ?></p>
                </div>
                <div class="text-end">
                    <span class="badge bg-white text-primary fs-6 p-2">
                        <?= $facture['statut'] == 'payée' ? 'Payée' : 'En attente' ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">NSA Commande</h5>
                    <p class="mb-1">Médina Rue 10 x 25</p>
                    <p class="mb-1">Dakar, Sénégal</p>
                    <p class="mb-0">Tél: 774142741</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="fw-bold mb-3">Client</h5>
                    <p class="mb-1"><?= $facture['client_prenom'] ?> <?= $facture['client_nom'] ?></p>
                    <p class="mb-0">Livraison: <?= $facture['adresse_livraison'] ?></p>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table">
                    <thead class="bg-light">
                        <tr>
                            <th>Description</th>
                            <th class="text-end">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Commande #<?= $facture['commande_id'] ?></strong>
                                <p class="mb-0 text-muted small">Date commande: <?= date('d/m/Y', strtotime($facture['date_commande'])) ?></p>
                            </td>
                            <td class="text-end"><?= number_format($facture['montant_total'], 0, ',', ' ') ?> FCFA</td>
                        </tr>
                        <tr class="border-top-2">
                            <td class="fw-bold">Total</td>
                            <td class="text-end fw-bold"><?= number_format($facture['montant_total'], 0, ',', ' ') ?> FCFA</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Infos du Paiement et de la Livraison -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3"><i class="bi bi-credit-card me-2"></i>Paiement</h6>
                            <p class="mb-1"><strong>Méthode:</strong> <?= $facture['mode_paiement'] ?></p>
                            <p class="mb-0"><strong>Date:</strong> <?= date('d/m/Y H:i', strtotime($facture['date_paiement'])) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3"><i class="bi bi-truck me-2"></i>Livraison</h6>
                            <p class="mb-1"><strong>Livreur:</strong> <?= $facture['livreur_prenom'] ?> <?= $facture['livreur_nom'] ?></p>
                            <p class="mb-0"><strong>Date prévue:</strong> <?= date('d/m/Y', strtotime($facture['date_livraison'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="small text-muted mb-0">Merci pour votre confiance</p>
                </div>
                <div class="d-flex gap-2">
                    <button onclick="window.print()" class="btn btn-outline-primary">
                        <i class="bi bi-printer me-1"></i> Imprimer
                    </button>
                    <a href="javascript:history.back()" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-top-2 {
        border-top: 2px solid #dee2e6 !important;
    }
</style>