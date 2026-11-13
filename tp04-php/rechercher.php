<?php
session_start();
require_once __DIR__ . '/fonctions.php';
protegerPage();

$nomRecherche = trim($_GET['nom'] ?? '');
$resultats = [];
if ($nomRecherche !== '') {
    $resultats = rechercherParNom(getEtudiants(), $nomRecherche);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rechercher un étudiant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Rechercher un étudiant</h1>
    <nav><a href="dashboard.php">Tableau de bord</a><a href="logout.php">Se déconnecter</a></nav>

    <form method="GET">
        <label for="nom">Nom à rechercher :</label>
        <input id="nom" type="text" name="nom" value="<?= htmlspecialchars($nomRecherche) ?>">
        <button type="submit">Rechercher</button>
    </form>

<?php if ($nomRecherche !== ''): ?>
    <?php if (count($resultats) === 0): ?>
        <p>Aucun étudiant trouvé.</p>
    <?php else: ?>
        <table>
            <tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Formation</th><th>Moyenne</th><th>Résultat</th></tr>
            <?php foreach ($resultats as $e): ?>
                <tr>
                    <td><?= htmlspecialchars($e['nom']) ?></td>
                    <td><?= htmlspecialchars($e['prenom']) ?></td>
                    <td><?= (int) $e['age'] ?></td>
                    <td><?= htmlspecialchars($e['formation']) ?></td>
                    <td><?= htmlspecialchars((string) $e['moyenne']) ?></td>
                    <td><?= resultat($e['moyenne']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
