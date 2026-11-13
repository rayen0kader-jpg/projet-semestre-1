<?php
session_start();
$_SESSION['nom'] = "Ahmed";
$_SESSION['prenom'] = "Ali";
$_SESSION['formation'] = "Informatique";
$_SESSION['age'] = 21;
$_SESSION['email'] = "ahmed.ali@example.com";
echo "Session créée.";
