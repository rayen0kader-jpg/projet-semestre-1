<?php
session_start();
require_once __DIR__ . '/fonctions.php';

if (estConnecte()) {
    header("Location: dashboard.php");
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $utilisateurs = getUtilisateurs();

    if (isset($utilisateurs[$username]) && password_verify($password, $utilisateurs[$username])) {
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        $_SESSION['connecte'] = true;
        header("Location: dashboard.php");
        exit;
    }
    // Message volontairement identique pour un mauvais nom ou un mauvais mot de passe
    $erreur = "Identifiants incorrects.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Connexion</h1>
    <?php if ($erreur !== ''): ?>
        <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input id="username" type="text" name="username" required>
        <label for="password">Mot de passe :</label>
        <input id="password" type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
    <p><a href="inscription.php">Créer un compte</a></p>
    <p><small>Compte de test : admin / 123456</small></p>
</body>
</html>
