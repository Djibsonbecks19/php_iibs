<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0 fw-semibold">Liste des Livraisons</h2>
            <a href="?action=createLivraison" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-1"></i> Nouvelle Livraison
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Commande</th>
                            <th>Date Livraison</th>
                            <th>Adresse</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Livreur</th>
                            <th>Paiement</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($livraisons as $livraison): ?>
                        <tr>
                            <td><?= htmlspecialchars($livraison['id']) ?></td>
                            <td>#<?= htmlspecialchars($livraison['commande_id']) ?></td>
                            <td><?= date('d/m/Y', strtotime($livraison['date_livraison'])) ?></td>
                            <td><?= htmlspecialchars($livraison['adresse_livraison']) ?></td>
                            <td><?= number_format($livraison['montant_total'], 2, ',', ' ') ?> FCFA</td>
                            <td>
                                <span class="badge bg-<?= 
                                    $livraison['commande_statut'] === 'Livrée' ? 'success' : 
                                    ($livraison['commande_statut'] === 'En attente' ? 'warning' : 'info') 
                                ?>">
                                    <?= htmlspecialchars($livraison['commande_statut']) ?>
                                </span>
                            </td>
                            <td>
                                <?= htmlspecialchars($livraison['livreur_nom'] . ' ' . $livraison['livreur_prenom']) ?>
                                <br><small class="text-muted"><?= htmlspecialchars($livraison['livreur_telephone']) ?></small>
                            </td>
                            <td>
                                <?php if ($livraison['payée']): ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i> Payée
                                    </span>
                                    <br>
                                    <small class="text-muted">
                                        <?= htmlspecialchars($livraison['mode_paiement']) ?><br>
                                        <?= date('d/m/Y', strtotime($livraison['date_paiement'])) ?>
                                    </small>
                                <?php else: ?>
                                    <span class="badge bg-danger">En attente</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="/livraisons/view/<?= $livraison['id'] ?>" class="btn btn-outline-primary" title="Voir">
                                        <i class="fas fa-eye">Voir</i>
                                    </a>
                                    <a href="/livraisons/edit/<?= $livraison['id'] ?>" class="btn btn-outline-warning" title="Modifier">
                                        <i class="fas fa-edit">Modifier</i>
                                    </a>
                                    <button class="btn btn-outline-danger" title="Supprimer" data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal<?= $livraison['id'] ?>">
                                        <i class="fas fa-trash">Supprimer</i>
                                    </button>
                                </div>
                                
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal<?= $livraison['id'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Confirmer la suppression</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Êtes-vous sûr de vouloir supprimer la livraison #<?= $livraison['id'] ?> ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <a href="/livraisons/delete/<?= $livraison['id'] ?>" class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Affichage de <?= count($livraisons) ?> livraison(s)
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Suivant</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>