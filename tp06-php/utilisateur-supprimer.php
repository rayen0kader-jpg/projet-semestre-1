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

    if ((int) $utilisateur['id'] === (int) $_SESSION['user_id']) {
        $erreur = "Vous ne pouvez pas supprimer votre propre compte.";
    } elseif ($utilisateur['role'] === 'admin' && (int) $utilisateur['actif'] === 1) {
        // On ne bloque que si la cible est elle-même un admin actif et qu'elle est la dernière
        $nb = (int) $pdo->query("SELECT COUNT(*) FROM utilisateurs WHERE role = 'admin' AND actif = 1")->fetchColumn();
        if ($nb <= 1) {
            $erreur = "Impossible : il doit rester au moins un administrateur actif.";
        }
    }

    if ($erreur === '') {
        $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $stmt->execute(['id' => $utilisateur['id']]);

        $succes = "Utilisateur supprimé.";
        $utilisateur = null;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un utilisateur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Supprimer un utilisateur</h1>
    <p><a href="utilisateurs.php">Retour à la liste</a></p>

    <?php if ($erreur !== ''): ?>
        <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>
    <?php if ($succes !== ''): ?>
        <p class="succes"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <?php if ($utilisateur !== null): ?>
        <p>Confirmer la suppression de <strong><?= htmlspecialchars($utilisateur['username']) ?></strong> ?</p>
        <form method="POST">
            <button type="submit">Supprimer définitivement</button>
        </form>
    <?php endif; ?>
</body>
</html>
