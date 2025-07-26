<?php
    $groupedOrders = [];

    foreach ($orders as $order) {
        $id = $order['commande_id'];

        if (!isset($groupedOrders[$id])) {
            $groupedOrders[$id] = [
                'commande_id' => $id,
                'date_commande' => $order['date_commande'],
                'montant_total' => $order['montant_total'],
                'statut' => $order['statut'],
                'produits' => []
            ];
        }

        $groupedOrders[$id]['produits'][] = [
            'nom' => $order['product_name'],
            'quantite' => $order['quantite'],
            'prix_total' => $order['prix_total']
        ];
    }
?>

<div class="container-fluid px-5">
    <div class="row flex-nowrap flex-md-wrap overflow-auto pb-3">

        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="h3 mb-0">
                <i class="bi bi-truck text-primary me-2"></i>Mes Commandes
            </h1>
            <a href="index.php?action=listProduitsClients" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i> Retour boutique
            </a>
        </div>
        <?php foreach ($groupedOrders as $commande): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 px-2">
            <div class="card h-100 shadow-sm border-0 rounded-3 hover-shadow transition-all">
                <div class="card-header bg-white border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark fs-6 fw-normal">
                            #<?= str_pad($commande['commande_id'], 6, '0', STR_PAD_LEFT) ?>
                        </span>
                        <small class="text-muted"><?= date('d M', strtotime($commande['date_commande'])) ?></small>
                    </div>
                </div>
                
                <div class="card-body pt-2 pb-1">
                    <div class="mb-2">
                        <?php foreach ($commande['produits'] as $prod): ?>
                        <div class="mb-2 pb-2 border-bottom">
                            <h6 class="mb-1 fw-semibold text-truncate"><?= htmlspecialchars($prod['nom']) ?></h6>
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">Qty: <?= $prod['quantite'] ?></span>
                                <span class="fw-medium"><?= number_format($prod['prix_total'], 0, ',', ' ') ?> FCFA</span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <?php
                                $statusClass = [
                                    'en attente' => 'warning',
                                    'payée' => 'success',
                                    'validée' => 'primary',
                                    'expédiée' => 'info',
                                    'livrée' => 'dark',
                                    'annulée' => 'danger'
                                ][strtolower($commande['statut'])] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?= $statusClass ?> rounded-1 px-2 py-1">
                                <?= ucfirst($commande['statut']) ?>
                            </span>
                        </div>
                        <span class="fw-bold text-dark"><?= number_format($commande['montant_total'], 0, ',', ' ') ?> FCFA</span>
                    </div>
                    <a href="index.php?action=viewOrder&id=<?= $commande['commande_id'] ?>" 
                       class="btn btn-sm w-100 mt-2 btn-outline-primary rounded-1">
                        Voir détail
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>