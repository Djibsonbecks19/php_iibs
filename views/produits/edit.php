<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-white text-center">
            <h3 class="mb-0">Modifier un Produit</h3>
        </div>
        <div class="card-body">
            <?= $message ?? '' ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Libellé</label>
                    <input type="text" name="libelle" class="form-control" value="<?= $product['libelle'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Quantité Stock</label>
                    <input type="number" name="quantite_stock" class="form-control" value="<?= $product['quantite_stock'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Prix</label>
                    <input type="number" step="0.01" name="prix" class="form-control" value="<?= $product['prix_unitaire'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Quantité Seuil</label>
                    <input type="number" name="quantite_seuil" class="form-control" value="<?= $product['quantite_seuil'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Image (URL)</label>
                    <input type="text" name="image" class="form-control" value="<?= $product['image'] ?>">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Modifier</button>
                    <a href="index.php?action=list" class="btn btn-secondary px-4">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>