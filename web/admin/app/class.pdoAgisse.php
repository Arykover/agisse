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
        $req = PdoAgisse::$monPdo->prepare("select column_name from information_schema.columns where table_name= ?");
        $req->bindParam(1, $tableName);
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
    public function getData($sql)
    {
         $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }
    
    public function searchFilter()
    {
        $recordsTotal = count(getData("SELECT * FROM ".$MyTable));
        /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i<count($_POST['columns']);$i++){
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
        }
        $where = "WHERE ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */

        $sql = sprintf("SELECT * FROM %s %s", $MyTable , $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s %s ORDER BY %s %s limit %d , %d ", $MyTable , $where ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
    }
    else {
        $sql = sprintf("SELECT * FROM %s ORDER BY %s %s limit %d , %d ", $MyTable ,$orderBy,$orderType ,$start , $length);
        $data = getData($sql);

        $recordsFiltered = $recordsTotal;
    }
    $array = array('recordsTotal' => $recordsTotal, 19, 3 => 13);
    return $recordsFiltered;
    /* END SEARCH */
    }
}
