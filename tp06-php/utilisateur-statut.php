<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/connexion_bdd.php';

protegerAdmin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    exit("Identifiant invalide.");
}

$stmt = $pdo->prepare("SELECT id, username, role, actif FROM utilisateurs WHERE id = :id");
$stmt->execute(['id' => $id]);
$utilisateur = $stmt->fetch();

if (!$utilisateur) {
    exit("Utilisateur introuvable.");
}

$erreur = '';
$succes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nouvelEtat = (int) ($_POST['actif'] ?? -1);

    if (!in_array($nouvelEtat, [0, 1], true)) {
        $erreur = "Valeur invalide.";
    } elseif ((int) $utilisateur['id'] === (int) $_SESSION['user_id'] && $nouvelEtat === 0) {
        $erreur = "Vous ne pouvez pas désactiver votre propre compte.";
    } else {
        if ($utilisateur['role'] === 'admin'
            && (int) $utilisateur['actif'] === 1
            && $nouvelEtat === 0) {
            $nb = (int) $pdo->query("SELECT COUNT(*) FROM utilisateurs WHERE role = 'admin' AND actif = 1")->fetchColumn();
            if ($nb <= 1) {
                $erreur = "Impossible : il doit rester au moins un administrateur actif.";
            }
        }

        if ($erreur === '') {
            $stmt = $pdo->prepare("UPDATE utilisateurs SET actif = :actif WHERE id = :id");
            $stmt->execute(['actif' => $nouvelEtat, 'id' => $utilisateur['id']]);

            $utilisateur['actif'] = $nouvelEtat;
            $succes = "Statut mis à jour.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Activer / Désactiver</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Statut de <?= htmlspecialchars($utilisateur['username']) ?></h1>
    <p><a href="utilisateurs.php">Retour à la liste</a></p>

    <?php if ($erreur !== ''): ?>
        <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>
    <?php if ($succes !== ''): ?>
        <p class="succes"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <p>Statut actuel : <?= $utilisateur['actif'] ? 'Actif' : 'Inactif' ?></p>

    <form method="POST">
        <?php if ($utilisateur['actif']): ?>
            <input type="hidden" name="actif" value="0">
            <button type="submit">Désactiver</button>
        <?php else: ?>
            <input type="hidden" name="actif" value="1">
            <button type="submit">Activer</button>
        <?php endif; ?>
    </form>
</body>
</html>
