# TP 4 — Sessions, cookies et authentification

Lancer : `php -S localhost:8000` depuis ce dossier, puis ouvrir http://localhost:8000

- Compte de test : `admin` / `123456` (le mot de passe est vérifié avec `password_verify()`, voir `utilisateur.php`)
- `exercices/` : activités 1 à 17 (sessions, cookies, hash)
- Application : `login.php`, `dashboard.php`, `ajouter.php`, `rechercher.php`, `logout.php`, `inscription.php`
- Pages protégées par `protegerPage()` (défini dans `fonctions.php`)
- Les données sont temporaires (stockées dans la session) : la base de données arrive au TP 5.
