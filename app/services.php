<?php
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;


class Services{
    /**
    * Détruit la session active
    */
    public function logOut(){
		if (isset($_COOKIE[session_name()])) 
		{
			setcookie(session_name(), '', time()-42000, '/');
		}
		session_unset();
		session_destroy();
    }
}
?>