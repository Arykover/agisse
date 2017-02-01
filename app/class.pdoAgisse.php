f
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
class PdoAgisse {

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=gisse';
    private static $user = 'root';
    private static $mdp = 'root';
    private static $monPdo;
    private static $PdoAgisse = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct() {
        PdoAgisse::$monPdo = new PDO(PdoAgisse::$serveur . ';' . PdoAgisse::$bdd, PdoAgisse::$user, PdoAgisse::$mdp);
        PdoAgisse::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct() {
        PdoAgisse::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe

     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();

     * @return l'unique objet de la classe PdoGsb
     */
    public static function getPdoAgisse() {

        if (PdoAgisse::$PdoAgisse == null) {

            PdoAgisse::$PdoAgisse = new PdoAgisse();
        }
        return PdoAgisse::$PdoAgisse;
    }

    /**
     * Retourne les informations d'un compte
     * @param $login 
     * @param $mdp
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
     */
    public function identification($login, $mdp) {

        $log = htmlentities($login);
//        $m = $this->hashMake($log, htmlentities($mdp));
        echo $mdp;
        if($this->hashCheck($log, htmlentities($mdp)))
        {
        $req = PdoAgisse::$monPdo->prepare("select comptes.id, comptes.login, comptes.nom, comptes.prenom, comptes.type from comptes 
		where comptes.login = ?");
        //probleme longueur ds la bdd et le cryptage
        $req->bindParam(1, $log);
        $req->execute() or die('error id');
        $ligne = $req->fetch();
        return $ligne;
        }
        else
        {return false;}
    }

    /**
     * Verifie si un compte utilisant cet email existe deja
     * @param $mail
     * @return true si aucun compte n'existe, false sinon 
     */
    public function VerifMail($mail) {
        $result = true;
        $m = htmlentities($mail);
        $req = PdoAgisse::$monPdo->prepare("select count(*) as num from comptes 
		where mail = ?");
        $req->bindParam(1, $m);
        $req->execute();
        $tab = $req->fetch();
        if ($tab['num'] != 0) {
            $result = false;
        }
        return $result;
    }

    /**
     * Verifie si un compte utilisant ce nom et ce prenom existe
     * @param $mail
     * @return le nombre de compte existant utilisant ce nom et cette initiale, incrementé de 1
     */
    public function nbUser($Lname, $Fname) {
        $f = htmlentities($Fname);
        $l = htmlentities($Lname);
        $req = PdoAgisse::$monPdo->prepare("select count(*) as num from comptes where nom = ? and substring(prenom,1,1) = ?");
        $req->bindParam(1, $l);
        $req->bindParam(2, $f);
        $req->execute();
        $result = $req->fetch();
        return $result['num'] + 1;
    }

    /**
     * Verifie si un compte utilisant ce nom et ce prenom existe
     * @param $mail
     * @return le nombre de compte existant utilisant ce nom et cette initiale, incrementé de 1
     */
    public function insertUser($login, $pwd, $lName, $fName, $mail, $type) {
        $login = htmlentities($login);
        $cryptPwd = $this->hashMake($login, htmlentities($pwd));
        $lName = htmlentities($lName);
        $fName = htmlentities($fName);
        $mail = htmlentities($mail);
        $req = PdoAgisse::$monPdo->prepare("insert into comptes(nom,prenom,login,pass,mail,type) values(?, ?, ?, ?, ?, ?)");
        $req->bindParam(1, $lName);
        $req->bindParam(2, $fName);
        $req->bindParam(3, $login);
        $req->bindParam(4, $cryptPwd);
        $req->bindParam(5, $mail);
        $req->bindParam(6, $type);
        $req->execute() or die(print_r('error insert'));
    }

    /**
     * Mets à jour le nom et le prenom
     * @param $Lname, $Fname
     */
    public function updateUserNames($id, $lName, $fName) {
        $lName = htmlentities($lName);
        $fName = htmlentities($fName);
        $req = PdoAgisse::$monPdo->prepare("update comptes set nom = ?, prenom = ? where id = ?");
        $req->bindParam(1, $lName);
        $req->bindParam(2, $fName);
        $req->bindParam(3, $id);
        $req->execute();
    }

    /**
     * Mets à jour le mail
     * @param $mail
     */
    public function updateUserMail($id, $mail) {
        $mail = htmlentities($mail);
        $req = PdoAgisse::$monPdo->prepare("update comptes set mail = ? where id = ?");
        $req->bindParam(1, $mail);
        $req->bindParam(2, $id);
        $req->execute();
    }

    /**
     * Mets à jour le mot de passe
     * @param $pwd
     */
    public function updateUserPwd($id, $login, $pwd) {
        $cryptPwd = $this->hashMake($login, htmlentities($pwd));
        $req = PdoAgisse::$monPdo->prepare("update comptes set pass = ? where id = ? and login = ?");
        $req->bindParam(1, $cryptPwd);
        $req->bindParam(2, $id);
        $req->bindParam(3, $login);
        $req->execute();
    }

    /**
     * Verifie si un compte utilisant cet email existe deja
     * @param $mail
     * @return true si aucun compte n'existe, false sinon 
     */
    public function getUserProfile($id) {
        $req = PdoAgisse::$monPdo->prepare("select nom, prenom, mail from comptes where id = ?");
        $req->bindParam(1, $id);
        $req->execute();
        $tab = $req->fetch();
        return $tab;
    }
    
    
        public function getFiche($id) {
        $req = PdoAgisse::$monPdo->prepare("select * from fiches f 
                                           inner join discipline d on f.discipline=d.id
                                           inner join etat e on f.etat=e.code
                                           inner join statut s on f.statut = s.id
                                           inner join nationalite n on f.nationalite = n.code 
                                           where f.id = ?");
        $req->bindParam(1, $id);
        $req->execute();
        $tab = $req->fetch();
        return $tab;
    }
    //salt => généré et stock ds fichier htaccess, compo de login+cléDur
//    $hash = hash("sha256", $password . $salt);
    /**
* Crée une clé de hachage pour un password
*/
    
    public function hashMake($login, $password){
        ///////////////// PREMIER HASH   -> login+cléServ
    $hash1 = hash("sha256", $login . $_SERVER['CLEP']);
        
      ///////////////// SECOND HASH    -> hash1+mdp
    $options = ['cost' => 10,
              'salt' => $hash1,];
                  
    $hash2 = password_hash($password, PASSWORD_BCRYPT, $options);
        
    if ($hash2 === false) {
        throw new RuntimeException('Bcrypt hashing not supported.');
    }
        
    return $hash2;
}
    
///**
//* Vérifie qu'un password correspond à un hachage
//*/

public function hashCheck($login, $password)
{
        $req = PdoAgisse::$monPdo->prepare("select comptes.pass from comptes 
		where comptes.login = ?");
        $req->bindParam(1, $login);
        $req->execute();
        $hashedPassword = $req->fetch();
    return ($this->hashMake($login, htmlentities($password)) === $hashedPassword['pass']);
}
}

//clé stock dans htaccess
//clé sal+hach login => cléUnique
//cléUnique sal+hach mdp => mdpCrypt
