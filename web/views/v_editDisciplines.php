<form name="formDiscipline" method="POST" action="modifDiscipline">
    <h3>
      <?php if($id){  ?>  Modifier  <?php } else{ ?> Ajouter <?php } ?> Discipline 
    </h3>

        <div class="form-group">
            <label for="libelle">Filiere :</label>
            <input type="text" class="form-control" id="libelle" name="libelle" <?php if(isset($infos['libelle_discipline'])){ ?> value="<?php echo $infos['libelle_discipline'] ?>"<?php } ?> required>
        </div>
        <div class="form-group">
            <label for="annee">année :</label>
            <input type="number" class="form-control" id="annee" name="annee" <?php if(isset($infos['annee_discipline'])){ ?> value="<?php echo $infos['annee_discipline'] ?>"<?php } ?> required>
        </div> 
       
        <div class="form-group">
            <label for="annee_cycle">année par cycle :</label>
            <input type="number" class="form-control" id="annee_cycle" name="annee_cycle" <?php if(isset($infos['annee_par_cycle'])){ ?> value="<?php echo $infos['annee_par_cycle'] ?>"<?php } ?> required>
        </div>

        <div class="form-group">
            <label for="cycle_actuel">cycle d'étude actuel :</abbr></label>
            <input type="number" class="form-control" id="cycle_actuel" name="cycle_actuel" <?php if(isset($infos['cycle_etude_actuel'])){ ?> value="<?php echo $infos['cycle_etude_actuel'] ?>"<?php } ?> required>
        </div>

    
    <?php if($id){  ?>
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-default" name='action' value='modif'>Modifier</button>
    <?php } 
         else{ ?>
            <button type="submit" class="btn btn-default" name='action' value='ajout'>Ajouter</button>         
    <?php } ?>
</form>