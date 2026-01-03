<div class="animate-fade-in">

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-custom">
                <div class="card-body p-0">
                    <div class="p-4" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                        <div class="d-flex align-items-center text-white">
                            <i class="bi bi-pencil-square fs-3 me-3"></i>
                            <div>
                                <h4 class="mb-1">Modifier l'Assurance</h4>
                                <small class="opacity-75">
                                    Contrat #<?= str_pad($assurance['id'], 4, '0', STR_PAD_LEFT) ?> - 
                                    <?= htmlspecialchars($assurance['client']) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <form action="/assurances/edit?id=<?= $assurance['id'] ?>" method="POST">
                            
                            <!-- Client Information Section -->
                            <div class="mb-4">
                                <h5 class="mb-3 pb-2 border-bottom">
                                    <i class="bi bi-person-fill me-2" style="color: #f59e0b;"></i>
                                    Informations Client
                                </h5>
                                
                                <div class="mb-3">
                                    <label class="form-label-custom">
                                        <i class="bi bi-person me-1"></i>
                                        Nom du Client
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="client" 
                                           value="<?= htmlspecialchars($assurance['client']) ?>"
                                           class="form-control form-control-custom" 
                                           required>
                                </div>
                            </div>

                            <!-- Insurance Details Section -->
                            <div class="mb-4">
                                <h5 class="mb-3 pb-2 border-bottom">
                                    <i class="bi bi-shield-fill-check me-2" style="color: #f59e0b;"></i>
                                    Détails de l'Assurance
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">
                                            <i class="bi bi-bookmark me-1"></i>
                                            Type d'Assurance
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="type_assurance_id" class="form-select form-control-custom" required>
                                            <?php foreach($types_assurance as $t): ?>
                                                <option value="<?= $t['id'] ?>" <?= ($t['id'] == $assurance['type_assurance_id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($t['label']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">
                                            <i class="bi bi-calendar-range me-1"></i>
                                            Période (mois)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               name="periode" 
                                               value="<?= htmlspecialchars($assurance['periode']) ?>"
                                               class="form-control form-control-custom" 
                                               min="1"
                                               max="120"
                                               required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label-custom">
                                        <i class="bi bi-cash-coin me-1"></i>
                                        Prime Mensuelle (FCFA)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 12px 0 0 12px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none;">
                                            <i class="bi bi-currency-exchange"></i>
                                        </span>
                                        <input type="number" 
                                               name="prime" 
                                               value="<?= htmlspecialchars($assurance['prime']) ?>"
                                               class="form-control form-control-custom" 
                                               step="0.01"
                                               min="0"
                                               style="border-radius: 0 12px 12px 0;"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Section -->
                            <div class="mb-4">
                                <h5 class="mb-3 pb-2 border-bottom">
                                    <i class="bi bi-toggle-on me-2" style="color: #f59e0b;"></i>
                                    Statut du Contrat
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">
                                            <i class="bi bi-activity me-1"></i>
                                            Statut
                                        </label>
                                        <select name="statut" class="form-select form-control-custom">
                                            <option value="active">Active</option>
                                            <option value="pending">En attente</option>
                                            <option value="expired">Expirée</option>
                                            <option value="cancelled">Annulée</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">
                                            <i class="bi bi-calendar-check me-1"></i>
                                            Date de modification
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-custom" 
                                               value="<?= date('d/m/Y H:i') ?>"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- Warning Alert -->
                            <div class="alert alert-warning d-flex align-items-center mb-4" style="border-radius: 12px; border: none;">
                                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                                <div>
                                    <strong>Attention:</strong> La modification de ces informations peut affecter les paiements et échéances en cours.
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top p-3">
                                <a href="/assurances" class="btn btn-custom-secondary text-white">
                                    <i class="bi bi-x-circle me-2"></i>
                                    Annuler
                                </a>
                                
                                <div>
                                    <button type="button" 
                                            class="btn btn-outline-danger me-2" 
                                            style="border-radius: 12px;"
                                            onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette assurance ?')) window.location.href='/assurances/delete?id=<?= $assurance['id'] ?>'">
                                        <i class="bi bi-trash me-2"></i>
                                        Supprimer
                                    </button>
                                    <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; padding: 0.75rem 1.5rem;">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Enregistrer les Modifications
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- History Card -->
            <div class="card-custom mt-3 p-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-clock-history me-2" style="color: #f59e0b;"></i>
                        Historique des Modifications
                    </h6>
                    <div class="timeline">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-pencil text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-semibold">Modification du contrat</div>
                                <small class="text-muted">Il y a 2 jours par Admin</small>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-success d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-plus text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-semibold">Création du contrat</div>
                                <small class="text-muted">Il y a 1 mois par Secrétaire</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .breadcrumb-item.active {
        color: #f59e0b;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: #f59e0b;
    }
</style>