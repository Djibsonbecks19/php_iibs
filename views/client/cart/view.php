<div class="container-fluid px-4 py-5 bg-light min-vh-100">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold mb-0">Votre Panier</h1>
            <a href="index.php?action=listProduitsClients" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left"></i> Continuer vos achats
            </a>
        </div>

        <?php if (!empty($cartItems)): ?>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <?php foreach ($cartItems as $item): ?>
                                    <div class="list-group-item py-3">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="<?= htmlspecialchars($item['image']) ?>" 
                                                     alt="<?= htmlspecialchars($item['libelle_produit']) ?>" 
                                                     class="rounded" width="120" height="120" style="object-fit: contain; background: #f8f9fa;">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="mb-1"><?= htmlspecialchars($item['libelle_produit']) ?></h5>
                                                    <a href="index.php?action=removeFromCart&id=<?= $item['id'] ?>" 
                                                       class="text-danger" title="Supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                                <p class="mb-2 text-danger fw-bold">
                                                    <?= number_format($item['prix_unitaire'], 0, ',', ' ') ?> FCFA
                                                </p>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="input-group input-group-sm" style="width: 120px;">
                                                        <input type="number" class="form-control" value="<?= $item['quantité'] ?>" min="1" readonly>
                                                    </div>
                                                    <small class="text-muted">Total: <?= number_format($item['total'], 0, ',', ' ') ?> FCFA</small>
                                                </div>
                                                <?php if ($item['quantité'] > $item['quantite_stock']): ?>
                                                    <div class="alert alert-warning mt-2 mb-0 py-1 px-2 small">
                                                        <i class="bi bi-exclamation-triangle"></i> Quantité supérieure au stock disponible
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Récapitulatif</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sous-total</span>
                                <span><?= number_format($cartTotal, 0, ',', ' ') ?> FCFA</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Livraison</span>
                                <span>Gratuite</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                                <span>Total</span>
                                <span class="text-danger"><?= number_format($cartTotal, 0, ',', ' ') ?> FCFA</span>
                            </div>
                            <?php
                                if(isset($_SESSION['login'])) {
                            ?>
                                <form method="post" action="index.php?action=checkout">
                                    <button type="submit" class="btn btn-warning w-100 py-2 fw-bold mb-2">
                                        <i class="bi bi-lock-fill"></i> Passer la commande
                                    </button>
                                </form>
                            <?php
                                } else {
                            ?>
                                <a href="index.php?action=login"class="btn btn-success">
                                    Se connecter
                                 </a>
                            <?php
                                }
                            ?>

                            <a href="index.php?action=clearCart" 
                               class="btn btn-outline-danger w-100 py-2"
                               onclick="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">
                                <i class="bi bi-trash"></i> Vider le panier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                    <h3 class="mt-3">Votre panier est vide</h3>
                    <p class="text-muted mb-4">Parcourez nos produits et ajoutez des articles à votre panier</p>
                    <a href="index.php?action=listProduitsClients" class="btn btn-warning px-4">
                        <i class="bi bi-shop"></i> Commencer vos achats
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>