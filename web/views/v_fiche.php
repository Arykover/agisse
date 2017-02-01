<table>
    <tr>
        <th>Votre identité :</th>
    </tr>
    
    <tr>
        <td></td>
        <td><?php if(!empty($fiche['civilite'])){echo($civilite);}; ?></td>
        <td>Prenom : </td>
        <td><?php echo($_SESSION['prenom']); ?></td>
    </tr>
    
    <tr>
        <td>Nom d'usage :</td>
        <td><?php echo($_SESSION['nom']); ?></td>
        <td>Nom de naissance : (si different)</td>
        <td><?php if(!empty($fiche['nom_naiss'])){echo($fiche['nom_naiss']);}; ?></td>
    </tr>
    
    <tr>
        <td>Commune de naissance :</td>
        <td><?php if(!empty($fiche['commune_naissance'])){echo($fiche['commune_naissance']);}; ?></td>
        <td>Departement de naissance</td>
        <td><?php if(!empty($fiche['dept_naiss'])){echo($fiche['dept_naiss']);}; ?></td>
    </tr>
    
    <tr>
        <td>Date de naissance : </td>
        <td><?php if(!empty($fiche['date_naiss'])){$fiche['date_naiss'];}; ?></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr>
        <td>Discipline : </td>
        <td><?php if(!empty($fiche['discipline'])){echo($fiche['discipline']);}; ?></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr>
        <td>Nationalité :</td>
        <td><?php if(!empty($fiche['nationalite'])){echo($nationalite);}; ?></td>
        <td></td>
        <td></td>
    </tr>
    
    <tr>
        <td>Adresse : </td>
        <td><?php if(!empty($fiche['adresse'])){echo($fiche['adresse']);}; ?></td>
    </tr>
    
    <tr>
        <td>Complement d'adresse : </td>
        <td><?php if(!empty($fiche['comp_adresse'])){echo($fiche['comp_adresse']);}; ?></td>
    </tr>
    
    <tr>
        <td>Code postal :</td>
        <td><?php if(!empty($fiche['cp'])){echo($fiche['cp']);}; ?></td>
        <td>Ville :</td>
        <td><?php if(!empty($fiche['ville'])){echo($fiche['ville']);}; ?></td>
    </tr>
    
    <tr>
        <td>Numero de securité sociale :</td>
        <td><?php if(!empty($fiche['num_secu'])){echo($fiche['num_secu']);}; ?></td>
    </tr>
    <tr>
        <td>Telephone :</td>
        <td><?php if(!empty($fiche['telephone'])){echo($fiche['telephone']);}; ?></td>
    </tr>
    
</table>

<table>
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

<table>
    <tr>
        <th>Commentaires : </th>
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

<form  id='EtatFicheForm' method='POST' action='/remplirFiche'>
    Etat de la fiche : <?php if($_SESSION['type'] == 'ETUDIANT' ){ 
                                                                    echo($fiche['libelle_etat']); }
                        if($_SESSION['type'] == 'GESTIONNAIRE' ){ ?>
                            
                       <?php } ?>

</form>