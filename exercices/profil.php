<?php
$prenom = "Rayen";
$nom = "Ben Abdelkader";
$age = 20;
$formation = "Informatique";
$annee = "2ème année";
$moyenne = 14.5;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil étudiant</title>
</head>
<body>

    <h1>Profil étudiant</h1>

    <p>Nom complet : <?php echo $prenom . " " . $nom; ?></p>
    <p>Âge : <?php echo $age; ?> ans</p>
    <p>Formation : <?php echo $formation; ?></p>
    <p>Année : <?php echo $annee; ?></p>
    <p>Moyenne : <?php echo $moyenne; ?></p>

    <?php
    if ($moyenne >= 10) {
        echo "<p>Résultat : Année validée</p>";
    } else {
        echo "<p>Résultat : Année non validée</p>";
    }
    ?>

</body>
</html>
