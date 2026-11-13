<?php
// Une date d'expiration passée demande au navigateur de supprimer le cookie.
setcookie("langue", "", time() - 3600);
echo "Cookie langue supprimé.";
