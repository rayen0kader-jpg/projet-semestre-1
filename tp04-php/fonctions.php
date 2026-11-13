<?php
// Fonctions communes du projet "Gestion des étudiants" (TP 4)

function resultat($moyenne)
{
    return $moyenne >= 10 ? "Admis" : "Ajourné";
}

function estConnecte()
{
    return isset($_SESSION['connecte']) && $_SESSION['connecte'] === true;
}

function protegerPage()
{
    if (!estConnecte()) {
        header("Location: login.php");
        exit;
    }
}

// Étudiants de départ (les données restent temporaires dans ce TP)
function etudiantsParDefaut()
{
    return [
        ["nom" => "Dupont",    "prenom" => "Ahmed", "age" => 21, "formation" => "Informatique", "moyenne" => 14.0],
        ["nom" => "Martin",    "prenom" => "Sami",  "age" => 22, "formation" => "Informatique", "moyenne" => 11.0],
        ["nom" => "Ben Salah", "prenom" => "Ali",   "age" => 20, "formation" => "Informatique", "moyenne" => 16.0],
    ];
}

// La liste vit dans la session : elle survit entre les pages, mais disparaît à la déconnexion
function getEtudiants()
{
    if (!isset($_SESSION['etudiants'])) {
        $_SESSION['etudiants'] = etudiantsParDefaut();
    }
    return $_SESSION['etudiants'];
}

function ajouterEtudiant(array $etudiant)
{
    $liste = getEtudiants();
    $liste[] = $etudiant;
    $_SESSION['etudiants'] = $liste;
}

function rechercherParNom(array $etudiants, $nom)
{
    $trouves = [];
    foreach ($etudiants as $e) {
        if (stripos($e['nom'], $nom) !== false) {
            $trouves[] = $e;
        }
    }
    return $trouves;
}

// Utilisateurs : l'admin de départ + les comptes créés via inscription.php
function getUtilisateurs()
{
    require __DIR__ . '/utilisateur.php';
    $liste = [$utilisateur['username'] => $utilisateur['password']];
    foreach ($_SESSION['utilisateurs'] ?? [] as $nom => $hash) {
        $liste[$nom] = $hash;
    }
    return $liste;
}
