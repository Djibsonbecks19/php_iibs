<div class="animate-fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0f172a;">
                <i class="bi bi-shield-check me-2"></i>
                Gestion des Assurances
            </h2>
            <p class="text-muted mb-0">Gérez toutes vos polices d'assurance</p>
        </div>
        <a href="/assurances/create" class="btn btn-custom-primary text-white">
            <i class="bi bi-plus-circle me-2"></i>
            Nouvelle Assurance
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3 p-3">
            <div class="card-custom">
                <div class="card-body text-center">
                    <div class="display-6 mb-2" style="color: #667eea;">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                    <h3 class="fw-bold mb-0"><?= count($assurances) ?></h3>
                    <p class="text-muted mb-0 small">Total Assurances</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 p-3">
            <div class="card-custom">
                <div class="card-body text-center">
                    <div class="display-6 mb-2" style="color: #10b981;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h3 class="fw-bold mb-0">87</h3>
                    <p class="text-muted mb-0 small">Actives</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 p-3">
            <div class="card-custom">
                <div class="card-body text-center">
                    <div class="display-6 mb-2" style="color: #f59e0b;">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <h3 class="fw-bold mb-0">12</h3>
                    <p class="text-muted mb-0 small">En Attente</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 p-3">
            <div class="card-custom">
                <div class="card-body text-center">
                    <div class="display-6 mb-2" style="color: #ef4444;">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <h3 class="fw-bold mb-0">5</h3>
                    <p class="text-muted mb-0 small">Expirées</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card-custom mb-4 p-3">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-custom" placeholder="🔍 Rechercher un client...">
                </div>
                <div class="col-md-3">
                    <select class="form-select form-control-custom">
                        <option>Tous les types</option>
                        <option>Auto</option>
                        <option>Habitation</option>
                        <option>Santé</option>
                        <option>Vie</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-control-custom">
                        <option>Tous les statuts</option>
                        <option>Active</option>
                        <option>En attente</option>
                        <option>Expirée</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-custom-secondary text-white w-100">
                        <i class="bi bi-filter me-2"></i>Filtrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card-custom p-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="px-4 py-3">
                                <input type="checkbox" class="form-check-input">
                            </th>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Client</th>
                            <th class="px-4 py-3">Type Assurance</th>
                            <th class="px-4 py-3">Période</th>
                            <th class="px-4 py-3">Prime</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($assurances as $a):  ?>
                            
                        <tr>
                            <td class="px-4">
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td class="px-4">
                                <span class="badge badge-custom" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    #<?= str_pad($a['id'], 4, '0', STR_PAD_LEFT) ?>
                                </span>
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($a['client']) ?>&background=667eea&color=fff" 
                                         class="rounded-circle me-2" 
                                         width="35" 
                                         height="35" 
                                         alt="Avatar">
                                    <div>
                                        <div class="fw-semibold"><?= htmlspecialchars($a['client']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4">
                                <span class="badge badge-custom bg-info">
                                    <i class="bi bi-bookmark-fill me-1"></i>
                                    <?= htmlspecialchars($a['label']) ?>
                                </span>
                            </td>
                            <td class="px-4">
                                <i class="bi bi-calendar-event me-1"></i>
                                <?= $a['periode'] ?> mois
                            </td>
                            <td class="px-4">
                                <span class="fw-bold text-success">
                                    <?= number_format($a['prime'], 0, ',', ' ') ?> FCFA
                                </span>
                            </td>
                            <td class="px-4 text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="/assurances/show?id=<?= $a['id'] ?>" 
                                       class="btn btn-sm btn-custom-primary text-white" 
                                       style="background: #0ea5e9; color: white;"
                                       title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="/assurances/edit?id=<?= $a['id'] ?>" 
                                       class="btn btn-sm btn-custom-warning text-white"
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/assurances/delete?id=<?= $a['id'] ?>" 
                                       class="btn btn-sm btn-custom-danger text-white" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette assurance ?')"
                                       title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Affichage de 1 à <?= count($assurances) ?> sur <?= count($assurances) ?> résultats
                </div>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Précédent</a>
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

<style>
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: none;
        color: #667eea;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }
</style>