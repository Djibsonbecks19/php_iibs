<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Mes Commandes</h2>
            <p class="text-muted">Historique de toutes vos commandes</p>
        </div>
        <a href="index.php?action=addCommand" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle Commande
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Commande</th>
                            <th>Client</th>
                            <th>Produit</th>
                            <th class="text-end">Montant</th>
                            <th class="text-center">Statut</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commands as $command): ?>
                        <tr class="position-relative">
                            <td class="ps-4">
                                <div class="fw-semibold">#<?= str_pad($command['id'], 6, '0', STR_PAD_LEFT) ?></div>
                                <small class="text-muted"><?= date('d/m/Y H:i', strtotime($command['date_commande'])) ?></small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width:36px;height:36px;">
                                            <?= strtoupper(substr($command['prenom'], 0, 1)) ?>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <?= htmlspecialchars($command['nom'] . ' ' . $command['prenom']) ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="flex-grow-1">
                                        <?= htmlspecialchars($command['produits_noms']) ?>
                                        <div class="text-muted small">Qty: <?= $command['total_produits'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end fw-bold">
                                <?= number_format($command['montant_total'], 2) ?> FCFA
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill text-bg-<?= 
                                    match(strtolower($command['statut'])) {
                                        'en attente' => 'warning',
                                        'payée' => 'success',
                                        'validée' => 'primary',
                                        'expédiée' => 'info',
                                        'annulée' => 'danger',
                                        default => 'secondary'
                                    }
                                ?>">
                                    <?= $command['statut'] ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="index.php?action=viewCommand&id=<?= $command['id'] ?>" 
                                       class="btn btn-outline-primary" 
                                       data-bs-toggle="tooltip" 
                                       title="Voir détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <?php if ($_SESSION["role"] != 'client'): ?>
                                    <a href="index.php?action=editCommand&id=<?= $command['id'] ?>" 
                                       class="btn btn-outline-secondary"
                                       data-bs-toggle="tooltip" 
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button onclick="confirmDelete('index.php?action=deleteCommand&id=<?= $command['id'] ?>')" 
                                            class="btn btn-outline-danger"
                                            data-bs-toggle="tooltip" 
                                            title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (empty($commands)): ?>
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body text-center py-5">
            <i class="bi bi-receipt text-muted" style="font-size: 3rem;"></i>
            <h4 class="mt-3">Aucune commande trouvée</h4>
            <p class="text-muted mb-4">Vous n'avez pas encore passé de commande</p>
            <a href="index.php?action=addCommand" class="btn btn-primary px-4">
                <i class="bi bi-plus-circle"></i> Créer une commande
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
    function confirmDelete(url) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette commande ?")) {
            window.location.href = url;
        }
    }
    
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<style>
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    .badge.text-bg-primary {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }
    .badge.text-bg-success {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    .badge.text-bg-warning {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    .badge.text-bg-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    .badge.text-bg-info {
        background-color: rgba(13, 202, 240, 0.1);
        color: #0dcaf0;
    }
</style>