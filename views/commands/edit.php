<?php
require_once __DIR__ . '/../../models/Database.php';
$db = new Database();

$command = $command ?? [];
$client_id = $command['client_id'] ?? null;

if ($client_id) {
    $sql = "SELECT id, nom, prenom FROM utilisateurs WHERE id = ?";
    $stmt = mysqli_prepare($db->conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $client_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $client = mysqli_fetch_assoc($result) ?? ['nom' => '', 'prenom' => ''];
} else {
    $client = ['nom' => '', 'prenom' => ''];
}
?>

<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-dark bg-gradient text-white text-center py-3">
            <h4 class="mb-0 fw-semibold">Modifier la Commande</h4>
        </div>

        <div class="card-body p-4">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error ?? '') ?></div>
            <?php endif; ?>
            
            <form method="POST" action="index.php?action=updateCommand&id=<?= htmlspecialchars($command['id'] ?? '') ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">

                <div class="mb-4">
                    <label class="form-label fw-medium">Client</label>
                    <input type="text" class="form-control form-control-lg" 
                        value="<?= htmlspecialchars(($client['nom'] ?? '') . ' ' . htmlspecialchars(($client['prenom'] ?? ''))) ?>" disabled>
                </div>

                <div class="mb-4">
                    <label for="prix_total" class="form-label fw-medium">Prix Total</label>
                    <div class="input-group input-group-lg">
                        <input type="number" step="0.01" name="montant_total" id="prix_total"
                            class="form-control" value="<?= htmlspecialchars($command['montant_total'] ?? '') ?>" required disabled>
                        <span class="input-group-text">FCFA</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="statut" class="form-label fw-medium">Statut</label>
                    <select name="statut" id="statut" class="form-select form-select-lg" required>
                        <option value="En attente" <?= (($command['statut'] ?? '') == 'En attente') ? 'selected' : '' ?>>En attente</option>
                        <option value="Validée" <?= (($command['statut'] ?? '') == 'Validée') ? 'selected' : '' ?>>Validée</option>
                        <option value="Expédiée" <?= (($command['statut'] ?? '') == 'Expédiée') ? 'selected' : '' ?>>Expédiée</option>
                        <option value="Annulée" <?= (($command['statut'] ?? '') == 'Annulée') ? 'selected' : '' ?>>Annulée</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning btn-lg fw-semibold">
                        <i class="bi bi-pencil-square me-2"></i>Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>