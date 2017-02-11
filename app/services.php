<?php
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;


class services{
    
    //fonction de deconnection de l'utilisateur par destruction de la session.
    
    public function logout(Application $app){
                if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_unset();
            session_destroy();
        }
    
        
        // fonction verifiant que toutes les informations obligatoires de la fiche aient été saisies.
        // param : tableau des valeurs de la fiche.
        
    public function FicheComplete($fiche){
        $result = true;
        foreach($fiche as $key => $value){
            if( $key == 'commune_naiss' || $key == 'civilite' || $key == 'commune_naiss' || $key == 'dept_naiss' || $key == 'date_naiss' || $key == 'discipline' || $key == 'nationalite' ||$key == 'adresse' ||$key == 'cp' ||$key == 'ville' || $key == 'num_secu' || $key == 'ville' || $key == 'telephone' || $key == 'code_mutuelle' || $key == 'id_statut' ){
                    if(empty($value)){
                        $result = false;
                    }
            }
        }
        return $result;
    }
    
    public function FichePdf($fiche){
        
        return $result;
    }
        
        
    }
    
        $app['services'] = function () {
        return new services();
    }
?>