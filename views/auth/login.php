<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card border-0 shadow-lg" style="width: 100%; max-width: 400px; border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-transparent border-0 py-4">
            <div class="text-center">
                <img src="nsa_commands.png" alt="Logo" class="mb-3" style="height: 50px; width: auto;">
                <h2 class="fw-bold text-dark mb-0">Welcome Back</h2>
                <p class="text-muted">Please enter your credentials</p>
            </div>
        </div>
        
        <div class="card-body px-5 py-4">
            <form action="index.php?action=login" method="POST" class="needs-validation" novalidate>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <div class="mb-4">
                    <label for="login" class="form-label text-muted small fw-bold">USERNAME</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="bi bi-person-fill text-muted"></i>
                        </span>
                        <input type="text" name="login" class="form-control border-start-0 py-2" id="login" required placeholder="Enter your username">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label text-muted small fw-bold">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="bi bi-lock-fill text-muted"></i>
                        </span>
                        <input type="password" name="password" class="form-control border-start-0 py-2" id="password" required placeholder="••••••••">
                        <button class="btn bg-transparent border-start-0" type="button" id="togglePassword">
                            <i class="bi bi-eye-fill text-muted"></i>
                        </button>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="small text-decoration-none">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill shadow-sm" name="seConnecter">
                    Sign In
                </button>
                
                <div class="text-center mt-4">
                    <p class="text-muted small">Don't have an account? 
                        <a href="index.php?action=showCreateAccount" class="text-primary text-decoration-none fw-bold">Sign up</a>
                    </p>
                </div>
            </form>
        </div>
        
        <div class="card-footer bg-transparent border-0 py-3 text-center">
            <p class="small text-muted mb-0">© 2023 Your Company. All rights reserved.</p>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
        background-image: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
    
    .input-group-text {
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }
</style>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        } else {
            password.type = 'password';
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        }
    });
    
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