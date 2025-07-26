<div class="container-fluid px-4 py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold mb-0">Nos Produits</h1>
            <?php if (isset($_SESSION['login'])) : ?>
                <div class="d-flex gap-3">
                    <a href="index.php?action=viewPanier" class="btn btn-outline-dark position-relative">
                        <i class="bi bi-cart-fill"></i> Panier
                        <?php if ($products > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= count($products); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="row g-4">
            <?php foreach ($products as $product): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="position-relative">
                            <img src="<?= htmlspecialchars($product['image']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($product['libelle']) ?>" 
                                 style="height: 200px; object-fit: contain; background: #f8f9fa;">
                            <?php if ($product['quantite_stock'] <= 0): ?>
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex align-items-center justify-content-center">
                                    <span class="badge bg-danger fs-6">En rupture</span>
                                </div>
                            <?php elseif ($product['quantite_stock'] <= 5): ?>
                                <span class="position-absolute top-0 end-0 m-2 badge bg-warning">
                                    Plus que <?= $product['quantite_stock'] ?> en stock
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2"><?= htmlspecialchars($product['libelle']) ?></h5>
                            <div class="mb-3">
                                <div class="fs-5 fw-bold text-danger mb-1">
                                    <?= number_format($product['prix_unitaire'], 0, ',', ' ') ?> FCFA
                                </div>
                                <?php if ($product['quantite_stock'] > 0): ?>
                                    <small class="text-success">En stock</small>
                                <?php endif; ?>
                            </div>

                            <form action="index.php?action=addToCart" method="POST" class="mt-auto">
                                <input type="hidden" name="produit_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="libelle" value="<?= htmlspecialchars($product['libelle']) ?>">
                                <input type="hidden" name="prix" value="<?= $product['prix_unitaire'] ?>">
                                <input type="hidden" name="image" value="<?= $product['image'] ?>">
                                
                                    <div class="d-flex gap-2 align-items-center">
                                        <input type="number" name="quantite" class="form-control form-control-sm" 
                                            min="1" max="<?= $product['quantite_stock'] ?>" value="1"
                                            <?= $product['quantite_stock'] <= 0 ? 'disabled' : '' ?>>
                                        <button type="submit" class="btn btn-warning flex-grow-1" 
                                                <?= $product['quantite_stock'] <= 0 ? 'disabled' : '' ?>>
                                            <i class="bi bi-cart-plus"></i> Ajouter
                                        </button>
                                    </div>
                                                            
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>