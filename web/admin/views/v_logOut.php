<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of deconnexion
 *
 * @author Fifine
 */

//// deconnexion d'une authentification faite par .htaccess
// realm doit être le même que celui de .htaccess 
//realm c'est AuthName "......." du htaccess
//echo 'Texte affiche en cas d\'annulation';deconnexion
?>
    
<h2>Déconnexion réussie !</h2>
<br/>
<br/>
    Pour vous identifier de nouveau, <a href=""> Cliquez ici </a>
<br/>
    Pour accéder au site web @GISSE, <a href=http://localhost/silexAgisse/web> Cliquez ici </a>
<br/>
<?php

header('WWW-Authenticate: Basic realm="Vous etes deconnecte"');
header('HTTP/1.0 401 Unauthorized');
//header("Location: http://deconnexion:deconnexion@localhost/silexAgisse/web/admin/deconnexion.php");
exit();
?>

