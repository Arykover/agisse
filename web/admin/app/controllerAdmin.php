<?php

require_once '/class.pdoAgisse.php';
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

//********************************************Contrôleur Super User*****************//
class AdministratorController {

    private $pdo;
    private $sTable;
    private $data;
    private $columnsName;
    
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
        
    }
    
    public function manageSchool()
    {
        $this->sTable = 'info_etablissmeent';
        $sTable = $this->sTable;
        $this->data = $this->pdo->getDataEtablissements();
        $this->formDatatable();
        $columnsName = $this->columnsName;
//        var_dump($columnsName);
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
    public function formDatatable()
    {
        $this->columnsName = $this->pdo->getColumnsName($this->sTable);
        require_once __DIR__ . '/../views/v_formEditDatatable.php';
    }
}
?>