<?php

require_once '/class.pdoAgisse.php';
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

//********************************************Contrôleur Super User*****************//
class AdministratorController {
    
    private $pdo;
    private $columnsName;
//    private $titles;
        
    public function __construct() {
        ob_start();             // démarre le flux de sortie
        require_once __DIR__ . '/../views/v_header.php';
        require_once __DIR__ . '/../views/v_menu.php';
        $this->pdo = PdoAgisse::getPdoAgisse();
    }
        
    public function home()
    {
        //require_once __DIR__.'/../vues/v_connexion.php';
        require_once __DIR__ . '/../views/v_home.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
        public function manageAffiliation()
    {
        $hide = false;
        $sTable = 'mutuelle';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        $data = $this->pdo->getDataAffiliations();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
    public function manageRegime()
    {
        $hide = true;
        $sTable = 'statut';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        $data = $this->pdo->getDataRegimes();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
        public function manageNationalite()
    {
        $hide = false;
        $sTable = 'nationalite';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        $data = $this->pdo->getDataNationalites();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
    public function manageSchool()
    {
        $hide = true;
        $sTable = 'info_etablissmeent';
        $this->formDatatable($sTable,$hide);
        $columnsName = $this->columnsName;
        $data = $this->pdo->getDataEtablissements();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
        
    
        
    public function manageApplication()
    {
        
    }
    public function logOut()
    {
        require_once __DIR__ . '/../views/v_logOut.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    public function formDatatable($sTable, $hide)
    {
        
        $this->columnsName = $this->pdo->getColumnsName($sTable);
        $columnsName = $this->columnsName;
        require_once __DIR__ . '/../views/v_formEditDatatable.php';
    }
    public function updateDataTable(Application $app)
    {
        $data = $_POST['data'];
        $table = $_POST['table'];
        //Récupérer le nom et la valeur de la clé primaire
        //c'est à dire la première valeur du tableau
        $primary_key_value = reset($data);
        $primary_key_name = key($data);
        //tester si la valeur de la clé primaire existe
        $exist = $this->pdo->verifExiste($table, $primary_key_name, $primary_key_value);
        //Si la clé primaire existe déjà, on fait un update
        if($exist)
        {
            $this->pdo->updateLigneTable($primary_key_name, $primary_key_value ,$table, $data);
        }
           //Si la clé primaire n'existe pas, on fait un insert
        else
        {
            if($_POST['hide'])
            {unset($data[$primary_key_name]);}
//            var_dump($data);
            $this->pdo->insertLigneTable($table,$data);
        }
        return $app->redirect($_SERVER["HTTP_REFERER"]);
    }
    public function deleteDataTable(Application $app)
    {
        
        $table = $_POST['table'];
        $ids = $_POST['id'];
        $primary_key_name = $this->pdo->getPrimaryKey($table);
        $this->pdo->deleteLignesTable($primary_key_name[0],$table,$ids);
        var_dump($table);
        var_dump($ids);
        var_dump($primary_key_name);
//        return $app->redirect($_SERVER["HTTP_REFERER"]);
    }
}
?>


