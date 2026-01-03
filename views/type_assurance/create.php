<div class="animate-fade-in">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-custom">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-plus-circle-fill fs-4 me-3"></i>
                        <div>
                            <h4 class="mb-0">Créer un Nouveau Type d'Assurance</h4>
                            <small class="opacity-75">Entrez le nom du type</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="/type_assurance/create" method="POST">
                        <div class="mb-3">
                            <label class="form-label-custom">
                                Nom du Type
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="label" class="form-control form-control-custom" placeholder="Ex: Auto, Santé..." required>
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top">
                            <a href="/type_assurance" class="btn btn-custom-secondary text-white me-2">
                                <i class="bi bi-x-circle me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-custom-success text-white">
                                <i class="bi bi-check-circle me-2"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
