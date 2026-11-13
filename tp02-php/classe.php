<?php
// Maison - Exercices 2 et 3 : gestion d'une classe et statistiques
require_once "fonctions.php";
require_once "donnees.php";

$etudiants = obtenirEtudiants(); // 10 étudiants avec nom, prenom, age, formation, moyenne

$nomRecherche = trim($_GET["nom"] ?? "");
$moyenneMin = $_GET["moyenne_min"] ?? "";
?>
<!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><title>Gestion d'une classe</title></head>
<body>
<h1>Gestion d'une classe</h1>

<h2>1. Tous les étudiants</h2>
<?php afficherTableauEtudiants($etudiants); ?>

<h2>2 et 3. Statistiques</h2>
<ul>
    <li>Moyenne de la classe : <?= round(calculerMoyenneClasse($etudiants), 2) ?></li>
    <li>Nombre d'admis : <?= compterAdmis($etudiants) ?></li>
    <li>Meilleure moyenne : <?= meilleureMoyenne($etudiants) ?></li>
    <li>Plus faible moyenne : <?= plusFaibleMoyenne($etudiants) ?></li>
    <li>Étudiants avec moyenne ≥ 14 : <?= compterMoyenneSuperieure($etudiants, 14) ?></li>
    <li>Pourcentage d'admis : <?= round(pourcentageAdmis($etudiants), 1) ?> %</li>
</ul>

<h2>4. Rechercher un étudiant</h2>
<form method="get">
    <input type="text" name="nom" value="<?= htmlspecialchars($nomRecherche) ?>" placeholder="Nom">
    <button type="submit">Rechercher</button>
</form>
<?php
if ($nomRecherche !== "") {
    $e = rechercherEtudiant($etudiants, $nomRecherche);
    if ($e !== null) { afficherEtudiant($e); } else { echo "<p>Étudiant introuvable.</p>"; }
}
?>

<h2>5. Filtrer selon une moyenne minimale</h2>
<form method="get">
    <input type="number" step="0.01" name="moyenne_min" value="<?= htmlspecialchars($moyenneMin) ?>">
    <button type="submit">Filtrer</button>
</form>
<?php
if ($moyenneMin !== "" && is_numeric($moyenneMin)) {
    afficherTableauEtudiants(filtrerParMoyenne($etudiants, (float) $moyenneMin));
}
?>

<p><a href="index.php">Retour</a></p>
</body></html>
