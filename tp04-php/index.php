<?php
session_start();
require_once __DIR__ . '/fonctions.php';
header("Location: " . (estConnecte() ? "dashboard.php" : "login.php"));
exit;
