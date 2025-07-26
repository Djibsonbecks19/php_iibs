<div class="container d-flex justify-content-center align-items-center min-vh-100 py-4">
    <div class="card border-0 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 10px; overflow: hidden;">
        <div class="card-header bg-transparent border-0 py-3">
            <div class="text-center">
                <h4 class="fw-bold text-dark mb-1">Create Account</h4>
                <p class="text-muted small">Fill in your details to register</p>
            </div>
        </div>
        
        <div class="card-body px-4 py-3">
            <form action="index.php?action=createAccount" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show py-2 mb-3" role="alert">
                        <small><?= htmlspecialchars($error) ?></small>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.7rem;"></button>
                    </div>
                <?php endif; ?>
                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show py-2 mb-3" role="alert">
                        <small><?= htmlspecialchars($_SESSION['success']) ?></small>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.7rem;"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="nom" class="form-label small text-muted fw-bold">LAST NAME</label>
                            <input type="text" name="nom" class="form-control form-control-sm" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="prenom" class="form-label small text-muted fw-bold">FIRST NAME</label>
                            <input type="text" name="prenom" class="form-control form-control-sm" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="mb-2">
                    <label for="telephone" class="form-label small text-muted fw-bold">PHONE</label>
                    <input type="text" name="telephone" class="form-control form-control-sm" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>" required>
                </div>
                
                <div class="mb-2">
                    <label for="adresse" class="form-label small text-muted fw-bold">ADDRESS</label>
                    <input type="text" name="adresse" class="form-control form-control-sm" value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>" required>
                </div>
                
                <div class="mb-2">
                    <label for="login" class="form-label small text-muted fw-bold">USERNAME</label>
                    <input type="text" name="login" class="form-control form-control-sm" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>" required>
                </div>
                
                <div class="mb-2">
                    <label for="password" class="form-label small text-muted fw-bold">PASSWORD</label>
                    <input type="password" name="password" class="form-control form-control-sm" required>
                </div>
                
                <div class="mb-3">
                    <label for="pp" class="form-label small text-muted fw-bold">PROFILE PHOTO</label>
                    <input type="file" name="pp" class="form-control form-control-sm" required accept="image/*">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 btn-sm py-2 fw-bold" name="creerCompte">
                    Register
                </button>
                
                <div class="text-center mt-3">
                    <p class="small text-muted">Already have an account? 
                        <a href="index.php?action=login" class="text-decoration-none">Sign in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    
    .card {
        transition: all 0.2s ease;
    }
    
    .form-control-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.2rem;
    }
    
    .form-label {
        margin-bottom: 0.2rem;
    }
    
    .btn {
        border-radius: 0.2rem;
        font-size: 0.875rem;
    }
    
    .alert {
        padding: 0.35rem 1rem;
    }
</style>

<script>
    // Form validation
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>