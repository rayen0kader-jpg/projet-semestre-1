<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/connexion_bdd.php';
protegerPage();

$nomRecherche = trim($_GET['nom'] ?? '');
$etudiants = [];

if ($nomRecherche !== '') {
    $sql = "SELECT id, nom, prenom, age, formation, moyenne
            FROM etudiants
            WHERE nom LIKE :nom
            ORDER BY nom, prenom";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => '%' . $nomRecherche . '%']);
    $etudiants = $stmt->fetchAll();
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
    <nav><a href="dashboard.php">Tableau de bord</a><a href="deconnexion.php">Se déconnecter</a><a href="etudiants.php">Liste</a></nav>

    <form method="GET">
        <label for="nom">Nom à rechercher :</label>
        <input id="nom" type="text" name="nom" value="<?= htmlspecialchars($nomRecherche) ?>">
        <button type="submit">Rechercher</button>
    </form>

<?php if ($nomRecherche !== ''): ?>
    <?php if (count($etudiants) === 0): ?>
        <p>Aucun étudiant ne correspond à « <?= htmlspecialchars($nomRecherche) ?> ».</p>
    <?php else: ?>
        <table>
            <tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Âge</th><th>Formation</th><th>Moyenne</th></tr>
            <?php foreach ($etudiants as $e): ?>
                <tr>
                    <td><?= (int) $e['id'] ?></td>
                    <td><?= htmlspecialchars($e['nom']) ?></td>
                    <td><?= htmlspecialchars($e['prenom']) ?></td>
                    <td><?= (int) $e['age'] ?></td>
                    <td><?= htmlspecialchars($e['formation']) ?></td>
                    <td><?= htmlspecialchars((string) $e['moyenne']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
