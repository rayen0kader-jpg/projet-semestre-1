<?php
// Un cookie créé par setcookie() n'est lisible qu'à la requête suivante.
foreach (['langue', 'nom', 'theme'] as $cle) {
    if (isset($_COOKIE[$cle])) {
        echo htmlspecialchars($cle) . " : " . htmlspecialchars($_COOKIE[$cle]) . "<br>";
    } else {
        echo htmlspecialchars($cle) . " : cookie absent.<br>";
    }
}
