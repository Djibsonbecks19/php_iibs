<div class="animate-fade-in">
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/assurances" class="text-decoration-none">Assurances</a></li>
                <li class="breadcrumb-item active">Nouvelle Assurance</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-custom">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-plus-circle-fill fs-4 me-3"></i>
                        <div>
                            <h4 class="mb-0">Créer une Nouvelle Assurance</h4>
                            <small class="opacity-75">Remplissez les informations ci-dessous</small>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="/assurances/create" method="POST">
                        
                        <!-- Client Information Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom">
                                <i class="bi bi-person-fill me-2" style="color: #667eea;"></i>
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
                                       class="form-control form-control-custom" 
                                       placeholder="Ex: Jean Dupont"
                                       required>
                                <small class="text-muted">Entrez le nom complet du client</small>
                            </div>
                        </div>

                        <!-- Insurance Details Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom">
                                <i class="bi bi-shield-fill-check me-2" style="color: #667eea;"></i>
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
                                        <option value="">-- Sélectionner un type --</option>
                                        <?php foreach($types_assurance as $t): ?>
                                            <option value="<?= $t['id'] ?>">
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
                                           class="form-control form-control-custom" 
                                           placeholder="Ex: 12"
                                           min="1"
                                           max="120"
                                           required>
                                    <small class="text-muted">Durée du contrat en mois</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">
                                    <i class="bi bi-cash-coin me-1"></i>
                                    Prime Mensuelle (FCFA)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-currency-exchange"></i>
                                    </span>
                                    <input type="number" 
                                           name="prime" 
                                           class="form-control form-control-custom" 
                                           placeholder="Ex: 50000"
                                           step="0.01"
                                           min="0"
                                           style="border-radius: 0 12px 12px 0;"
                                           required>
                                </div>
                                <small class="text-muted">Montant de la prime à payer mensuellement</small>
                            </div>
                        </div>



                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="/assurances" class="btn btn-custom-secondary text-white">
                                <i class="bi bi-x-circle me-2"></i>
                                Annuler
                            </a>
                            
                            <div>
                                <button type="reset" class="btn btn-outline-secondary me-2" style="border-radius: 12px;">
                                    <i class="bi bi-arrow-clockwise me-2"></i>
                                    Réinitialiser
                                </button>
                                <button type="submit" class="btn btn-custom-success text-white">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Enregistrer l'Assurance
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="card-custom mt-3 p-3">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0 me-3">
                            <i class="bi bi-lightbulb-fill fs-3" style="color: #f59e0b;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Conseils</h6>
                            <ul class="mb-0 small text-muted">
                                <li>Vérifiez toutes les informations avant l'enregistrement</li>
                                <li>La période minimale est de 1 mois</li>
                                <li>Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .input-group-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }
    
    .breadcrumb-item.active {
        color: #667eea;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: #667eea;
    }
</style>