<form method='POST'>
    <button type='submit' formaction="editDiscipline" name='id' value='false' class='btn btn-primary'>Ajouter Discipline</button>
<table cellpadding="1" cellspacing="1" id="comptes"  class ="table table-bordered table-condensed table-responsive table-hover" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Discipline</th>
                <th>année</th>
                <th>année par cycle</th>
                <th>cycle d'etude actuel</th>
            </tr>
        </thead>
        <tfoot>
            </tr>
                <th></th>
                <th>Discipline</th>
                <th>année</th>
                <th>année par cycle</th>
                <th>cycle d'etude actuel</th>
            </tr>
        </tfoot>
        <tbody>

            <?php
                foreach($data as $d){       
                    
            ?>
            <tr>
                <td><button type='submit' formaction="editDiscipline" name='id' value ='<?php echo($d['id_discipline']); ?>' class='btn btn-primary'>Modifier</button>
                <button type='submit' formaction="suppDiscipline" name='id' value ='<?php echo($d['id_discipline']); ?>' class='btn btn-primary'>Supprimer</button></td>
                <td><?php echo($d['libelle_discipline']) ?></td>
                <td><?php echo($d['annee_discipline']) ?></td>
                <td><?php echo($d['annee_par_cycle']) ?></td>
                <td><?php echo($d['cycle_etude_actuel']) ?></td>
            </tr>
            
            <?php } ?>
            
            </tbody>
        </table>
    <button type='submit' formaction="editDiscipline" name='id' value=false class='btn btn-primary'>Ajouter Discipline</button>
</form>