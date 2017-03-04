<?php
/**
 * Déconnecte l'utilisateur de sa session admin
 * 
 * Quand l'utilisateur clique sur l'onglet de déconnexion, il est immédiatement déconnecté 
 * et un message de reconnexion apparait.
 */
?>
    
<h2>Déconnexion réussie !</h2>
<br/>
<br/>
    Pour vous identifier de nouveau, <a href="http://localhost/silexAgisse/web/admin"> Cliquez ici </a>
<br/>
    Pour accéder au site web @GISSE, <a href=http://localhost/silexAgisse/web> Cliquez ici </a>
<br/>
<?php

header('WWW-Authenticate: Basic realm="Vous etes deconnecte"');
header('HTTP/1.0 401 Unauthorized');
exit();
?>

