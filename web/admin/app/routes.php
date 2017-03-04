<?php

/**
 * Définition des routes du controlleur administrateur
 */
$app->match('/', "ControlleurAdministrateur::accueil");
$app->match('/accueil', "ControlleurAdministrateur::accueil")
        ->bind('accueil');
$app->match('/gestionAffiliation', "ControlleurAdministrateur::gestionAffiliation")
        ->bind('affiliation');
$app->match('/gestionRegime', "ControlleurAdministrateur::gestionRegime")
        ->bind('regime');
$app->match('/gestionNationalite', "ControlleurAdministrateur::gestionNationalite")
        ->bind('nationalite');
$app->match('/gestionEtablissement', "ControlleurAdministrateur::gestionEtablissement")
        ->bind('etablissement');
$app->match('/reinitialiser', "ControlleurAdministrateur::reinitialiser")
        ->bind('reinitialiser');
$app->match('/deconnexion', "ControlleurAdministrateur::deconnexion")
        ->bind('deconnexion');
$app->match('/majDataTable', "ControlleurAdministrateur::majDataTable")
        ->bind('majDataTable');
$app->match('/suppLignesDataTable', "ControlleurAdministrateur::suppLignesDataTable")
        ->bind('suppLignesDataTable');
$app->match('/exporterDonnees', "ControlleurAdministrateur::exporterDonnees")
        ->bind('exporter');

?>
