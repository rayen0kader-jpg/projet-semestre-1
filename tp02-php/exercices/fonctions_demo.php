<?php
// Activités 9 à 11 : premières fonctions
require_once "../fonctions.php";

function afficherBonjour($nom = "")
{
    if ($nom === "") {
        echo "Bonjour !";
    } else {
        echo "Bonjour " . $nom;
    }
}

function additionner($a, $b)
{
    return $a + $b;
}
?>
<!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><title>Fonctions</title></head>
<body>
<h1>Activités 9 à 11</h1>

<h2>Activité 9</h2>
<p><?php afficherBonjour(); ?></p>
<p><?php afficherBonjour("Ahmed"); ?></p>
<p><?php afficherBonjour("Sami"); ?></p>
<p><?php afficherBonjour("Nour"); ?></p>

<h2>Activité 10</h2>
<?php $resultat = additionner(10, 20); echo "<p>10 + 20 = $resultat</p>"; ?>

<h2>Activité 11</h2>
<p>Moyenne (12, 14, 16) = <?php echo calculerMoyenne(12, 14, 16); ?></p>
<p>Moyenne (8, 10, 9) = <?php echo round(calculerMoyenne(8, 10, 9), 2); ?></p>

<p><a href="../index.php">Retour</a></p>
</body></html>
