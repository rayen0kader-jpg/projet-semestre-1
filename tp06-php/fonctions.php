<?php
// Fonctions réutilisables : elles ne produisent pas de HTML.

function recupererEtudiant(PDO $pdo, int $id)
{
    $stmt = $pdo->prepare("SELECT id, nom, prenom, age, formation, moyenne FROM etudiants WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(); // tableau associatif ou false
}

function lireId($valeur)
{
    $id = filter_var($valeur, FILTER_VALIDATE_INT);
    return ($id !== false && $id > 0) ? $id : null;
}

// Valide les données d'un étudiant. Retourne [valeurs nettoyées, erreurs].
function validerEtudiant(array $post): array
{
    $v = [
        'nom'       => trim($post['nom'] ?? ''),
        'prenom'    => trim($post['prenom'] ?? ''),
        'age'       => trim($post['age'] ?? ''),
        'formation' => trim($post['formation'] ?? ''),
        'moyenne'   => trim($post['moyenne'] ?? ''),
    ];
    $erreurs = [];

    if ($v['nom'] === '')       { $erreurs[] = "Le nom est obligatoire."; }
    if ($v['prenom'] === '')    { $erreurs[] = "Le prénom est obligatoire."; }
    if ($v['formation'] === '') { $erreurs[] = "La formation est obligatoire."; }

    if (filter_var($v['age'], FILTER_VALIDATE_INT) === false || (int) $v['age'] < 16) {
        $erreurs[] = "L'âge doit être un entier supérieur ou égal à 16.";
    }
    if (!is_numeric($v['moyenne']) || $v['moyenne'] < 0 || $v['moyenne'] > 20) {
        $erreurs[] = "La moyenne doit être un nombre compris entre 0 et 20.";
    }
    return [$v, $erreurs];
}

function resultat($moyenne)
{
    return $moyenne >= 10 ? "Admis" : "Ajourné";
}
