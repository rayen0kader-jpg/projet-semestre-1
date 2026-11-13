<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/connexion_bdd.php';

protegerAdmin();

$sql = "SELECT id, username, role, actif, created_at
        FROM utilisateurs
        ORDER BY username";
$utilisateurs = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Gestion des utilisateurs</h1>

    <p><a href="dashboard.php">Retour au tableau de bord</a></p>
    <p><a href="utilisateur-creer.php">Créer un utilisateur</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Nom d'utilisateur</th><th>Rôle</th><th>Statut</th><th>Créé le</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($utilisateurs as $u): ?>
            <tr>
                <td><?= (int) $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['role']) ?></td>
                <td><?= $u['actif'] ? 'Actif' : 'Inactif' ?></td>
                <td><?= htmlspecialchars($u['created_at']) ?></td>
                <td>
                    <a href="utilisateur-role.php?id=<?= (int) $u['id'] ?>">Rôle</a> |
                    <a href="utilisateur-statut.php?id=<?= (int) $u['id'] ?>">Activer / Désactiver</a> |
                    <a href="utilisateur-supprimer.php?id=<?= (int) $u['id'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
