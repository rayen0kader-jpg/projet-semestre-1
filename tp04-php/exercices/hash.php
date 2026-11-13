<?php
// Activités 16 et 17 : password_hash() et password_verify()
$password = "123456";
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Hash : " . $hash . "<br>";
echo "Avec 123456 : " . (password_verify("123456", $hash) ? "Mot de passe correct." : "Mot de passe incorrect.") . "<br>";
echo "Avec abcdef : " . (password_verify("abcdef", $hash) ? "Mot de passe correct." : "Mot de passe incorrect.") . "<br>";
