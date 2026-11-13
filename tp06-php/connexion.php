<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/connexion_bdd.php';

if (estConnecte()) {
    header("Location: dashboard.php");
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $sql = "SELECT id, username, password_hash, role, actif
                FROM utilisateurs
                WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur
            && (int) $utilisateur['actif'] === 1
            && password_verify($password, $utilisateur['password_hash'])) {

            // Nouvel identifiant de session après authentification (évite la fixation de session)
            session_regenerate_id(true);

            $_SESSION['connecte'] = true;
            $_SESSION['user_id']  = (int) $utilisateur['id'];
            $_SESSION['username'] = $utilisateur['username'];
            $_SESSION['role']     = $utilisateur['role'];

            header("Location: dashboard.php");
            exit;
        } else {
            // Même message pour : compte inexistant, mauvais mot de passe, compte désactivé
            $erreur = "Identifiants incorrects.";
        }
    }
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
</body>
</html>
