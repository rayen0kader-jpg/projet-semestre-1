<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/connexion_bdd.php';
protegerPage();
require_once __DIR__ . '/fonctions.php';

// La suppression n'est acceptée que par POST (jamais par un simple lien GET)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: etudiants.php");
    exit;
}

$id = lireId($_POST['id'] ?? null);
if ($id === null) {
    header("Location: etudiants.php?msg=introuvable");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = :id");
$stmt->execute(['id' => $id]);

// rowCount() = nombre de lignes réellement supprimées
$msg = $stmt->rowCount() > 0 ? 'supprime' : 'introuvable';
header("Location: etudiants.php?msg=" . $msg);
exit;
