<?php
session_start();

// Sans cette vérification, on obtient un avertissement si la session n'existe pas
if (!isset($_SESSION['nom'])) {
    exit("Aucune session active. Ouvrez d'abord session.php.");
}
?>
<p>Nom : <?= htmlspecialchars($_SESSION['nom']) ?></p>
<p>Prénom : <?= htmlspecialchars($_SESSION['prenom']) ?></p>
<p>Formation : <?= htmlspecialchars($_SESSION['formation']) ?></p>
<p>Âge : <?= (int) $_SESSION['age'] ?></p>
<p>Email : <?= htmlspecialchars($_SESSION['email']) ?></p>
