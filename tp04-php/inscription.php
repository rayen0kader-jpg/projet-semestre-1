<?php
session_start();
require_once __DIR__ . '/fonctions.php';

$erreurs = [];
$succes = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username     = trim($_POST['username'] ?? '');
    $password     = $_POST['password'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    if ($username === '') {
        $erreurs[] = "Le nom d'utilisateur est obligatoire.";
    }
    if (strlen($password) < 6) {
        $erreurs[] = "Le mot de passe doit contenir au moins 6 caractères.";
    }
    if ($password !== $confirmation) {
        $erreurs[] = "Les deux mots de passe ne correspondent pas.";
    }
    if ($username !== '' && isset(getUtilisateurs()[$username])) {
        $erreurs[] = "Ce nom d'utilisateur existe déjà.";
    }

    if (count($erreurs) === 0) {
        // Stockage temporaire dans la session (une vraie base arrive au TP 5/6)
        $_SESSION['utilisateurs'][$username] = password_hash($password, PASSWORD_DEFAULT);
        $succes = "Compte créé. Vous pouvez vous connecter.";
        $username = '';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Créer un compte</h1>
    <?php foreach ($erreurs as $e): ?>
        <p class="erreur"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
    <?php if ($succes !== ''): ?>
        <p class="succes"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input id="username" type="text" name="username" value="<?= htmlspecialchars($username) ?>">
        <label for="password">Mot de passe :</label>
        <input id="password" type="password" name="password">
        <label for="confirmation">Confirmation :</label>
        <input id="confirmation" type="password" name="confirmation">
        <button type="submit">S'inscrire</button>
    </form>
    <p><a href="login.php">Déjà un compte ? Se connecter</a></p>
    <p><small>Note : les comptes créés ici vivent dans la session et disparaissent à la déconnexion.</small></p>
</body>
</html>
