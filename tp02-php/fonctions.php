<?php
// fonctions.php : fonctions réutilisables du TP2

function calculerMoyenne($note1, $note2, $note3)
{
    return ($note1 + $note2 + $note3) / 3;
}

function determinerResultat($moyenne)
{
    if ($moyenne >= 10) {
        return "Admis";
    }
    return "Ajourné";
}

function appreciation($moyenne)
{
    if ($moyenne < 10) {
        return "Insuffisant";
    } elseif ($moyenne < 12) {
        return "Passable";
    } elseif ($moyenne < 14) {
        return "Assez bien";
    } elseif ($moyenne < 16) {
        return "Bien";
    }
    return "Très bien";
}

function afficherEtudiant($etudiant)
{
    echo "<p>Nom : {$etudiant['nom']}</p>";
    echo "<p>Prénom : {$etudiant['prenom']}</p>";
    echo "<p>Âge : {$etudiant['age']}</p>";
    echo "<p>Moyenne : {$etudiant['moyenne']}</p>";
    echo "<p>Résultat : " . determinerResultat($etudiant['moyenne']) . "</p>";
    echo "<p>Appréciation : " . appreciation($etudiant['moyenne']) . "</p>";
}

function calculerMoyenneClasse($etudiants)
{
    if (count($etudiants) === 0) {
        return 0;
    }
    $somme = 0;
    foreach ($etudiants as $etudiant) {
        $somme += $etudiant["moyenne"];
    }
    return $somme / count($etudiants);
}

function rechercherEtudiant($etudiants, $nom)
{
    foreach ($etudiants as $etudiant) {
        if ($etudiant["nom"] === $nom) {
            return $etudiant;
        }
    }
    return null;
}

function obtenirAdmis($etudiants)
{
    $admis = [];
    foreach ($etudiants as $etudiant) {
        if ($etudiant["moyenne"] >= 10) {
            $admis[] = $etudiant;
        }
    }
    return $admis;
}

function filtrerParMoyenne($etudiants, $moyenneMinimale)
{
    $resultat = [];
    foreach ($etudiants as $etudiant) {
        if ($etudiant["moyenne"] >= $moyenneMinimale) {
            $resultat[] = $etudiant;
        }
    }
    return $resultat;
}

function trouverMeilleurEtudiant($etudiants)
{
    if (count($etudiants) === 0) {
        return null;
    }
    $meilleur = $etudiants[0];
    foreach ($etudiants as $etudiant) {
        if ($etudiant["moyenne"] > $meilleur["moyenne"]) {
            $meilleur = $etudiant;
        }
    }
    return $meilleur;
}

// ---- Statistiques (Exercice 3) ----

function meilleureMoyenne($etudiants)
{
    $max = $etudiants[0]["moyenne"];
    foreach ($etudiants as $e) {
        if ($e["moyenne"] > $max) {
            $max = $e["moyenne"];
        }
    }
    return $max;
}

function plusFaibleMoyenne($etudiants)
{
    $min = $etudiants[0]["moyenne"];
    foreach ($etudiants as $e) {
        if ($e["moyenne"] < $min) {
            $min = $e["moyenne"];
        }
    }
    return $min;
}

function compterAdmis($etudiants)
{
    return count(obtenirAdmis($etudiants));
}

function compterMoyenneSuperieure($etudiants, $seuil)
{
    return count(filtrerParMoyenne($etudiants, $seuil));
}

function pourcentageAdmis($etudiants)
{
    if (count($etudiants) === 0) {
        return 0;
    }
    return compterAdmis($etudiants) * 100 / count($etudiants);
}

// ---- Affichage HTML ----

function afficherTableauEtudiants($etudiants)
{
    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Moyenne</th><th>Résultat</th><th>Appréciation</th></tr>";
    foreach ($etudiants as $e) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($e['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($e['prenom']) . "</td>";
        echo "<td>{$e['age']}</td>";
        echo "<td>{$e['moyenne']}</td>";
        echo "<td>" . determinerResultat($e['moyenne']) . "</td>";
        echo "<td>" . appreciation($e['moyenne']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function afficherTousLesEtudiants($etudiants)
{
    foreach ($etudiants as $etudiant) {
        afficherEtudiant($etudiant);
        echo "<hr>";
    }
}
