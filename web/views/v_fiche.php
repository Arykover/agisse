
<div class='container'>
<table class='table table-condensed col-md-offset-1 col-md-9 col-md-offset-2'>
    <tr>
        <th >Votre identité :</th>
    </tr>
    
    <tr>
        <td width='25%'>Prenom : </td>
        <td width='70%'><?php if(!empty($fiche['civilite'])){echo($civilite);}; ?> <?php echo($_SESSION['prenom']); ?></td>
    </tr>
    
    <tr>
        <td class='col-md-4'>Nom d'usage :</td>
        <td ><?php echo($_SESSION['nom']); ?></td>
    </tr>
    
    <tr>
        <td class='col-md-4'>Nom de naissance : (si different)</td>
        <td ><?php if(!empty($fiche['nom_naiss'])){echo($fiche['nom_naiss']);}; ?></td>
    </tr>
    
    <tr>
        <td class='col-md-4'td>Commune de naissance :</td>
        <td ><?php if(!empty($fiche['commune_naissance'])){echo($fiche['commune_naissance']);}; ?></td>
    </tr>
    
    <tr>
        <td class='col-md-4'>Departement de naissance</td>
        <td ><?php if(!empty($fiche['dept_naiss'])){echo($fiche['dept_naiss']);}; ?></td>
    </tr>
    
    <tr>
        <td class='col-md-4'>Date de naissance : </td>
        <td ><?php if(!empty($fiche['date_naiss'])){$fiche['date_naiss'];}; ?></td>
    </tr>
    
    <tr>
        <td class='col-md-4'>Discipline : </td>
        <td ><?php if(!empty($fiche['discipline'])){echo($fiche['discipline']);}; ?></td>
    </tr>
    
    <tr>
        <td class='col-md-4'>Nationalité :</td>
        <td ><?php if(!empty($fiche['nationalite'])){echo($nationalite);}; ?></td>
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
</br></br></br>
<table class='table table-condensed col-md-offset-1 col-md-9 col-md-offset-2'>
    <tr>
        <th>Votre Affiliation au régime étudiant de Sécurité Sociale :</th>
    </tr>
    <tr>
        <td>Centre payeur :</td>
        <td><?php if(!empty($fiche['code_mutuelle'])){echo($fiche['code_mutuelle']." - ".$fiche['libelle_mutuelle']);}; ?></td>
    </tr>
    <tr>
        <td>Statut :</td>
        <td><?php if(!empty($fiche['libelle_statut'])){echo($fiche['libelle_statut']);}; ?></td>
    </tr>
</table>

<table class='table table-condensed col-md-offset-1 col-md-9 col-md-offset-2'>
    <tr>
        <th class='col-md-offset-1'>Commentaires : </th>
    </tr>
    <tr>
        <td>Commentaire etudiant : </td>
        <td><?php if(!empty($fiche['observations_eleve'])){echo($fiche['observations_eleve']);}; ?></td>
    </tr>
    <tr>
        <td>Commentaire gestionnaire : </td>
        <td><?php if(!empty($fiche['observations_gest'])){echo($fiche['observations_gest']);}; ?></td>
    </tr>
</table>

</br></br></br></br>

<div class='container col-md-offset-2 col-md-10'>
        Etat de la fiche : 
      
            <?php if($_SESSION['type'] == '3' ){ 
                            echo($fiche['libelle_etat']);   ?>
                            </br></br></br></br>
                            <button class='btn-success col-md-2 col-md-offset-3'>Valider Fiche</button>
            <?php } else if($_SESSION['type'] == 'GESTIONNAIRE' ){ ?>

    <form  id='EtatFicheForm' method='POST' action='/etatFiche' class='col-md-offset-1 col-md-10 col-md-offset-1'>
    
                        <SELECT name='etat'>
                            <OPTION value=""> </OPTION>
                        </SELECT>
    </form>                    
                       <?php } ?>
                           

        <button class='btn-success col-md-2 col-md-offset-2'>Modifier Fiche</button>
        

</div>
</div>