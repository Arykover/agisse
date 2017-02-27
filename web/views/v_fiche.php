
<div class='container'>
    <div class='container col-md-offset-2 col-md-8'>
    <form  id='FicheForm' method='POST' >    
    <table class='table table-bordered table-condensed table-responsive table-hover'>
        <tr>
            <th COLSPAN="2">Votre identité :</th>
        </tr>

        <tr>
            <td>Civilité : </td>
            <td><?php if(!empty($fiche['civilite'])){echo($fiche['civilite']);}; ?></td>
        </tr>

        <tr>
            <td>Prenom : </td>
            <td><?php echo($fiche['prenom']); ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Nom d'usage :</td>
            <td ><?php echo($fiche['nom']); ?></td>
        </tr>

        <tr>
            <td class='col-md-5'>Nom de naissance : (si different)</td>
            <td ><?php if(!empty($fiche['nom_naiss'])){echo($fiche['nom_naiss']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'td>Commune de naissance :</td>
            <td ><?php if(!empty($fiche['commune_naiss'])){echo($fiche['commune_naiss']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Departement de naissance</td>
            <td ><?php if(!empty($fiche['dept_naiss'])){echo($fiche['dept_naiss']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Date de naissance : </td>
            <td ><?php if(!empty($fiche['date_naiss'])){echo(substr($fiche['date_naiss'],-2)."/".substr($fiche['date_naiss'],-5,2)."/".substr($fiche['date_naiss'],0,4));}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Discipline : </td>
            <td ><?php if(!empty($fiche['discipline'])){echo($fiche['libelle_discipline']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Nationalité :</td>
            <td ><?php if(!empty($fiche['nationalite'])){echo($fiche['libelle_nationalite']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Adresse : </td>
            <td ><?php if(!empty($fiche['adresse'])){echo($fiche['adresse']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Complement d'adresse : </td>
            <td ><?php if(!empty($fiche['comp_adresse'])){echo($fiche['comp_adresse']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Code postal :</td>
            <td ><?php if(!empty($fiche['cp'])){echo($fiche['cp']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Ville :</td>
            <td ><?php if(!empty($fiche['ville'])){echo($fiche['ville']);}; ?></td>
        </tr>

        <tr>
            <td class='col-md-4'>Numero de securité sociale :</td>
            <td ><?php if(!empty($fiche['num_secu'])){echo($fiche['num_secu']);}; ?></td>
        </tr>
        <tr>
            <td class='col-md-4'>Telephone :</td>
            <td ><?php if(!empty($fiche['telephone'])){echo($fiche['telephone']);}; ?></td>
        </tr>

    </table>
 
    <table class='table table-bordered table-condensed table-responsive table-hover'>
        <tr>
            <th COLSPAN="2">Votre Affiliation au régime étudiant de Sécurité Sociale :</th>
        </tr>
        <tr>
            <td class='col-md-4'>Centre payeur :</td>
            <td><?php if(!empty($fiche['code_mutuelle'])){echo($fiche['code_mutuelle']." - ".$fiche['libelle_mutuelle']);}; ?></td>
        </tr>
        <tr>
            <td>Statut :</td>
            <td><?php if(!empty($fiche['libelle_statut'])){echo($fiche['libelle_statut']);}; ?></td>
        </tr>
    </table>
    
    <table class='table table-bordered table-condensed table-responsive table-hover'>

        <tr>
            <th COLSPAN="2">Commentaire etudiant : </th>
        </tr>
        <tr>
            <td COLSPAN="2"><?php if(!empty($fiche['observations_eleve'])){echo($fiche['observations_eleve']);}else{echo('Aucun commentaire');}; ?></td>
        </tr>
        <tr>
            <th COLSPAN="2">Commentaire gestionnaire : </th>
        </tr>
        <tr>
            <td COLSPAN="2"><?php if(!empty($fiche['observations_gest'])){echo($fiche['observations_gest']);}else{echo('Aucun commentaire');}; ?></td>
        </tr>
        <tr>
            <th class='col-md-3'>Etat de la fiche : </th>
            <td>                
                <?php 
                echo($fiche['libelle_etat']);   ?>
                
            </td>
        </tr>
                <?php if($_SESSION['type'] == 'GESTION' && $app['services']->FicheComplete($fiche)){ ?>

        <tr>
                            <th class='col-md-3'>Modifier Etat : </th>
                <td>
                                <select name="etat">
                                    <?Php foreach($etat as $i){ ?>
                                    <option value='<?php echo($i['id_etat']) ?>'<?php if($fiche['id_etat'] == $i['id_etat']){ ?> selected <?php } ?>><?php echo($i['libelle_etat']) ?></option>
                                    <?php } ?>
                                </select>

                            <button type='submit' formaction='changeEtatFiche' name='id' value ='<?php echo($fiche['id']); ?>' class='btn btn-primary pull-right'>Valider etat</button>
                </td>
        </tr>     
                <?php  } ?>
        
    </table>

    </br>
        <div class='row'>  
            
            <?php if($app['services']->FicheComplete($fiche)){ ?>
                <button type='submit' formaction='modifFiche' name='id' value ='<?php echo($fiche['id']); ?>'  class='btn btn-success '>Modifier Fiche</button></a>
                <button type='submit' formaction='imprimerPdf' name='id' value ='<?php echo($fiche['id']); ?>'  class='btn btn-success col-md-offset-1'>Imprimer</button></a>
                <button type='submit' formaction='MailFiche' name='id' value ='<?php echo($fiche['id']); ?>'  class='btn btn-success col-md-offset-1 '>Recevoir la fiche par mail</button></a>
                <button type='submit' formaction='envoyerFiche' name='id' value ='<?php echo($fiche['id']); ?>'  class='btn btn-success col-md-offset-1'>Envoyer</button></a>
            <?php }
                else{ 
            ?>
                <button class='btn btn-danger pull-left' disabled>Envoi impossible, fiche incomplete</button>
                <button type='submit' formaction='modifFiche' name='id' value ='<?php echo($fiche['id']); ?>'  class='btn btn-success pull-right'>Modifier Fiche</button></a>
            <?php } ?>
        </div>  
    </form>
    </div>
</div>