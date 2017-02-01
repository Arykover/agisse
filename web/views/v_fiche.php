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
        <td><?php if(!empty($fiche[''])){echo($adresse);}; ?></td>
    </tr>
    
    <tr>
        <td>Code postal :</td>
        <td><?php if(!empty($fiche[''])){echo($codePostal);}; ?></td>
        <td>Ville :</td>
        <td><?php if(!empty($fiche[''])){echo($ville);}; ?></td>
    </tr>
    
    <tr>
        <td>Numero de securité sociale :</td>
        <td><?php if(!empty($fiche[''])){echo($numSecu);}; ?></td>
    </tr>
    <tr>
        <td>Telephone :</td>
        <td><?php if(!empty($fiche[''])){echo($telephone);}; ?></td>
        <td>Mail :</td>
        <td><?php if(!empty($fiche[''])){echo($mail);}; ?></td>
    </tr>
    
</table>

<table>
    <tr>
        <th>Votre Affiliation au régime étudiant de Sécurité Sociale :</th>
    </tr>
    <tr>
        <td>Centre payeur :</td>
        <td><?php if(!empty($fiche[''])){echo($affiliation);}; ?></td>
    </tr>
    <tr>
        <td>Statut :</td>
        <td><?php if(!empty($fiche[''])){echo($statut);}; ?></td>
    </tr>
</table>

<table>
    <tr>
        <th>Commentaires : </th>
    </tr>
    <tr>
        <td>Commentaire etudiant : </td>
        <td><?php if(!empty($fiche[''])){echo($commentEtudiant);}; ?></td>
    </tr>
    <tr>
        <td>Commentaire gestionnaire : </td>
        <td><?php if(!empty($fiche[''])){echo($commentGestion);}; ?></td>
    </tr>
</table>