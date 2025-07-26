<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Ajouter une Commande</h3>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <?php if ($_SESSION['role'] == 'client'): ?>
                    <input type="hidden" name="client_id" value="<?= $_SESSION['id'] ?>">
                <?php else: ?>
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client:</label>
                        <select name="client_id" id="client_id" class="form-select" required>
                            <option value="" disabled selected>Choisir un client</option>
                            <?php foreach ($clients as $client): ?>
                                <option value="<?= $client['id'] ?>">
                                    <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="produit_id" class="form-label">Produit:</label>
                    <select name="produit_id" id="produit_id" class="form-select" required>
                        <option value="" disabled selected>Choisir un produit</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product['id'] ?>">
                                <?= htmlspecialchars($product['libelle']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité:</label>
                    <input type="number" name="quantite" id="quantite" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="statut" class="form-label">Statut:</label>
                    <select name="statut" id="statut" class="form-select" required>
                        <option value="En attente">En attente</option>
                        <option value="Validée">Validée</option>
                        <option value="Expédiée">Expédiée</option>
                        <option value="Livrée">Livrée</option>
                        <option value="Annulée">Annulée</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Ajouter la Commande</button>
                </div>
            </form>
        </div>
    </div>
</div>