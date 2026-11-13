<?php
// Activités 6 à 17 et 18 (require_once)
require_once "../fonctions.php";

// Activité 6 : tableau associatif
$etudiant = [
    "nom" => "Khediri",
    "prenom" => "Ahmed",
    "age" => 20,
    "formation" => "Informatique",
    "moyenne" => 14.5,
    "telephone" => "20 123 456",
    "ville" => "Tunis",
    "niveau" => "Licence 2"
];

// Activité 7 : plusieurs étudiants
$etudiants = [
    ["nom" => "Khediri",   "prenom" => "Ahmed", "age" => 20, "moyenne" => 14.5],
    ["nom" => "Ali",       "prenom" => "Sami",  "age" => 21, "moyenne" => 11.5],
    ["nom" => "Ben Salah", "prenom" => "Nour",  "age" => 19, "moyenne" => 16],
];
?>
<!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><title>Étudiants</title></head>
<body>
<h1>Activités 6 à 17</h1>

<h2>Activité 6 : un étudiant</h2>
<?php
echo "<p>Nom : {$etudiant['nom']}</p>";
echo "<p>Prénom : {$etudiant['prenom']}</p>";
echo "<p>Âge : {$etudiant['age']}</p>";
echo "<p>Formation : {$etudiant['formation']}</p>";
echo "<p>Moyenne : {$etudiant['moyenne']}</p>";
echo "<p>Téléphone : {$etudiant['telephone']}</p>";
echo "<p>Ville : {$etudiant['ville']}</p>";
echo "<p>Niveau : {$etudiant['niveau']}</p>";
?>

<h2>Activité 7 : plusieurs étudiants</h2>
<?php foreach ($etudiants as $e) {
    echo "<p>{$e['prenom']} {$e['nom']}, {$e['age']} ans, moyenne {$e['moyenne']}</p>";
} ?>

<h2>Activité 8 : tableau HTML</h2>
<table border="1" cellpadding="6" cellspacing="0">
    <tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Moyenne</th></tr>
    <?php foreach ($etudiants as $e): ?>
    <tr>
        <td><?= $e['nom'] ?></td>
        <td><?= $e['prenom'] ?></td>
        <td><?= $e['age'] ?></td>
        <td><?= $e['moyenne'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Activités 12 et 13 : résultat et affichage</h2>
<?php foreach ($etudiants as $e) { afficherEtudiant($e); echo "<hr>"; } ?>

<h2>Activité 14 : moyenne de la classe</h2>
<p>Moyenne générale : <?= round(calculerMoyenneClasse($etudiants), 2) ?></p>

<h2>Activité 15 : recherche</h2>
<?php
$trouve = rechercherEtudiant($etudiants, "Khediri");
if ($trouve !== null) {
    afficherEtudiant($trouve);
} else {
    echo "Étudiant introuvable.";
}
?>

<h2>Activité 16 : étudiants admis</h2>
<?php foreach (obtenirAdmis($etudiants) as $e) {
    echo "<p>{$e['prenom']} {$e['nom']} ({$e['moyenne']})</p>";
} ?>

<h2>Activité 17 : moyenne ≥ 14</h2>
<?php
$etudiantsBienClasses = filtrerParMoyenne($etudiants, 14);
foreach ($etudiantsBienClasses as $e) {
    echo "<p>{$e['prenom']} {$e['nom']} ({$e['moyenne']})</p>";
}
?>

<p><a href="../index.php">Retour</a></p>
</body></html>
