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
            if( $key == 'commune' || $key == 'pays_naiss' || $key == 'civilite' || $key == 'commune' || $key == 'dept_naiss' || $key == 'date_naiss' || $key == 'discipline' || $key == 'nationalite' ||$key == 'adresse' ||$key == 'cp' ||$key == 'ville' || $key == 'num_secu' || $key == 'ville' || $key == 'telephone' || $key == 'code_mutuelle' || $key == 'id_statut' ){
                    if(empty($value)){
                        $result = false;
                    }
            }
        }
        return $result;
    }
    
    public function pwdGenerator(){  
        
        $password = '';
        $nb = rand(8, 15);
        $caract = "abcdefghijklmnopqrstuvwyxz0123456789@!:;,§/?*µ$=+";
        $len = strlen($caract);
        for($i = 1; $i <= $nb; $i++) {
          $password += $caract[mt_rand(0,(strlen($caract)-1))];
      }
      return $password;
    }
    
    public function FichePdf($fiche){
        
        return $result;
    }
    
        public function sendMail($body, $Mail ,$Name, $Subject, $attach){
            
            $transport = Swift_SmtpTransport::newInstance('smtp.free.fr', 25);

        $mailer = Swift_Mailer::newInstance($transport);
                // Create the message
        $message = Swift_Message::newInstance()
        // Give the message a subject
        ->setSubject($Subject)
        // Set the From address with an associative array
        ->setFrom(array('agisse@noreply.com' => 'agisse'))
        // Set the To addresses with an associative array
        ->setTo(array($Mail => $Name))
        // Give it a body
        ->setBody($body);
        // Optionally add any attachments
        if($attach){
               $message->attach(Swift_Attachment::newInstance($attach->Output('Fiche.pdf','S'), 'Fiche cerfa secu.pdf', 'application/pdf'));
        }
               if ($mailer->send($message))

        {

        echo "The message was sent successfully!";

        }

        else

        {

        echo "Error sending email message";

        }
            
    }
        
    }
    
        $app['services'] = function () {
        return new services();
    }
?>