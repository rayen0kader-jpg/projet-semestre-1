<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/connexion_bdd.php';
protegerPage();
require_once __DIR__ . '/fonctions.php';

$erreurs = [];
$succes = '';
$v = ['nom' => '', 'prenom' => '', 'age' => '', 'formation' => '', 'moyenne' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$v, $erreurs] = validerEtudiant($_POST);

    if (count($erreurs) === 0) {
        try {
            $sql = "INSERT INTO etudiants (nom, prenom, age, formation, moyenne)
                    VALUES (:nom, :prenom, :age, :formation, :moyenne)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nom'       => $v['nom'],
                'prenom'    => $v['prenom'],
                'age'       => (int) $v['age'],
                'formation' => $v['formation'],
                'moyenne'   => $v['moyenne'],
            ]);
            $succes = "Étudiant ajouté avec succès.";
            $v = ['nom' => '', 'prenom' => '', 'age' => '', 'formation' => '', 'moyenne' => ''];
        } catch (PDOException $e) {
            $erreurs[] = "Une erreur est survenue lors de l'enregistrement.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ajouter un étudiant</h1>
    <nav><a href="dashboard.php">Tableau de bord</a><a href="deconnexion.php">Se déconnecter</a><a href="etudiants.php">Liste</a></nav>

    <?php foreach ($erreurs as $e): ?>
        <p class="erreur"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
    <?php if ($succes !== ''): ?>
        <p class="succes"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input id="nom" type="text" name="nom" value="<?= htmlspecialchars($v['nom']) ?>" required>
        <label for="prenom">Prénom :</label>
        <input id="prenom" type="text" name="prenom" value="<?= htmlspecialchars($v['prenom']) ?>" required>
        <label for="age">Âge :</label>
        <input id="age" type="number" name="age" min="16" max="100" value="<?= htmlspecialchars($v['age']) ?>" required>
        <label for="formation">Formation :</label>
        <input id="formation" type="text" name="formation" value="<?= htmlspecialchars($v['formation']) ?>" required>
        <label for="moyenne">Moyenne :</label>
        <input id="moyenne" type="number" name="moyenne" min="0" max="20" step="0.01" value="<?= htmlspecialchars($v['moyenne']) ?>" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
