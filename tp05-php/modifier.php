<?php
require_once __DIR__ . '/connexion.php';
require_once __DIR__ . '/fonctions.php';

$id = lireId($_GET['id'] ?? null);
if ($id === null) {
    exit("Identifiant invalide.");
}

$etudiant = recupererEtudiant($pdo, $id);
if (!$etudiant) {
    exit("Étudiant introuvable.");
}

$erreurs = [];
$succes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$v, $erreurs] = validerEtudiant($_POST);

    if (count($erreurs) === 0) {
        try {
            $sql = "UPDATE etudiants
                    SET nom = :nom, prenom = :prenom, age = :age,
                        formation = :formation, moyenne = :moyenne
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nom'       => $v['nom'],
                'prenom'    => $v['prenom'],
                'age'       => (int) $v['age'],
                'formation' => $v['formation'],
                'moyenne'   => $v['moyenne'],
                'id'        => $id,
            ]);
            $succes = "Étudiant modifié avec succès.";
        } catch (PDOException $e) {
            $erreurs[] = "Une erreur est survenue lors de la modification.";
        }
    }
    // On réaffiche les valeurs envoyées (ou les nouvelles valeurs enregistrées)
    $etudiant = array_merge($etudiant, $v);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Modifier l'étudiant n° <?= (int) $etudiant['id'] ?></h1>
    <nav><a href="index.php">Accueil</a><a href="liste.php">Liste</a></nav>

    <?php foreach ($erreurs as $e): ?>
        <p class="erreur"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
    <?php if ($succes !== ''): ?>
        <p class="succes"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <!-- L'identifiant vient de l'URL : il n'est pas modifiable dans le formulaire -->
    <form method="POST">
        <label for="nom">Nom :</label>
        <input id="nom" type="text" name="nom" value="<?= htmlspecialchars((string) $etudiant['nom']) ?>" required>
        <label for="prenom">Prénom :</label>
        <input id="prenom" type="text" name="prenom" value="<?= htmlspecialchars((string) $etudiant['prenom']) ?>" required>
        <label for="age">Âge :</label>
        <input id="age" type="number" name="age" min="16" max="100" value="<?= htmlspecialchars((string) $etudiant['age']) ?>" required>
        <label for="formation">Formation :</label>
        <input id="formation" type="text" name="formation" value="<?= htmlspecialchars((string) $etudiant['formation']) ?>" required>
        <label for="moyenne">Moyenne :</label>
        <input id="moyenne" type="number" name="moyenne" min="0" max="20" step="0.01" value="<?= htmlspecialchars((string) $etudiant['moyenne']) ?>" required>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
