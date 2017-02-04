<div class='container'>
    <form  id='ModifFicheForm' method='POST' action='/sauvFiche' >
        
        <div class='container col-md-offset-2 col-md-8'>
            <table class='table table-condensed'>
                <tr>
                    <th >Votre identité :</th>
                </tr>
                
                <tr>
                    <td>Civilité : </td>
                    <td>
                                  <label class='radio-inline'><input type='radio' name='civilite' value='Madame' <?php if(!empty($fiche['civilite'])||$fiche['civilite']=='Madame'){ ?> checked ='checked' <?php } ?> >Madame </label>
                                  <label class='radio-inline'><input type='radio' name='civilite' value='Monsieur' <?php if(!empty($fiche['civilite'])||$fiche['civilite']=='Monsieur'){ ?> checked ='checked' <?php } ?> >Monsieur </label></td>
                </tr>
                
                <tr>
                    <td>Prenom : </td>
                    <td><?php echo($_SESSION['prenom']); ?></td>
                </tr>

                <tr>
                    <td>Nom d'usage :</td>
                    <td> <?php echo($_SESSION['nom']); ?></td>
                </tr>

                <tr>
                    <td>Nom de naissance : (si different)</td>
                    <td> <input name="nomUsage" type='text'   value='<?php if(!empty($fiche['nom_naiss'])){echo($fiche['nom_naiss']);}; ?>'></td>
                </tr>

                <tr>
                    <td td>Commune de naissance :</td>
                    <td> <input name="communeNaiss" type='text'   value='<?php if(!empty($fiche['commune_naissance'])){echo($fiche['commune_naissance']);}; ?>'></td>
                </tr>

                <tr>
                    <td>Departement de naissance</td>
                    <td> <input name="deptNaiss" type='text'   value='<?php if(!empty($fiche['dept_naiss'])){echo($fiche['dept_naiss']);}; ?>'></td>
                </tr>

                <tr>
                    <td>Date de naissance :  </td>  <!-- date de naissance avec un maximum 10 ans plus tot qu'aujourdhui -->
                <td> <input name="dateNaiss" id='dateNaiss' type='date' max="<?php echo(date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"),date("Y")-10))); ?>"    value='<?php  if(!empty($fiche['date_naiss'])){$fiche['date_naiss'];}; ?>'></td>
                </tr>

                <tr>
                    <td>Discipline : </td>
                    <td>
                        <select name="discipline">
                            <?Php foreach($disciplines as $i){ ?>
                                <option value='<?php echo($i['id_discipline']) ?>'><?php echo($i['libelle_discipline']) ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nationalité :</td>
                    <td>
                        <select name="nation">
                                <?Php foreach($nationalites as $i){ ?>
                                    <option value='<?php echo($i['code_nationalite']) ?>'><?php echo($i['libelle_nationalite']) ?></option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Adresse : </td>
                    <td> <input name="adresse" type='text'   value='<?php if(!empty($fiche['adresse'])){echo($fiche['adresse']);}; ?>'></td>
                </tr>

                <tr>
                    <td>Complement d'adresse : </td>
                    <td> <input name="adresseComp" type='text'   value='<?php if(!empty($fiche['comp_adresse'])){echo($fiche['comp_adresse']);}; ?>'></td>
                </tr>

                <tr>
                    <td>Code postal :</td>
                    <td> <input name="CP" type='text'   value='<?php if(!empty($fiche['cp'])){echo($fiche['cp']);}; ?>'></td>
                </tr>

                <tr>
                    <td>Ville :</td>
                    <td> <input name="ville" type='text'   value='<?php if(!empty($fiche['ville'])){echo($fiche['ville']);}; ?>'></td>
                </tr>

                <tr>
                    <td>Numero de securité sociale :</td>
                    <td><input onkeyup="checkSecu(); return false;" id='secu' name="numSecu" type='text' maxlength="15" value='<?php if(!empty($fiche['num_secu'])){echo($fiche['num_secu']);} ?>'></td>
                </tr>
                <tr>
                    <td></td>
                    <td><span id="confirmMessageSecu" class="confirmMessageSecu"></span></td>
                </tr>
                <tr>
                    <td>Telephone :</td>
                    <td> <input name ='telephone' type='tel' maxlength="10"  value='<?php if(!empty($fiche['telephone'])){echo($fiche['telephone']);}; ?>'></td>
                </tr>

            </table>
        

            <table class='table table-condensed'>
                <tr>
                    <th>Affiliation au régime étudiant de Sécurité Sociale : <?php echo $_SESSION['type'] ?></th>
                </tr>
                <tr>
                    <td>Centre payeur :</td>
                    <td>
                        <select name="centre">
                                <?Php foreach($centres as $i){ ?>
                                    <option value='<?php echo($i['code_mutuelle']) ?>'><?php echo($i['code_mutuelle']." ".$i['libelle_mutuelle']) ?></option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Statut :</td>
                    <td>
                        <select name="statut">
                                <?Php foreach($statuts as $i){ ?>
                                    <option value='<?php echo($i['id_statut']) ?>'><?php echo($i['libelle_statut']) ?></option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>

            <table class='table table-condensed'>
                <tr>
                    <th class='col-md-offset-1'>Commentaires : </th>
                </tr>
                <tr>
                    <td>Commentaire etudiant : </td>
                </tr>
                <tr>
                    <td> <textarea name="commEtudiant" maxlength="250" cols="75" rows="4" <?php if($_SESSION['type'] != 'ELEVE'){ ?>disabled<?php } ?> > <?php if(!empty($fiche['observations_eleve'])){echo($fiche['observations_eleve']);} ?></textarea></td>
                </tr>
                <tr>
                    <td>Commentaire gestionnaire : </td>
                </tr>
                <tr>
                    <td> <textarea name="commGestionnaire" maxlength="250" cols="75" rows="4" <?php if($_SESSION['type'] != 'GESTION'){ ?>disabled<?php } ?> > <?php if(!empty($fiche['observations_gest'])){echo($fiche['observations_gest']);} ?></textarea></td>
                </tr>
            </table>
            
        <input type='hidden' name='id' value='<?php echo($fiche['id']); ?>'>

            <button type='submit' class='btn-success pull-right' onclick="SubmitCheckSecu()">Modifier Fiche</button>

        </div>
    </form>
</div>