
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
        $m = htmlentities($mdp);
        $req = PdoAgisse::$monPdo->prepare("select comptes.id, comptes.nom, comptes.prenom, comptes.type from comptes 
		where comptes.login = ? and comptes.pass = ? ");
        $req->bindParam(1, $log);
        $req->bindParam(2, $m);
        $req->execute();
        $ligne = $req->fetch();

        return $ligne;
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
        $lName = htmlentities($lName);
        $fName = htmlentities($fName);
        $mail = htmlentities($mail);
        $req = PdoAgisse::$monPdo->prepare("insert into comptes(nom,prenom,login,mail,type) values(?, ?, ?, ?, ?)");
        $req->bindParam(1, $lName);
        $req->bindParam(2, $fName);
        $req->bindParam(3, $login);
        $req->bindParam(4, $mail);
        $req->bindParam(5, $type);
        $req->execute();
        $lastId = PdoAgisse::$monPdo->lastInsertId();
        $cryptPwd = $this->pwdEncryption($lastId, htmlentities($pwd));
        updateUserPwd($lastId, $cryptPwd);
    }

    /**
     * Mets à jour le nom et le prenom
     * @param $Lname, $Fname
     */
    public function updateUserNames($id, $lName, $fName) {
        $lName = htmlentities($lName);
        $fName = htmlentities($fName);
        $req = $this->prepare("update comptes set nom = ?, prenom = ? where id = ?");
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
    public function updateUserPwd($id, $pwd) {
        $cryptPwd = pwdEncryption($id, htmlentities($pwd));
        $req = PdoAgisse::$monPdo->prepare("update comptes set pass = ? where id = ?");
        $req->bindParam(1, $cryptPwd);
        $req->bindParam(2, $id);
        $req->execute();
    }

    /**
     * Verifie si le mot de passe entré correspond au compte
     * @param $pwd, $id 
     * @return true si il y a correspondance, sinon false 
     */
    public function checkPwd($id, $pwd) {
        $checked = false;
        $req = PdoAgisse::$monPdo->prepare("select pass from comptes
		where id = ?");
        $req->bindParam(1, $id);
        $req->execute();
        $dbPwd = $req->fetch();
        $cryptPwd = $this->pwdEncryption($id, htmlentities($pwd));
        if($dbPwd['pass'] == $cryptPwd)
        {$checked = true;}
        return $checked;
    }
    
    /**
     * Permet de chiffrer le mot de passe passé en paramètre à l'aide de la clé unique du compte
     * @param $pwd, $id 
     * @return true si il y a correspondance, sinon false 
     */
    public function pwdEncryption($id, $pwd){
        $req = PdoAgisse::$monPdo->prepare("select cle from comptes
		where id = ?");
        $req->bindParam(1, $id);
        $req->execute();
        $key = $req->fetch();
        $keyPwd = (htmlentities($pwd).$key['cle']);
        $cryptPwd = sha2($keyPwd,20);
        return $cryptPwd;
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
                                           inner join discipline d on f.discipline=d.id
                                           
                                           where id = ?");
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
//public function hashMake($password)
//{
//    $options = ['cost' => 12
//              'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
// 
//    $hash = password_hash($password, PASSWORD_BCRYPT, $options);
// 
//    if ($hash === false) {
//        throw new RuntimeException('Bcrypt hashing not supported.');
//    }
// 
//    return $hash;
//}
// 
///**
//* Vérifie qu'un password correspond à un hachage
//*/
//public function hashCheck($password, $hashedPassword)
//{
//    if (strlen($hashedPassword) === 0) {
//        return false;
//    }
// 
//    return password_verify($password, $hashedPassword);
//}
}

