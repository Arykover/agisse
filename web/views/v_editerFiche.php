<style>
    
table{
   margin-left : 10%;
   margin-right : 10%;
   padding : 0px 0px 0px 0px;
   width: 80%;
   border-radius: 15px 50px;
}    
table, th {
   border: solid 1mm #000000;
}

td, th {
    height: 30px;
    padding : 10px 80px 10px 80px;
}
</style>
<?php
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
        
$tableEdit ="
    <table>
        <tr>
            <th COLSPAN='2'>Votre identité :</th>
        </tr>

        <tr>
            <td>Civilité : </td>
            <td>".$civilite."</td>
        </tr>

        <tr>
            <td>Prenom : </td>
            <td>".$prenom."</td>
        </tr>

        <tr>
            <td>Nom :</td>
            <td >".$nom."</td>
        </tr>

        <tr>
            <td>Nom de naissance : (si different)</td>
            <td >".$nom_naiss."</td>
        </tr>

        <tr>
            <td>Lieu de naissance :</td>
            <td >".$commune_naiss." ".$dept_naiss."</td>
        </tr>

        <tr>
            <td>Date de naissance : </td>
            <td >".substr($date_naiss,-2)."/".substr($date_naiss,-5,2)."/".substr($date_naiss,0,4)."</td>
        </tr>

        <tr>
            <td>Discipline : </td>
            <td >".$libelle_discipline."</td>
        </tr>

        <tr>
            <td>Nationalité :</td>
            <td >".$libelle_nationalite."</td>
        </tr>

        <tr>
            <td>Adresse : </td>
            <td >".$adresse."</td>
        </tr>

        <tr>
            <td>Complement adresse : </td>
            <td >".$comp_adresse."</td>
        </tr>

        <tr>
            <td>Code postal :</td>
            <td >".$cp."</td>
        </tr>

        <tr>
            <td>Ville :</td>
            <td >".$ville."</td>
        </tr>

        <tr>
            <td>Numero de securité sociale :</td>
            <td >".$num_secu."</td>
        </tr>
        <tr>
            <td>Telephone :</td>
            <td >".$telephone."</td>
        </tr>

    </table>
</br> 
    <table>
        <tr>
            <th COLSPAN='2'>Votre Affiliation au régime étudiant de Sécurité Sociale :</th>
        </tr>
        <tr>
            <td>Centre payeur :</td>
            <td>".$mutuelle."</td>
        </tr>
        <tr>
            <td>Statut :</td>
            <td>".$libelle_statut."</td>
        </tr>
    </table>
</br>
    <table>
        <tr>
            <th COLSPAN='2'>Commentaire etudiant : </th>
        </tr>
        <tr>
            <td COLSPAN='2'>".$observations_eleve."</td>
        </tr>
        <tr>
            <th COLSPAN='2'>Commentaire gestionnaire : </th>
        </tr>
        <tr>
            <td COLSPAN='2'>".$observations_gest."</td>
        </tr>
    </table>";

echo $tableEdit;
?>