<style>
    
table{
   margin-left : 1%;
   margin-right : 1%;
   margin-bottom: 20px;
   padding : 30px 30px 30px 30px;
   width: 200mm;
   border-radius: 15px;
   border: solid 2px #000000;
}
td, th{
    padding :  0px 3px 5px 3px;
}
th{
    height: 40px;
}
td{
    height: 20px;
}

</style><?php
 $civilite = $fiche['civilite'];
 $prenom = $fiche['prenom'];
 $nom = $fiche['nom'];
 $nom_naiss  = $fiche['nom_naiss'];
 $commune_naiss  = $fiche['commune_naiss'];
 $date_naiss  = $fiche['date_naiss'];
 $dept_naiss  = $fiche['dept_naiss'];
 $libelle_discipline  = $fiche['libelle_discipline'];
 $libelle_nationalite = $fiche['libelle_nationalite'];
 $libelle_statut = $fiche['libelle_statut'];
 $adresse = $fiche['adresse'];
 $comp_adresse = $fiche['comp_adresse'];
 $cp = $fiche['cp'];
 $ville = $fiche['ville'];
 $num_secu  = $fiche['num_secu'];
 $telephone = $fiche['telephone'];
 $mutuelle =  $fiche['code_mutuelle']." - ".$fiche['libelle_mutuelle'];
 $libelle_mutuelle = $fiche['observations_eleve'];
 $observations_eleve  = $fiche['observations_gest'];
 $observations_gest = $fiche['prenom'];
        
?>
    <table  style="border: solid 1px #440000; width: 90%;"    cellspacing="0">
        <tr>
            <th COLSPAN='2'>Votre identité :</th>
        </tr>

        <tr>
            <td style="width: 50%">Civilité : </td>
            <td style="width: 50%"><?php echo($civilite); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Prenom : </td>
            <td style="width: 50%"><?php echo($prenom); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Nom :</td>
            <td ><?php echo($nom); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Nom de naissance : (si different)</td>
            <td ><?php echo($nom_naiss); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Lieu de naissance :</td>
            <td ><?php echo($commune_naiss); ?> <?php echo($dept_naiss); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Date de naissance : </td>
            <td ><?php echo(substr($date_naiss,-2)); ?>/<?php echo(substr($date_naiss,-5,2)); ?>/<?php echo(substr($date_naiss,0,4)); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Discipline : </td>
            <td ><?php echo($libelle_discipline); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Nationalité :</td>
            <td ><?php echo($libelle_nationalite); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Adresse : </td>
            <td ><?php echo($adresse); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Complement adresse : </td>
            <td ><?php echo($comp_adresse); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Code postal :</td>
            <td ><?php echo($cp); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Ville :</td>
            <td ><?php echo($ville); ?></td>
        </tr>

        <tr>
            <td style="width: 50%">Numero de securité sociale :</td>
            <td ><?php echo($num_secu); ?></td>
        </tr>
        <tr>
            <td style="width: 50%">Telephone :</td>
            <td ><?php echo($telephone); ?></td>
        </tr>

    </table>

    <table  style="border: solid 1px #440000; width: 90%;"    cellspacing="0">
        <tr>
            <th COLSPAN='2'>Votre Affiliation au régime étudiant de Sécurité Sociale :</th>
        </tr>
        <tr>
            <td style="width: 50%">Centre payeur :</td>
            <td style="width: 50%"><?php echo($mutuelle); ?></td>
        </tr>
        <tr>
            <td style="width: 50%">Statut :</td>
            <td style="width: 50%"><?php echo($libelle_statut); ?></td>
        </tr>
    </table>

    <table  style="border: solid 1px #440000; width: 90%;"    cellspacing="0">
        <tr>
            <th>Commentaire etudiant : </th>
        </tr>
        <tr>
            <td style="width: 100%"><?php echo($observations_eleve); ?></td>
        </tr>
        <tr>
            <th>Commentaire gestionnaire : </th>
        </tr>
        <tr>
            <td style="width: 100%"><?php echo($observations_gest); ?></td>
        </tr>
    </table>
