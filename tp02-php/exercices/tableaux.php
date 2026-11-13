<?php
// Activités 1 à 5 : tableaux indexés
$etudiants = ["Ahmed", "Sami", "Nour", "Amine"];
?>
<!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><title>Tableaux</title></head>
<body>
<h1>Activités 1 à 5</h1>

<h2>Activité 1 : accès par indice</h2>
<?php
echo "<p>Premier : " . $etudiants[0] . "</p>";
echo "<p>Dernier : " . $etudiants[count($etudiants) - 1] . "</p>";
echo "<p>Nombre d'éléments : " . count($etudiants) . "</p>";
echo "<p>\$etudiants[2] = " . $etudiants[2] . "</p>";
// $etudiants[4] n'existe pas : PHP affiche un Warning "Undefined array key 4"
// et la valeur est considérée comme null.
?>

<h2>Activité 2 : parcours avec for</h2>
<?php
for ($i = 0; $i < count($etudiants); $i++) {
    echo "<p>$etudiants[$i]</p>";
}
?>

<h2>Activité 3 : parcours avec foreach</h2>
<?php
foreach ($etudiants as $etudiant) {
    echo "<p>$etudiant</p>";
}
?>

<h2>Activité 4 : ajouter et supprimer</h2>
<?php
$liste = ["Ahmed", "Sami", "Nour", "Amine", "Salma"]; // 5 étudiants
$liste[] = "Yassine";          // ajout
array_pop($liste);             // suppression du dernier
echo "<p>Nombre final : " . count($liste) . "</p>";
foreach ($liste as $nom) {
    echo "<p>$nom</p>";
}
?>

<h2>Activité 5 : recherche avec in_array</h2>
<?php
$nomRecherche = "Nour";
if (in_array($nomRecherche, $etudiants)) {
    echo "<p>Étudiant trouvé</p>";
} else {
    echo "<p>Étudiant non trouvé</p>";
}
?>

<p><a href="../index.php">Retour</a></p>
</body></html>
