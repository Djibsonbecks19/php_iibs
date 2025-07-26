<?php
require_once __DIR__ . '/../../models/Database.php';
$db = new Database();
$conn = $db->conn;

$commandes = [];
$sqlC = "SELECT c.id, CONCAT('Commande #', c.id, ' - ', u.nom, ' ', u.prenom) AS label 
         FROM commandes c 
         JOIN utilisateurs u ON c.client_id = u.id 
         WHERE c.statut = 'validée' 
         ORDER BY c.id DESC";
$resC = mysqli_query($conn, $sqlC);
while ($row = mysqli_fetch_assoc($resC)) {
    $commandes[] = $row;
}

$livreurs = [];
$sqlL = "SELECT id, CONCAT(nom, ' ', prenom, ' - ', telephone) AS label 
         FROM livreurs 
         WHERE disponible = 1 
         ORDER BY nom";
$resL = mysqli_query($conn, $sqlL);
while ($row = mysqli_fetch_assoc($resL)) {
    $livreurs[] = $row;
}
?>

<div class="container my-5">
  <div class="card shadow rounded-4 border-0">
    <div class="card-header bg-dark text-white text-center py-3">
      <h4 class="mb-0 fw-semibold"><i class="bi bi-truck me-2"></i>Affecter un livreur à une commande</h4>
    </div>

    <div class="card-body px-4 py-5">
      <form method="POST" action="index.php?action=createLivraison" class="mx-auto" style="max-width: 600px;">
        
        <div class="mb-4">
          <label for="commande_id" class="form-label fw-semibold">Commande validée</label>
          <select name="commande_id" id="commande_id" class="form-select form-select-lg" required>
            <option value="" disabled selected>-- Sélectionnez une commande --</option>
            <?php foreach ($commandes as $cmd): ?>
              <option value="<?= $cmd['id'] ?>"><?= htmlspecialchars($cmd['label']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-4">
          <label for="livreur_id" class="form-label fw-semibold">Livreur disponible</label>
          <select name="livreur_id" id="livreur_id" class="form-select form-select-lg" required>
            <option value="" disabled selected>-- Sélectionnez un livreur --</option>
            <?php foreach ($livreurs as $liv): ?>
              <option value="<?= $liv['id'] ?>"><?= htmlspecialchars($liv['label']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-4">
          <label for="adresse_livraison" class="form-label fw-semibold">Adresse de livraison</label>
          <input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control form-control-lg" required>
        </div>

        <button type="submit" class="btn btn-success w-100 btn-lg fw-semibold">
          <i class="bi bi-check-circle me-2"></i>Affecter la livraison
        </button>
      </form>
    </div>
  </div>
</div>
