CREATE DATABASE IF NOT EXISTS gestion_etudiants
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE gestion_etudiants;

-- Table du TP 5 (si elle n'existe pas encore)
CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    formation VARCHAR(150) NOT NULL,
    moyenne DECIMAL(4,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user',
    actif TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Comptes de démonstration (mots de passe hachés avec bcrypt) :
--   admin      / Admin@2025     (rôle admin)
--   etudiant1  / Etudiant@2025  (rôle user)
-- Pensez à les changer ou à les supprimer en dehors d'un contexte de TP.
INSERT INTO utilisateurs (username, password_hash, role) VALUES
('admin', '$2y$12$KPUka3nCxkOW6tSD83bmzumcHuesvWWq8TROto2uMkbePW.5KMtou', 'admin'),
('etudiant1', '$2y$12$xo5GT5o0BbLF5X2BrhMeT.x/mPK6AoJibZ3DPW6DVtaw2a1NIc14e', 'user');
