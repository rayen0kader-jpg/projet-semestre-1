<?php
require_once __DIR__ . '/connexion.php';
require_once __DIR__ . '/fonctions.php';

// Tri : liste blanche, car un nom de colonne ne peut pas être un paramètre préparé
$tris = [
    'nom'     => 'nom, prenom',
    'moyenne' => 'moyenne DESC',
];
$tri = $_GET['tri'] ?? 'nom';
if (!isset($tris[$tri])) {
    $tri = 'nom';
}

// Filtre sur la moyenne minimale
$min = $_GET['min'] ?? '';
$params = [];
$sql = "SELECT id, nom, prenom, age, formation, moyenne FROM etudiants";
if ($min !== '' && is_numeric($min)) {
    $sql .= " WHERE moyenne >= :min";
    $params['min'] = $min;
}
$sql .= " ORDER BY " . $tris[$tri];

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$etudiants = $stmt->fetchAll();

// Statistiques (travail à la maison)
$stats = $pdo->query(
    "SELECT COUNT(*) AS nombre_etudiants,
            AVG(moyenne) AS moyenne_classe,
            MAX(moyenne) AS meilleure_moyenne,
            MIN(moyenne) AS plus_faible_moyenne
     FROM etudiants"
)->fetch();

$messages = [
    'ajoute'     => "Étudiant ajouté.",
    'modifie'    => "Étudiant modifié.",
    'supprime'   => "Étudiant supprimé.",
    'introuvable' => "Aucun étudiant ne correspond à cet identifiant.",
];
$message = $messages[$_GET['msg'] ?? ''] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Liste des étudiants</h1>
    <nav><a href="index.php">Accueil</a><a href="ajouter.php">Ajouter</a><a href="rechercher.php">Rechercher</a></nav>

    <?php if ($message !== ''): ?>
        <p class="succes"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <p>
        Nombre d'étudiants : <?= (int) $stats['nombre_etudiants'] ?> |
        Moyenne de la classe : <?= $stats['moyenne_classe'] !== null ? number_format((float) $stats['moyenne_classe'], 2) : '-' ?> |
        Meilleure : <?= htmlspecialchars((string) ($stats['meilleure_moyenne'] ?? '-')) ?> |
        Plus faible : <?= htmlspecialchars((string) ($stats['plus_faible_moyenne'] ?? '-')) ?>
    </p>

    <form method="GET">
        <label for="min">Moyenne minimale :</label>
        <input id="min" type="number" name="min" step="0.01" min="0" max="20" value="<?= htmlspecialchars((string) $min) ?>">
        <label for="tri">Trier par :</label>
        <select id="tri" name="tri">
            <option value="nom" <?= $tri === 'nom' ? 'selected' : '' ?>>Nom</option>
            <option value="moyenne" <?= $tri === 'moyenne' ? 'selected' : '' ?>>Moyenne (décroissante)</option>
        </select>
        <button type="submit">Appliquer</button>
    </form>

    <table>
        <thead>
            <tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Âge</th><th>Formation</th><th>Moyenne</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= (int) $etudiant['id'] ?></td>
                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                <td><?= (int) $etudiant['age'] ?></td>
                <td><?= htmlspecialchars($etudiant['formation']) ?></td>
                <td><?= htmlspecialchars((string) $etudiant['moyenne']) ?></td>
                <td>
                    <a href="modifier.php?id=<?= (int) $etudiant['id'] ?>">Modifier</a>
                    <form method="POST" action="supprimer.php" style="display:inline"
                          onsubmit="return confirm('Supprimer cet étudiant ?');">
                        <input type="hidden" name="id" value="<?= (int) $etudiant['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($etudiants) === 0): ?>
            <tr><td colspan="7">Aucun étudiant.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
