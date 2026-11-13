<?php
// Usage : php generer_hash.php
$motDePasse = "Admin@2025";
echo password_hash($motDePasse, PASSWORD_DEFAULT) . PHP_EOL;
