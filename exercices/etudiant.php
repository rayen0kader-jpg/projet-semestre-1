<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche étudiant</title>
</head>
<body>

<h1>Fiche étudiant</h1>

<form method="GET" action="">
    <label>Nom :</label>
    <input type="text" name="nom" required><br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required><br><br>

    <label>Âge :</label>
    <input type="number" name="age" required><br><br>

    <label>Formation :</label>
    <input type="text" name="formation" required><br><br>

    <label>Moyenne :</label>
    <input type="number" name="moyenne" step="0.01" required><br><br>

    <button type="submit">Afficher</button>
</form>

<?php
if (isset($_GET['nom'], $_GET['prenom'], $_GET['age'], $_GET['formation'], $_GET['moyenne'])) {
    $nom = htmlspecialchars($_GET['nom']);
    $prenom = htmlspecialchars($_GET['prenom']);
    $age = (int) $_GET['age'];
    $formation = htmlspecialchars($_GET['formation']);
    $moyenne = (float) $_GET['moyenne'];

    echo "<h2>Informations de l'étudiant</h2>";
    echo "<p>Nom : $nom</p>";
    echo "<p>Prénom : $prenom</p>";
    echo "<p>Âge : $age ans</p>";
    echo "<p>Formation : $formation</p>";
    echo "<p>Moyenne : $moyenne</p>";

    if ($moyenne >= 10) {
        echo "<p>Résultat : Admis</p>";
    } else {
        echo "<p>Résultat : Non admis</p>";
    }
}
?>

</body>
</html>
