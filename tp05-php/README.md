# TP 5 — MySQL/MariaDB et PDO

## Installation
1. Créer la base et la table : `mysql -u root -p < database.sql` (ou importer `database.sql` dans phpMyAdmin).
2. Copier `connexion.example.php` en `connexion.php` et renseigner vos identifiants.
   `connexion.php` est ignoré par Git : les mots de passe ne sont pas publiés.
3. Lancer : `php -S localhost:8000` puis ouvrir http://localhost:8000
4. Tester la connexion : http://localhost:8000/test-connexion.php

## Fonctionnalités
Liste (tri, filtre sur la moyenne, statistiques), ajout, recherche (GET + LIKE), modification, suppression (POST).
Toutes les requêtes utilisent des requêtes préparées PDO et les affichages sont échappés avec `htmlspecialchars()`.
