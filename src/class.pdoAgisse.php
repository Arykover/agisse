
﻿<?php

/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoAgisse qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoAgisse{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gisse';   		
      	private static $user='root' ;    		
      	private static $mdp='root' ;	
	private static $monPdo;
	private static $PdoAgisse=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoAgisse::$monPdo = new PDO(PdoAgisse::$serveur.';'.PdoAgisse::$bdd, PdoAgisse::$user, PdoAgisse::$mdp); 
		PdoAgisse::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoAgisse::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoAgisse(){

		if(PdoAgisse::$PdoAgisse==null){

                        PdoAgisse::$PdoAgisse= new PdoAgisse();
		}
		return PdoAgisse::$PdoAgisse;  
	}
       
   /**
 * Retourne les informations d'un compte
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function identification($login, $mdp){
             
            $log = htmlentities($login);
            $m = htmlentities($mdp);
		$req = PdoAgisse::$monPdo->prepare("select comptes.id, comptes.nom, comptes.prenom, comptes.type from comptes 
		where comptes.login = ? and comptes.pass = ? ");
        $req->bindParam(1, $log);
        $req->bindParam(2, $m);
		$req->execute();
		$ligne = $req->fetch();
               
		return $ligne;       
	}     
        
}