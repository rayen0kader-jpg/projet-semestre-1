<?php
session_start();
require_once __DIR__ . '/fonctions.php';
protegerPage();

$erreurs = [];
$succes = '';
$nom = $prenom = $formation = '';
$age = $moyenne = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Récupération
    $nom       = trim($_POST['nom'] ?? '');
    $prenom    = trim($_POST['prenom'] ?? '');
    $age       = trim($_POST['age'] ?? '');
    $formation = trim($_POST['formation'] ?? '');
    $moyenne   = trim($_POST['moyenne'] ?? '');

    // 2. Validation
    if ($nom === '')       { $erreurs[] = "Le nom est obligatoire."; }
    if ($prenom === '')    { $erreurs[] = "Le prénom est obligatoire."; }
    if ($formation === '') { $erreurs[] = "La formation est obligatoire."; }
    if (filter_var($age, FILTER_VALIDATE_INT) === false || $age < 16 || $age > 40) {
        $erreurs[] = "L'âge doit être un entier compris entre 16 et 40.";
    }
    if (!is_numeric($moyenne) || $moyenne < 0 || $moyenne > 20) {
        $erreurs[] = "La moyenne doit être comprise entre 0 et 20.";
    }

    // 3. Traitement
    if (count($erreurs) === 0) {
        ajouterEtudiant([
            "nom" => $nom, "prenom" => $prenom, "age" => (int) $age,
            "formation" => $formation, "moyenne" => (float) $moyenne
        ]);
        $succes = "Étudiant ajouté : " . $prenom . " " . $nom . " (" . resultat((float) $moyenne) . ").";
        $nom = $prenom = $formation = $age = $moyenne = '';
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
    <nav><a href="dashboard.php">Tableau de bord</a><a href="logout.php">Se déconnecter</a></nav>

    <?php foreach ($erreurs as $e): ?>
        <p class="erreur"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
    <?php if ($succes !== ''): ?>
        <p class="succes"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input id="nom" type="text" name="nom" value="<?= htmlspecialchars($nom) ?>">
        <label for="prenom">Prénom :</label>
        <input id="prenom" type="text" name="prenom" value="<?= htmlspecialchars($prenom) ?>">
        <label for="age">Âge :</label>
        <input id="age" type="number" name="age" value="<?= htmlspecialchars($age) ?>">
        <label for="formation">Formation :</label>
        <input id="formation" type="text" name="formation" value="<?= htmlspecialchars($formation) ?>">
        <label for="moyenne">Moyenne :</label>
        <input id="moyenne" type="number" step="0.01" name="moyenne" value="<?= htmlspecialchars($moyenne) ?>">
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
