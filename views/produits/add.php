<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Ajouter un Produit</h3>
        </div> 
        <div class="card-body">
            <?= $message ?? '' ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Libellé</label>
                    <input type="text" name="libelle" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Quantite Stock</label>
                    <input type="number" step="0.01" name="quantite_stock" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Prix</label>
                    <input type="number" name="prix_unitaire" class="form-control" required>
                </div>  
                <div class="mb-3">
                    <label class="form-label fw-bold">Quantite Seuil</label>
                    <input type="number" step="0.01" name="quantite_seuil" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>