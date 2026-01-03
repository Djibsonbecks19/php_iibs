<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AssurePro - Gestion des Assurances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #0ea5e9;
            --accent-color: #f59e0b;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --sidebar-width: 280px;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Styles */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(37, 99, 235, 0.3);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link-custom {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.5rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
            font-weight: 500;
        }

        .nav-link-custom:hover {
            background: rgba(37, 99, 235, 0.2);
            color: white;
            transform: translateY(-2px);
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            min-height: calc(100vh - 76px);
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            left: 0;
            top: 76px;
            padding: 2rem 0;
            transition: all 0.3s ease;
            z-index: 1000;
            border-right: 2px solid rgba(37, 99, 235, 0.3);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 1rem 1.75rem;
            margin: 0.5rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
        }

        .sidebar .nav-link:hover {
            color: white;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.3), rgba(102, 126, 234, 0.2));
            border-left: 3px solid var(--secondary-color);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: white;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.4), rgba(102, 126, 234, 0.3));
            border-left: 3px solid var(--accent-color);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        }

        .sidebar .nav-link i {
            width: 28px;
            font-size: 1.2rem;
            margin-right: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
            min-height: calc(100vh - 76px);
        }

        /* Card Styles */
        .card-custom {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 2rem;
            border: none;
            font-weight: 600;
        }

        /* Buttons */
        .btn-custom-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6);
        }

        .btn-custom-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* Form Inputs */
        .form-control-custom {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-label-custom {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        /* Table Styles */
        .table-custom {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .table-custom thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table-custom tbody tr {
            transition: all 0.3s ease;
        }

        .table-custom tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }

        /* Profile Section */
        .profile-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 3px solid rgba(102, 126, 234, 0.5);
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            border-color: rgba(102, 126, 234, 1);
            transform: scale(1.1);
        }

        /* Badge Custom */
        .badge-custom {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/">
                <i class="bi bi-shield-fill-check me-2"></i>
                AssurePro
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link-custom" href="#"><i class="bi bi-house-door me-1"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="#"><i class="bi bi-file-text me-1"></i> Contrats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="#"><i class="bi bi-graph-up me-1"></i> Rapports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="#"><i class="bi bi-gear me-1"></i> Paramètres</a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="text-decoration-none dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=667eea&color=fff" class="profile-avatar me-2" alt="Profile">
                        <span class="text-white d-none d-lg-inline">John Doe</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar collapse d-lg-block" id="sidebarCollapse">
        <div class="d-flex flex-column h-100">
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link active" href="/assurances">
                        <i class="bi bi-shield-check"></i>
                        <span>Listes Aussurances</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/assurances/create">
                        <i class="bi bi-people"></i>
                        <span>Créer une assurance</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/type_assurance"">
                        <i class="bi bi-bookmark"></i>
                        <span>Types d'Assurance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/type_assurance/create">
                        <i class="bi bi-credit-card"></i>
                        <span>Créer une type assurance</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/statistiques">
                        <i class="bi bi-bar-chart"></i>
                        <span>Statistiques</span>
                    </a>
                </li>
            </ul>
            
            <div class="px-3 py-3 border-top border-secondary">
                <small class="text-white-50 d-block text-center">Version 2.0.0</small>
                <small class="text-white-50 d-block text-center">© 2025 AssurePro</small>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" style="margin-top: 76px;">
        <div class="container-fluid">
            <?php echo $content; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Active menu highlighting
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            
            navLinks.forEach(link => {
                if (currentUrl.includes(link.getAttribute('href'))) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                }
            });

            // Add animation to cards
            const cards = document.querySelectorAll('.card-custom');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate-fade-in');
                }, index * 100);
            });
        });
    </script>
</body>
</html>