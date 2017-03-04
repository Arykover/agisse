<?php

require_once '/class.pdoAgisse.php';
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

/**
 * Définition du controlleur pour l'administrateur
 *
 * Permet d'ajouter, modifier ou supprimer les informations générales de l'application
 * Permet aussi d'importer, exporter les informations sur les élèves
 * Permet aussi de réinitialiser l'application pour une nouvelle année scolaire
 */
class ControlleurAdministrateur {
    
    private $pdo;
    private $nomsColonnes;
        
    public function __construct() {
        ob_start();             // démarre le flux de sortie
        require_once __DIR__ . '/../views/v_entete.php';
        require_once __DIR__ . '/../views/v_menu.php';
        $this->pdo = PdoAgisse::getPdoAgisse();
    }
        
    public function accueil()
    {
        //require_once __DIR__.'/../vues/v_connexion.php';
        require_once __DIR__ . '/../views/v_accueil.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
    public function gestionAffiliation()
    {
        $champId = false;
        $nomTable = 'mutuelle';
        $this->formDatatable($nomTable,$champId);
        $nomsColonnes= $this->nomsColonnes;
        $lesDonnees = $this->pdo->getAffiliations();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
    
    public function gestionRegime()
    {
        $champId = true;
        $nomTable = 'statut';
        $this->formDatatable($nomTable,$champId);
        $nomsColonnes = $this->nomsColonnes;
        $lesDonnees = $this->pdo->getRegimes();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }    
    
    public function gestionNationalite()
    {
        $champId = false;
        $nomTable = 'nationalite';
        $this->formDatatable($nomTable,$champId);
        $nomsColonnes = $this->nomsColonnes;
        $lesDonnees = $this->pdo->getNationalites();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    } 
    
    public function gestionEtablissement()
    {
        $champId = true;
        $nomTable = 'info_etablissmeent';
        $this->formDatatable($nomTable,$champId);
        $nomsColonnes = $this->nomsColonnes;
        $lesDonnees = $this->pdo->getEtablissements();
        require_once __DIR__ . '/../views/v_datatable.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
    public function deconnexion()
    {
        require_once __DIR__ . '/../views/v_deconnexion.php';
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    
    public function formDatatable($nomTable, $champId)
    {
        $this->nomsColonnes = $this->pdo->getNomsColonnes($nomTable);
        $nomsColonnes = $this->nomsColonnes;
        require_once __DIR__ . '/../views/v_formDatatable.php';
    }
    
    /**
    * Ajouter ou mettre à jour une table donnée avec les informations données
    *
    * Soit ajouter une nouvelle ligne avec les informations récupérées en paramètre, pour une table donnée
    * Soit mets à jour une ligne existante à partir de la valeur de la clé primaire donnée, pour une table donnée
    *
    * @param string $ancienId
    *      valeur de la clé primaire avant la modification par l'utilisateur,
    *       elle vaut 'false' si c'est un ajout
    * @param bool $champsId
    *      indique s'il existe un champ 'id' auto-incrémenté pour la table donnée
    * @param array $lesDonnees
    *      tableau contenant les informations de la ligne selectionnée
    * @param string $nomTable
    *      chaine de caractère contenant le nom de la table donnée
    * @param string $valeurClePrimaire
    *      chaine de caractère contenant la valeur de la clé primaire
    * @param string $nomClePrimaire
    *      chaine de caractère contenant le nom du champ de la clé primaire,
    *       le nom du champ de la clé primaire diffère selon la table donnée
    **/
    public function majDataTable(Application $app)
    {
        $ancienId = $_POST['ancienId'];
        $champId = $_POST['champId'];
        $lesDonnees = $_POST['lesDonnees'];
        $nomTable = $_POST['nomTable'];
        // reset(): replace le pointeur de tableau array au premier élément 
        // et retourne la valeur du premier élément.
        // key() retourne la clé courante dans le tableau array.
        $valeurClePrimaire = reset($lesDonnees);
        $nomClePrimaire = key($lesDonnees);
                /*
                 * Tester si l'utilisateur a modifié la valeur de la clé primaire
                 * 
                 * -true  -> mise à jour des informations pour la clé primaire donnée
                 * -false -> vérifier que la clé primaire donnée n'existe pas déjà dans la base de donnée
                 */
                if($ancienId == $valeurClePrimaire) 
                {
                  $this->pdo->majLigneTable($nomClePrimaire, $valeurClePrimaire ,$nomTable, $lesDonnees);
                }
                else
                {
                    /*
                     * Tester si la clé primaire donnée existe déjà dans la base de donnée
                     * 
                     * -true  -> retourne une erreur
                     * -false -> définir si l'action de l'utilisateur est un ajout ou une mise à jour
                     */
                    $existe = $this->pdo->verifExiste($nomTable, $nomClePrimaire, $valeurClePrimaire);
                    if(!$existe)
                    {  
                        /*
                         * Tester si c'est un ajout ou une mise à jour 
                         * 
                         * $ancienId prends la valeur false si c'est un ajout, 
                         * sinon il prends la valeur de la clé primaire de la ligne à modifier
                         * 
                         * -ajout       -> définir si la table donnée a un champ 'id' auto-incrémenté
                         * -mise à jour -> supprimer la ligne avec l'ancienne valeur de la clé primaire récupérée
                         *                  puis ajouter une nouvelle ligne avec la nouvelle clé primaire donnée
                         */
                        if($ancienId != 'false')
                            {$this->pdo->supprimerLigneTable($nomClePrimaire, $ancienId, $nomTable);}
                        else
                            {
                                /*
                                 * Tester si le champ 'id' existe
                                 * 
                                 * Certaines tables ont pour clé primaire 'id' qui est auto-incrémenté,
                                 * d'autres tables ont pour clé primaire une valeur saisie par l'utilisateur
                                 * 
                                 * -true -> on retire la première colonne correspondant au champ 'id' qui est la clé primaire,
                                 *          car pour un ajout, l'id est auto-incrémenté
                                 * -false -> la clé primaire n'est pas id, elle est donc saisie par l'utilisateur,
                                 *           aucun changement
                                 */
                                if($champId)
                                {unset($lesDonnees[$nomClePrimaire]);}
                            }
                        $this->pdo->insererLigneTable($nomTable,$lesDonnees);
                    }
                    else
                    {
                        echo("erreur doublon, vérifier que pour votre saisie, que la valeur ".$valeurClePrimaire." pour le champs ".$nomClePrimaire." n'existe pas déjà");
                    }
                }
        return $app->redirect($_SERVER["HTTP_REFERER"]);
    }
    public function suppLignesDataTable(Application $app)
    {
        
        $nomTable = $_POST['nomTable'];
        $ids = $_POST['id'];
        $nomClePrimaire = $this->pdo->getClePrimaire($nomTable);
            $this->pdo->supprimerLignesTable($nomClePrimaire, $nomTable, $ids);
        return $app->redirect($_SERVER["HTTP_REFERER"]);
    }

    public function reinitialiser(Application $app)
    {
        require_once __DIR__ . '/../views/v_reinitialiser.php'; 
        $view = ob_get_clean(); // récupère le contenu du flux et le vide
        return $view;     // retourne le flux 
    }
    public function importerDonnees(Application $app)
    {
//        $app['servicesAdmin']->IMPORT_TABLES();
    }
    
    public function exporterDonnees(Application $app)
    {
        $app['servicesAdmin']->test();
        $app['servicesAdmin']->EXPORT_TABLES('localhost','root','root','gisse', array("comptes","fiches"));
    }
    public function resetAppli(Application $app)
    {
//        $app['servicesAdmin']->RESET_APPLI();
    }
}

?>


