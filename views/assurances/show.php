<div class="animate-fade-in">
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/assurances" class="text-decoration-none">Assurances</a></li>
                <li class="breadcrumb-item active">Détails #<?= $assurance['id'] ?></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Main Details Card -->
        <div class="col-lg-8 mb-4">
            <div class="card-custom">
                <div class="card-body p-0">
                    <!-- Header with gradient -->
                    <div class="p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="d-flex align-items-start justify-content-between text-white">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-shield-fill-check fs-2"></i>
                                </div>
                                <div>
                                    <h3 class="mb-1">Contrat #<?= str_pad($assurance['id'], 4, '0', STR_PAD_LEFT) ?></h3>
                                    <span class="badge bg-white text-dark px-3 py-2">
                                        <i class="bi bi-check-circle-fill text-success me-1"></i>
                                        Active
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Imprimer</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Télécharger PDF</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-share me-2"></i>Partager</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Client Information -->
                    <div class="p-4 border-bottom">
                        <h5 class="mb-3">
                            <i class="bi bi-person-fill me-2" style="color: #667eea;"></i>
                            Informations Client
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($assurance['client']) ?>&background=667eea&color=fff&size=50" 
                                             alt="Avatar" 
                                             class="w-100 h-100">
                                    </div>
                                    <div>
                                        <label class="text-muted small mb-1">Nom Complet</label>
                                        <div class="fw-bold"><?= htmlspecialchars($assurance['client']) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small mb-1">Email</label>
                                <div class="fw-semibold">
                                    <i class="bi bi-envelope me-2"></i>
                                    client@example.com
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small mb-1">Téléphone</label>
                                <div class="fw-semibold">
                                    <i class="bi bi-telephone me-2"></i>
                                    +221 77 123 45 67
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small mb-1">Adresse</label>
                                <div class="fw-semibold">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    Dakar, Sénégal
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Insurance Details -->
                    <div class="p-4 border-bottom">
                        <h5 class="mb-3">
                            <i class="bi bi-file-text-fill me-2" style="color: #667eea;"></i>
                            Détails du Contrat
                        </h5>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="p-3 rounded" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));">
                                    <label class="text-muted small mb-1">Type d'Assurance</label>
                                    <div class="fw-bold fs-5" style="color: #667eea;">
                                        <i class="bi bi-bookmark-fill me-2"></i>
                                        <?= htmlspecialchars($assurance['type_label']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));">
                                    <label class="text-muted small mb-1">Période</label>
                                    <div class="fw-bold fs-5 text-success">
                                        <i class="bi bi-calendar-range me-2"></i>
                                        <?= htmlspecialchars($assurance['periode']) ?> mois
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));">
                                    <label class="text-muted small mb-1">Prime Mensuelle</label>
                                    <div class="fw-bold fs-5 text-warning">
                                        <i class="bi bi-cash-coin me-2"></i>
                                        <?= number_format($assurance['prime'], 0, ',', ' ') ?> FCFA
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Summary -->
                    <div class="p-4">
                        <h5 class="mb-3">
                            <i class="bi bi-graph-up me-2" style="color: #667eea;"></i>
                            Résumé Financier
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="text-center p-3 border rounded">
                                    <div class="text-muted small mb-1">Total à Payer</div>
                                    <div class="fw-bold fs-4" style="color: #667eea;">
                                        <?= number_format($assurance['prime'] * $assurance['periode'], 0, ',', ' ') ?> FCFA
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 border rounded">
                                    <div class="text-muted small mb-1">Montant Payé</div>
                                    <div class="fw-bold fs-4 text-success">
                                        <?= number_format(($assurance['prime'] * $assurance['periode']) * 0.6, 0, ',', ' ') ?> FCFA
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 border rounded">
                                    <div class="text-muted small mb-1">Reste à Payer</div>
                                    <div class="fw-bold fs-4 text-danger">
                                        <?= number_format(($assurance['prime'] * $assurance['periode']) * 0.4, 0, ',', ' ') ?> FCFA
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Footer -->
                <div class="card-footer bg-light d-flex justify-content-between align-items-center p-3">
                    <a href="/assurances" class="btn btn-custom-secondary text-white">
                        <i class="bi bi-arrow-left me-2"></i>
                        Retour
                    </a>
                    
                    <div>
                        <a href="/assurances/edit?id=<?= $assurance['id'] ?>" class="btn btn-custom-warning text-white me-2">
                            <i class="bi bi-pencil me-2"></i>
                            Modifier
                        </a>
                        <a href="/assurances/delete?id=<?= $assurance['id'] ?>" 
                           class="btn btn-custom-danger text-white"
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette assurance ?')">
                            <i class="bi bi-trash me-2"></i>
                            Supprimer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Cards -->
        <div class="col-lg-4">
            <!-- Timeline Card -->
            <div class="card-custom mb-4">
                <div class="card-header-custom">
                    <h6 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Chronologie
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="d-flex mb-3 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 35px; height: 35px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                    <i class="bi bi-check text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-semibold small">Contrat Activé</div>
                                <small class="text-muted">Il y a 3 jours</small>
                            </div>
                        </div>
                        <div class="d-flex mb-3 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="bi bi-cash text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-semibold small">Paiement Reçu</div>
                                <small class="text-muted">Il y a 5 jours</small>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="bi bi-plus text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-semibold small">Contrat Créé</div>
                                <small class="text-muted">Il y a 1 semaine</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card-custom mb-4">
                <div class="card-header-custom">
                    <h6 class="mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>
                        Actions Rapides
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary text-start" style="border-radius: 10px;">
                            <i class="bi bi-file-earmark-pdf me-2"></i>
                            Générer un Reçu
                        </button>
                        <button class="btn btn-outline-primary text-start" style="border-radius: 10px;">
                            <i class="bi bi-envelope me-2"></i>
                            Envoyer par Email
                        </button>
                        <button class="btn btn-outline-primary text-start" style="border-radius: 10px;">
                            <i class="bi bi-calendar-event me-2"></i>
                            Planifier un Rappel
                        </button>
                        <button class="btn btn-outline-primary text-start" style="border-radius: 10px;">
                            <i class="bi bi-chat-dots me-2"></i>
                            Contacter le Client
                        </button>
                    </div>
                </div>
            </div>

            <!-- Documents Card -->
            <div class="card-custom">
                <div class="card-header-custom">
                    <h6 class="mb-0">
                        <i class="bi bi-paperclip me-2"></i>
                        Documents Joints
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center border-0 px-0">
                            <i class="bi bi-file-earmark-pdf fs-4 me-3 text-danger"></i>
                            <div class="flex-grow-1">
                                <div class="fw-semibold small">Contrat_Signé.pdf</div>
                                <small class="text-muted">2.4 MB</small>
                            </div>
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center border-0 px-0">
                            <i class="bi bi-file-earmark-image fs-4 me-3 text-primary"></i>
                            <div class="flex-grow-1">
                                <div class="fw-semibold small">Pièce_Identité.jpg</div>
                                <small class="text-muted">1.8 MB</small>
                            </div>
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .breadcrumb-item.active {
        color: #667eea;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: #667eea;
    }

    .timeline .d-flex:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 17px;
        top: 45px;
        width: 2px;
        height: calc(100% - 10px);
        background: linear-gradient(180deg, #667eea 0%, transparent 100%);
    }
</style>