<div class="animate-fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0f172a;">
                <i class="bi bi-bookmark-check me-2"></i>
                Types d'Assurance
            </h2>
            <p class="text-muted mb-0">Gérez tous vos types d'assurance</p>
        </div>
        <a href="/type_assurance/create" class="btn btn-custom-primary text-white">
            <i class="bi bi-plus-circle me-2"></i>
            Nouveau Type
        </a>
    </div>

    <div class="card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Label</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($types as $t): ?>
                        <tr>
                            <td class="px-4">#<?= str_pad($t['id'], 3, '0', STR_PAD_LEFT) ?></td>
                            <td class="px-4"><?= htmlspecialchars($t['label']) ?></td>
                            <td class="px-4 text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="/type_assurance/edit?id=<?= $t['id'] ?>" 
                                       class="btn btn-sm btn-custom-warning text-white" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/type_assurance/delete?id=<?= $t['id'] ?>" 
                                       class="btn btn-sm btn-custom-danger text-white" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type ?')"
                                       title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
