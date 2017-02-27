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
        
    public function getPrimaryKey($tableName)
    {
        $tableSchema = 'gisse';
        $req = PdoAgisse::$monPdo->prepare("
            select `column_name`
            FROM `information_schema`.`columns`
            where `table_name`= ? AND `table_schema` = ? AND `column_key` = 'PRI'");
        $req->bindParam(1, $tableName);
        $req->bindParam(2, $tableSchema);
        $req->execute();
        $primary_key_name= $req->fetch();
        return $primary_key_name;
    }
    public function getColumnsName($tableName)
    {
        $tableSchema = 'gisse';
        $req = PdoAgisse::$monPdo->prepare("
                select column_name, data_type
                from information_schema.columns
                where table_name= ? AND `table_schema` = ?");
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
        
    public function verifExiste($table, $primary_key_name, $primary_key_value) {
        $result = false;
        $value = htmlentities($primary_key_value);
        $sql ="select * from $table where $primary_key_name = ?";
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->bindParam(1, $value);
        $req->execute() or die(print_r('cannot ch')) ;
        $tab = $req->fetch();
        if (!empty($tab)) {
            $result = true;
        }
        return $result;
    }
/**
 * Mets à jour les informations d'une table pour la ligne selectionnée dans le datatable, à partir de sa clé primaire récupérée.
 * @param $primary_key_name 
 * @param $primary_key_value 
 * @param $table 
 * @param $lesInfos sous la forme d'un tableau
 * exemple: update nationalite 
 *          set code_nationalite= :code_nationalite , libelle_nationalite= :libelle_nationalite 
 *          where code_nationalite = :code_nationalite
*/
    public function updateLigneTable($primary_key_name,$primary_key_value,$table,$lesInfos)
    {
        $pKvalue = htmlentities($primary_key_value);
         $sql = "update $table set "; //initialisation de la requete
        $first = false;
            $pKname = ":$primary_key_name";
        $input = array($pKname =>$pKvalue ); //initialisation du tableau de parametres à bind pdo
            
        foreach($lesInfos as $key => $value ){        //boucle concatenant le champs a modifier dans la requete
            $val = htmlentities($value);
            if($first){                            // pour le premier champ, ne pas mettre de virgule
                $sql = $sql.", ";
            }       
            $sql = $sql.$key."= :".$key." ";
            $input[':' . $key] = $val;           // ajout du parametre a bind
            $first = 'true';
        }
            
        $sql = $sql."where ".$primary_key_name." = :".$primary_key_name;            // cloture requete
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute($input) or die(print_r('error update')) ;
    }
/**
 * Insère les informations dans une nouvelle ligne de la table donnée
 * @param $table 
 * @param $lesInfos sous la forme d'un tableau
 * exemple: 
 * insert into nationalite (code_nationalite, libelle_nationalite) 
 * values(:code_nationalite , :libelle_nationalite )
*/
    public function insertLigneTable($table,$lesInfos)
    {
         $sql = "insert into $table ("; //initialisation de la requete
        $first = false;
            $champs = '';
            $values = '';
        foreach($lesInfos as $key => $value ){        //boucle concatenant le champs a modifier dans la requete
            $val = htmlentities($value);
            if($first){                            // pour le premier champ, ne pas mettre de virgule
                $champs = $champs.", ";
                $values = $values.", ";
            }       
            $champs = $champs.$key;
            $values = $values.":".$key." ";
            $input[':' . $key] = $val;           // ajout du parametre a bind
            $first = 'true';           
                
        }
            
        $sql = $sql.$champs.") values(".$values.")";            // cloture requete
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute($input) or die(print_r($sql)) ;
    }
    public function deleteLignesTable($primary_key_name, $table, $ids)
    {
        $sql= ("delete from ".$table." where ".$primary_key_name." in( ");
                $first = false;
                    
        foreach($ids as $value ){        //boucle concatenant le champs a modifier dans la requete
            $id = htmlentities($value);
        if($first){                            // pour le premier champ, ne pas mettre de virgule
                $sql = $sql.", ";
            }   
            $sql = $sql.":".$primary_key_name." ";
            $input[':' . $primary_key_name] = $id;           // ajout du parametre a bind
            $first = 'true';
        }
        $sql= $sql.");";
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute($input) or die(print_r($sql));
    }
}
