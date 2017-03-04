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
     *   
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     *    
     * @return objet $PdoAgisse, l'unique objet de la classe PdoGsb
     */
    public static function getPdoAgisse() {
        
        if (PdoAgisse::$PdoAgisse == null) {
            
            PdoAgisse::$PdoAgisse = new PdoAgisse();
        }
        return PdoAgisse::$PdoAgisse;
    }
    
    
    /**
     * Retourne le nom des clés primaires d'une table donnée
     *
     * @param string $nomTable
     * 
     * @return array $nomClePrimaire['column_name']
    **/
    public function getClePrimaire($nomTable)
    {
        $req = PdoAgisse::$monPdo->prepare("
            select `column_name`
            FROM `information_schema`.`columns`
            where `table_name`= ? AND `table_schema` = 'gisse' AND `column_key` = 'PRI'");
        $req->bindParam(1, $nomTable);
        $req->execute();
        $nomClePrimaire= $req->fetch();
        return $nomClePrimaire['column_name'];
    }
    
    
    /**
     * Retourne le nom des champs d'une table donnée
     *
     * @param string $nomTable
     * 
     * @return array $nomsColonnes
    **/
    public function getNomsColonnes($nomTable)
    {
        $req = PdoAgisse::$monPdo->prepare("
                select column_name
                from information_schema.columns
                where table_name= ? AND `table_schema` = 'gisse'");
        $req->bindParam(1, $nomTable);
        $req->execute();
        $nomsColonnes = $req->fetchAll();
        return $nomsColonnes;
    }
    
    
    /**
     * Retourne les données de la table Affiliation
     *
     * @return array $lesDonnees
    **/      
    public function getAffiliations()
    {
        $req = PdoAgisse::$monPdo->prepare("select * from mutuelle");
        $req->execute();
        $lesDonnees = $req->fetchAll();
        return $lesDonnees;
    }
    
    
    /**
     * Retourne les données de la table Regime
     *
     * @return array $lesDonnees
    **/  
    public function getRegimes()
    {
        
        $req = PdoAgisse::$monPdo->prepare("select * from statut");
        $req->execute();
        $lesDonnees = $req->fetchAll();
        return $lesDonnees;
    }
    
    
    /**
     * Retourne les données de la table Nationalite
     *
     * @return array $lesDonnees
    **/  
    public function getNationalites()
    {
        
        $req = PdoAgisse::$monPdo->prepare("select * from nationalite");
        $req->execute();
        $lesDonnees = $req->fetchAll();
        return $lesDonnees;
    }
    
    
    /**
     * Retourne les données de la table Etablissement
     *
     * @return array $lesDonnees
    **/  
    public function getEtablissements()
    {
        $req = PdoAgisse::$monPdo->prepare("select * from info_etablissmeent");
        $req->execute();
        $lesDonnees = $req->fetchAll();
        return $lesDonnees;
    }
    
    
    /**
     * Indique s'il existe déjà une donnée avec la clé primaire donnée pour la table donnée
     *
     * @return bool $existe
    **/  
    public function verifExiste($nomTable, $nomClePrimaire, $valeurClePrimaire) 
    {
        $existe = false;
        $valeur= htmlentities($valeurClePrimaire);
        $sql ="select ".$nomClePrimaire." from $nomTable where $nomClePrimaire = ?";
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->bindParam(1, $valeur);
        $req->execute() or die(print_r('erreur à la vérification')) ;
        $tab = $req->fetch();
        if (!empty($tab)) {
            $existe = true;
        }
        return $existe;
    }
    
    
    /**
     * Mets à jour la ligne avec la clé primaire donnée pour la table donnée
     *
     * @param string $nomClePrimaire
     * @param string $valeurClePrimaire
     * @param string $nomTable
     * @param array $lesInfos
    **/ 
    public function majLigneTable($nomClePrimaire,$valeurClePrimaire,$nomTable,$lesInfos)
    {
        $valeurCP= htmlentities($valeurClePrimaire);
         $sql = "update $nomTable set "; //initialisation de la requete
        $first = false;
            $nomCP = ":$nomClePrimaire";
        $input = array($nomCP =>$valeurCP ); //initialisation du tableau de parametres à bind pdo
            
        foreach($lesInfos as $key => $value ){        //boucle concatenant le champs a modifier dans la requete
            $val = htmlentities($value);
            if($first){                            // pour le premier champ, ne pas mettre de virgule
                $sql = $sql.", ";
            }       
            $sql = $sql.$key."= :".$key." ";
            $input[':' . $key] = $val;           // ajout du parametre a bind
            $first = 'true';
        }
            
        $sql = $sql."where ".$nomClePrimaire." = :".$nomClePrimaire;            // cloture requete
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute($input) or die(print_r('error à la mise à jour')) ;
    }
    
    
    /**
     * Insère une nouvelle ligne avec les informations données, pour la table donnée
     *
     * @param string $nomTable
     * @param string $lesInfos
    **/ 
    public function insererLigneTable($nomTable,$lesInfos)
    {
         $sql = "insert into $nomTable ("; //initialisation de la requete
        $first = false;
            $champs = '';
            $valeurs = '';
        foreach($lesInfos as $key => $value ){        //boucle concatenant le champs a modifier dans la requete
            $val = htmlentities($value);
            if($first){                            // pour le premier champ, ne pas mettre de virgule
                $champs = $champs.", ";
                $valeurs = $valeurs.", ";
            }       
            $champs = $champs.$key;
            $valeurs = $valeurs.":".$key." ";
            $input[':' . $key] = $val;           // ajout du parametre a bind
            $first = 'true';           
                
        }
            
        $sql = $sql.$champs.") values(".$valeurs.")";            // cloture requete
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute($input) or die(print_r("erreur à l'insertion")) ;
    }
    
    
    /**
     * Supprime la ligne dont la clé primaire est donnée, pour la table donnée
     *
     * @param string $nomClePrimaire
     * @param string $valeurClePrimaire
     * @param string $nomTable
    **/ 
    public function supprimerLigneTable($nomClePrimaire,$valeurClePrimaire, $nomTable)
    {
        $valeur = htmlentities($valeurClePrimaire);
        $sql ="delete from $nomTable where $nomClePrimaire = ?";
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->bindParam(1, $valeur);
        $req->execute() or die(print_r("erreur à la suppression")) ;
    }    
    
    
    /**
     * Supprime les lignes dont les clés primaires sont données, pour la table donnée
     *
     * @param string $nomClePrimaire
     * @param string $valeurClePrimaire
     * @param string $nomTable
     * @param array $lesInfos
    **/ 
     public function supprimerLignesTable($nomClePrimaire, $nomTable, $ids)
    {
        $sql= ("delete from ".$nomTable." where ".$nomClePrimaire." in");
        $implode = implode(',', array_fill(0, count($ids), '?'));
        $sql = $sql."( ".$implode. " ) ";
        $req = PdoAgisse::$monPdo->prepare($sql);
        $req->execute($ids) or die(print_r("erreur à la suppression"));
    }
}
