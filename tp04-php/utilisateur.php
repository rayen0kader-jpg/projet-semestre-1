<?php
// Utilisateur simulé : le mot de passe est stocké sous forme de hash, jamais en clair
$utilisateur = [
    "username" => "admin",
    "password" => password_hash("123456", PASSWORD_DEFAULT)
];
