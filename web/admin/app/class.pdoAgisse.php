<?php

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
    
    public function getColumnsName($tableName)
    {
//        switch($tableName)
//        {
//            case info_etablissmeent : 
//                $tab = ['denomination', 'caisse primaire', 'numero agrément', 'annee scolaire', 'code grand regime'];
//                break;
//            case nationalite : break;
//            case comptes : break;
//        }
        $tableSchema = 'gisse';
        $req = PdoAgisse::$monPdo->prepare("select column_name from information_schema.columns where table_name= ? AND `table_schema` = ?");
        //alias manuel ?
        $req->bindParam(1, $tableName);
        $req->bindParam(2, $tableSchema);
        $req->execute();
        $tab = $req->fetchAll();
        return $tab;
    }
    
    public function getDataAffiliations()
    {
        $req = PdoAgisse::$monPdo->prepare("select * from mutuelle");
        $req->execute();
        $tab = $req->fetchAll();
        return $tab;
    }
    public function getDataRegimes()
    {
        
        $req = PdoAgisse::$monPdo->prepare("select * from statut");
        $req->execute();
        $tab = $req->fetchAll();
        return $tab;
    }
    public function getDataNationalites()
    {
        
        $req = PdoAgisse::$monPdo->prepare("select * from nationalite");
        $req->execute();
        $tab = $req->fetchAll();
        return $tab;
    }
    public function getDataEtablissements()
    {
        $req = PdoAgisse::$monPdo->prepare("select * from info_etablissmeent");
        $req->execute();
        $tab = $req->fetchAll();
        return $tab;
    }
    
    public function updateDataRow($id,$table,$data)
    {
         $sql = "update :table set "; //initialisation de la requete
        $first = false;
        
        $input = array( ':table' =>$table, ':id' => $id ); //initialisation du tableau de parametres à bind pdo
        
        foreach($data as $key => $value ){        //boucle concatenant le champs a modifier dans la requete
            
            if($first){                            // pour le premier champ, ne pas mettre de virgule
                $sql = $sql.", ";
            }       
            $sql = $sql.$key."= :".$key." ";
            $input[':' . $key] = $value;           // ajout du parametre a bind
            $first = 'true';
        }
        
        $sql = $sql."where id = :id ";            // cloture requete
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }
}
