
<?php
  require_once __DIR__ . '../../../../models/Database.php';
  $db = new Database(); 
  $conn = $db->conn;

  $sql = "SELECT * FROM utilisateurs WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
?>
<div class="container my-5">
  <div class="card shadow rounded-4 p-4" style="max-width: 600px; margin: auto;">
    <h3 class="mb-4 text-center">Détails du Paiement</h3>
    <form method="POST" action="index.php?action=processPayment<?= isset($_GET['commande_id']) ? '&commande_id=' . htmlspecialchars($_GET['commande_id']) : '' ?>">

      <div class="mb-3">
        <label for="commande_id" class="form-label">Commande #</label>
        <input type="text" id="commande_id" name="commande_id" 
               value="<?= htmlspecialchars($commande['id']) .", ". " " . $user["nom"] . " " . $user["prenom"] ?> " 
               class="form-control" disabled>
        <input type="hidden" name="commande_id" value="<?= htmlspecialchars($commande['id']) ?>">
      </div>

      <div class="mb-3">
        <label for="montant" class="form-label">Montant à Payer (FCFA)</label>
        <input type="text" id="montant" name="montant" 
               value="<?= number_format($commande['montant_total'], 0, ',', ' ') ?>" 
               class="form-control" disabled>
        <input type="hidden" name="montant" value="<?= $commande['montant_total'] ?>">
      </div>

      <div class="mb-3">
        <label for="date_commande" class="form-label">Date de la Commande</label>
        <input type="text" id="date_commande" name="date_commande" 
               value="<?= date('d/m/Y', strtotime($commande['date_commande'])) ?>" 
               class="form-control" disabled>
      </div>

      <div class="mb-4">
        <label for="mode_paiement" class="form-label">Mode de Paiement</label>
        <select id="mode_paiement" name="mode_paiement" class="form-select" required>
          <option value="" disabled selected>-- Sélectionnez un mode --</option>
          <option value="Carte bancaire">Carte bancaire</option>
          <option value="Espèces">Espèces</option>
          <option value="Mobile Money">Mobile Money</option>
          <option value="Chèque">Chèque</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary w-100">Payer maintenant</button>
    </form>
  </div>
</div>
