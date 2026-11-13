# TP 6 — Authentification en base de données et protection des pages

## Installation
1. Importer `database.sql` (crée la base, les tables `etudiants` et `utilisateurs`, et deux comptes de démonstration).
2. Copier `connexion_bdd.example.php` en `connexion_bdd.php` et renseigner vos identifiants MySQL.
   `connexion_bdd.php` est ignoré par Git : les mots de passe ne sont pas publiés.
3. Lancer : `php -S localhost:8000` puis ouvrir http://localhost:8000

## Comptes de démonstration
| Utilisateur | Mot de passe | Rôle |
|-------------|--------------|------|
| admin | Admin@2025 | admin |
| etudiant1 | Etudiant@2025 | user |

## Contenu
- Partie A : `connexion.php`, `inscription.php`, `deconnexion.php`, `dashboard.php`, `admin.php`, `auth.php`
- Partie B (admin) : `utilisateurs.php`, `utilisateur-creer.php`, `utilisateur-role.php`, `utilisateur-statut.php`, `utilisateur-supprimer.php`
- Gestion des étudiants protégée : `etudiants.php`, `ajouter.php`, `modifier.php`, `rechercher.php`, `supprimer.php`
- Mots de passe hachés (`password_hash` / `password_verify`), requêtes préparées, `htmlspecialchars()` partout.
