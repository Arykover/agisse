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
        $hide = true;
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
        $primaryKey = $_POST['primaryKey'];
        $table = $_POST['table'];
        //Récupérer le nom et la valeur de la clé primaire(1ère entrée de $data)
        $primary_key_value = reset($primaryKey);
        $primary_key_name = key($primaryKey);
        //tester si first_key et sa value existe dans la bdd
        $exist = $this->pdo->VerifExiste($table, $primary_key_name, $primary_key_value);
        echo $exist;
           //Updata entry
        //Si la clé primaire est déjà existante, on fait un update
        if($exist)
           {
               $this->pdo->updateDataRow($primary_key_name, $primary_key_value ,$table, $data);
           }
        return $app->redirect($app["url_generator"]->generate("GestionEtablissement"));
//            $this->manageSchool();
    }
}
?>


