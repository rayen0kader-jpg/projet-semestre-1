CREATE DATABASE IF NOT EXISTS gestion_etudiants
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE gestion_etudiants;

CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    formation VARCHAR(150) NOT NULL,
    moyenne DECIMAL(4,2) NOT NULL
);

INSERT INTO etudiants (nom, prenom, age, formation, moyenne) VALUES
('Dupont', 'Ahmed', 21, 'Informatique', 14.00),
('Martin', 'Sami', 22, 'Informatique', 11.00),
('Ben Salah', 'Ali', 20, 'Informatique', 16.00);

-- Requêtes de l'activité 3 / 4
-- SELECT nom, prenom, moyenne FROM etudiants WHERE moyenne >= 10;
-- SELECT nom, prenom, moyenne FROM etudiants ORDER BY moyenne DESC;
-- UPDATE etudiants SET moyenne = 13.50 WHERE id = 2;
-- DELETE FROM etudiants WHERE id = 4;
