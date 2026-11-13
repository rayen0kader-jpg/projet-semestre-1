<?php
session_start();
require_once __DIR__ . '/fonctions.php';
protegerPage();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Tableau de bord</h1>
    <p>Bienvenue <?= htmlspecialchars($_SESSION['username']) ?></p>
    <p>Utilisateur connecté : <?= htmlspecialchars($_SESSION['username']) ?></p>

    <h2>Gestion des étudiants</h2>
    <ul>
        <li><a href="dashboard.php?vue=liste">Liste des étudiants</a></li>
        <li><a href="ajouter.php">Ajouter un étudiant</a></li>
        <li><a href="rechercher.php">Rechercher un étudiant</a></li>
        <li><a href="logout.php">Se déconnecter</a></li>
    </ul>

<?php if (($_GET['vue'] ?? '') === 'liste'): ?>
    <table>
        <thead><tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Formation</th><th>Moyenne</th><th>Résultat</th></tr></thead>
        <tbody>
        <?php foreach (getEtudiants() as $e): ?>
            <tr>
                <td><?= htmlspecialchars($e['nom']) ?></td>
                <td><?= htmlspecialchars($e['prenom']) ?></td>
                <td><?= (int) $e['age'] ?></td>
                <td><?= htmlspecialchars($e['formation']) ?></td>
                <td><?= htmlspecialchars((string) $e['moyenne']) ?></td>
                <td><?= resultat($e['moyenne']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
