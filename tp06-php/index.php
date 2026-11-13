<?php
require_once __DIR__ . '/auth.php';
header("Location: " . (estConnecte() ? "dashboard.php" : "connexion.php"));
exit;
