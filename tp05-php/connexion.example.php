<?php
// Copier ce fichier en connexion.php puis renseigner vos vrais identifiants.
// connexion.php est ignoré par Git (.gitignore) : ne le publiez jamais.

$host = 'localhost';
$dbname = 'gestion_etudiants';
$username = 'votre_utilisateur';
$password = 'votre_mot_de_passe';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Aucun détail technique affiché à l'utilisateur
    exit("Impossible de se connecter à la base de données.");
}
