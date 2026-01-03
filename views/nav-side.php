    <style>
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color:rgb(20, 21, 22);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 56px; /* Same as navbar height */
            transition: all 0.3s;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: white;
            border-left: 3px solid white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 8px;
        }
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        @media (max-width: 992px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
        .navbar-brand {
            font-weight: 600;
            margin-right: 2rem;
        }
    </style>
    
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
        <div class="container-fluid">
             <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == 'client'): ?>
                <a class="navbar-brand" href="?action=listProduitsClients">
                    NSA Management
                </a>
            <?php else: ?>
                <a class="navbar-brand" href="?action=listProduits">
                    NSA Management
                </a>
            <?php endif; ?>
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Profile Section -->
            <div class="d-flex align-items-center ms-auto me-2">
                <?php if (isset($_SESSION['pp']) && !empty($_SESSION['pp'])) { ?>
                    <img src="<?= htmlspecialchars($_SESSION['pp']) ?>" width="40" height="40" alt="Profile" class="rounded-circle border me-2">
                <?php } else { ?>
                    <div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                        <?= isset($_SESSION['prenom']) ? strtoupper(substr($_SESSION['prenom'], 0, 1)) : 'U'; ?>
                    </div>
                <?php } ?>
                <span class="text-light ms-2 d-none d-lg-inline"><?= isset($_SESSION['prenom']) ? htmlspecialchars($_SESSION['prenom']) : 'User'; ?></span>
            </div>
            
            <div class="d-flex">
                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == 'client'): ?>
                    <a href="index.php?action=viewPanier" class="btn btn-warning btn-sm mx-2">
                        <i class="bi bi-cart"></i> <span class="d-none d-lg-inline">Panier</span>
                    </a>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['login'])): ?>
                    <a href="index.php?action=disconnect" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> <span class="d-none d-lg-inline">Déconnexion</span>
                    </a>
                <?php else: ?>
                    <a href="index.php?action=login" class="btn btn-success btn-sm">
                        <i class="bi bi-box-arrow-in-right"></i> <span class="d-none d-lg-inline">Connexion</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar collapse d-lg-block" id="sidebarCollapse">
        <div class="d-flex flex-column h-100">
            <ul class="nav flex-column flex-grow-1 pt-2">
                <?php if (isset($_SESSION["role"])): ?>
                    <?php if ($_SESSION["role"] == 'RS'): ?>
                        <!-- RS Menu -->
                         <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listProduits">
                                <i class="bi bi-truck"></i> Produits
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listLivraisons">
                                <i class="bi bi-truck"></i> Livraisons
                            </a>
                        </li>
                        
                        
                    <?php elseif ($_SESSION["role"] == 'secretaire'): ?>
                        <!-- Secretaire Menu -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listCommands">
                                <i class="bi bi-clipboard-check"></i> Commandes
                            </a>
                        </li>
                        
                    <?php elseif ($_SESSION["role"] == 'client'): ?>
                        <!-- Client Menu -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listProduitsClients">
                                <i class="bi bi-shop"></i> Boutique
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listCommandesClients">
                                <i class="bi bi-clipboard-check"></i> Commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listLivraisonsClients">
                                <i class="bi bi-truck"></i> Livraisons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listPaiementsClients">
                                <i class="bi bi-credit-card"></i> Paiements
                            </a>
                        </li>
                        
                    <?php else: ?>
                        <!-- Admin/Default Menu -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listClients">
                                <i class="bi bi-people"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listProduits">
                                <i class="bi bi-box"></i> Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listCommandesClients">
                                <i class="bi bi-clipboard-check"></i> Commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listLivraisons">
                                <i class="bi bi-truck"></i> Livraisons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listPaiements">
                                <i class="bi bi-credit-card"></i> Paiements
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listLivreurs">
                                <i class="bi bi-bicycle"></i> Livreurs
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            
            <div class="p-3 border-top">
                <small class="text-white-50">Version 1.0.0</small>
            </div>
        </div>
    </div>
