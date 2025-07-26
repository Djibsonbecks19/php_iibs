<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Liste des Produits</h3>
        </div>
        <div class="card-body">
            <div class="text-end mb-3">
                <a href="index.php?action=addProduit" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Ajouter un Produit
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Libellé</th>
                            <th>Quantité Stock</th>
                            <th>Prix</th>
                            <th>Quantité Seuil</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= htmlspecialchars($product['libelle']) ?></td>
                                <td><?= $product['quantite_stock'] ?></td>
                                <td><?= number_format($product['prix_unitaire'], 2) ?> FCFA</td>
                                <td><?= $product['quantite_seuil'] ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($product['image']) ?>" width="50" height="50" class="rounded-circle border">
                                </td>
                                <?php  if(!empty($_SESSION)) { ?>
                                <td>
                                    <a href="index.php?action=edit&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>
                                    <a href="index.php?action=delete&id=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </a>
                                </td>
                                <?php } else { ?>
                                <td>
                                    <a href="?action=login" class="btn btn-success btn-sm">
                                        <i class="bi bi-box-arrow-in-right"></i> Connexion
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>