<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/connexion_bdd.php';

$erreurs = [];
$succes = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username     = trim($_POST['username'] ?? '');
    $password     = $_POST['password'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    if ($username === '') {
        $erreurs[] = "Le nom d'utilisateur est obligatoire.";
    } elseif (strlen($username) < 3) {
        $erreurs[] = "Le nom d'utilisateur doit contenir au moins 3 caractères.";
    } elseif (strlen($username) > 50) {
        $erreurs[] = "Le nom d'utilisateur ne doit pas dépasser 50 caractères.";
    }

    if (strlen($password) < 8) {
        $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    if ($password !== $confirmation) {
        $erreurs[] = "Les deux mots de passe ne correspondent pas.";
    }

    if (count($erreurs) === 0) {

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE username = :username");
        $stmt->execute(['username' => $username]);

        if ((int) $stmt->fetchColumn() > 0) {
            $erreurs[] = "Ce nom d'utilisateur est déjà utilisé.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Le rôle est forcé à 'user' : il n'est jamais choisi par le visiteur
            $sql = "INSERT INTO utilisateurs (username, password_hash, role)
                    VALUES (:username, :hash, 'user')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username, 'hash' => $hash]);

            $succes = "Compte créé. Vous pouvez vous connecter.";
            $username = '';
        }
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
        <input id="username" type="text" name="username" value="<?= htmlspecialchars($username) ?>" required>

        <label for="password">Mot de passe :</label>
        <input id="password" type="password" name="password" required>

        <label for="confirmation">Confirmation :</label>
        <input id="confirmation" type="password" name="confirmation" required>

        <button type="submit">S'inscrire</button>
    </form>

    <p><a href="connexion.php">Déjà un compte ? Se connecter</a></p>
</body>
</html>
