<?php
// Activité 19 : mini-projet Gestion des étudiants
require_once "fonctions.php";
require_once "donnees.php";

$etudiants = obtenirEtudiants();

// Recherche par nom (GET)
$nomRecherche = trim($_GET["nom"] ?? "");
$etudiantTrouve = $nomRecherche !== "" ? rechercherEtudiant($etudiants, $nomRecherche) : null;

// Filtre par moyenne minimale (GET)
$moyenneMin = $_GET["moyenne_min"] ?? "";
$filtres = [];
if ($moyenneMin !== "" && is_numeric($moyenneMin)) {
    $filtres = filtrerParMoyenne($etudiants, (float) $moyenneMin);
}

$meilleur = trouverMeilleurEtudiant($etudiants);
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Gestion des étudiants</title></head>
<body>
<h1>Gestion des étudiants</h1>

<?php afficherTableauEtudiants($etudiants); ?>

<h2>Statistiques</h2>
<ul>
    <li>Nombre d'étudiants : <?= count($etudiants) ?></li>
    <li>Moyenne de la classe : <?= round(calculerMoyenneClasse($etudiants), 2) ?></li>
    <li>Nombre d'admis : <?= compterAdmis($etudiants) ?></li>
</ul>

<h2>Meilleur étudiant (défi)</h2>
<p><?= htmlspecialchars($meilleur['prenom'] . " " . $meilleur['nom']) ?> avec <?= $meilleur['moyenne'] ?></p>

<h2>Recherche par nom</h2>
<form method="get">
    <input type="text" name="nom" value="<?= htmlspecialchars($nomRecherche) ?>" placeholder="Nom">
    <button type="submit">Rechercher</button>
</form>
<?php
if ($nomRecherche !== "") {
    if ($etudiantTrouve !== null) {
        afficherEtudiant($etudiantTrouve);
    } else {
        echo "<p>Étudiant introuvable.</p>";
    }
}
?>

<h2>Filtrer par moyenne minimale</h2>
<form method="get">
    <input type="number" step="0.01" name="moyenne_min" value="<?= htmlspecialchars($moyenneMin) ?>" placeholder="Ex : 14">
    <button type="submit">Filtrer</button>
</form>
<?php
if ($moyenneMin !== "" && is_numeric($moyenneMin)) {
    echo "<p>" . count($filtres) . " étudiant(s) avec une moyenne ≥ " . htmlspecialchars($moyenneMin) . " :</p>";
    afficherTableauEtudiants($filtres);
}
?>

<p><a href="index.php">Retour</a></p>
</body>
</html>
