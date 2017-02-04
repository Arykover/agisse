
<?php
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;


class services{
    
    
    public function logout(Application $app){
                if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_unset();
            session_destroy();
        }
        
        
    }
    
        $app['services'] = function () {
        return new services();
    }
?>