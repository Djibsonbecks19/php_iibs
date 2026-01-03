<div class="animate-fade-in">
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/type_assurance" class="text-decoration-none">Types d'Assurance</a></li>
                <li class="breadcrumb-item active">Modifier #<?= $type['id'] ?></li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square fs-4 me-3"></i>
                        <div>
                            <h4 class="mb-0">Modifier le Type d'Assurance</h4>
                            <small class="opacity-75">ID #<?= str_pad($type['id'], 3, '0', STR_PAD_LEFT) ?></small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="/type_assurance/edit?id=<?= $type['id'] ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label-custom">
                                Nom du Type
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="label" class="form-control form-control-custom" value="<?= htmlspecialchars($type['label']) ?>" required>
                        </div>

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="/type_assurance" class="btn btn-custom-secondary text-white">
                                <i class="bi bi-x-circle me-2"></i>Annuler
                            </a>
                            <div>
                                <button type="button" class="btn btn-outline-danger me-2" onclick="if(confirm('Supprimer ce type ?')) window.location.href='/type_assurance/delete?id=<?= $type['id'] ?>'">
                                    <i class="bi bi-trash me-2"></i>Supprimer
                                </button>
                                <button type="submit" class="btn btn-custom-success text-white">
                                    <i class="bi bi-check-circle me-2"></i>Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
