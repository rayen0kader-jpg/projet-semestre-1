<?php
// Les cookies sont enregistrés côté navigateur. 3600 = durée de vie en secondes (1 heure).
setcookie("langue", "fr", time() + 3600);
setcookie("nom", "Ahmed", time() + 3600);
setcookie("theme", "sombre", time() + 3600);
echo "Cookies créés. Ouvrez maintenant lire-cookie.php.";
